<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VendorRequest;
use App\Models\Country;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Image;
use Response;
class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Vendor $vendor)
    {
//        $records = $vendor;
        $records = $vendor::sortable(['id' => 'desc']);
        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('name', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('code', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('country_code', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('email', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('website', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if($request->sort == "country"){
                $records->join("country_translations","country_translations.country_id",'=','vendors.country_id')
                    ->where("locale",app()->getLocale())
                    ->select("vendors.*")
                    ->orderBy("country_translations.name",$request->direction);
            }else{
                $records->orderBy($request->sort,$request->direction);
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.vendors.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Vendor();
//        $country_with_code=App/Models/Country::getCountryWithCode();
        return view('admin.vendors.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        $allData = $request->validated();
        $client = Vendor::create($allData);
        return redirect()->route('admin.vendors.index')->with(['success'=>'Vendor added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Vendor::findOrFail($id);

//        $country_with_code=App/Models/Country::getCountryWithCode();
        //dd($record);
        return view('admin.vendors.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        $record = Vendor::findOrFail($id);
        $data=$request->validated();
        \App\Models\Product::where('vendor_code',$record["code"])->where('country_code',$record["country_code"])
            ->update(['vendor_code' => $data["code"]]);
        if($record["code"]!=$data["code"]) {
            \App\Models\Product::where('country_code', $record["country_code"])->where("vendor_code", $data["code"])
                ->update(['country_code' => $data["country_code"]]);
        }else{
            \App\Models\Product::where('country_code', $record["country_code"])->where("vendor_code", $record["code"])
                ->update(['country_code' => $data["country_code"]]);
        }
        $record->fill($data);
        $record->save();
        return redirect()->route('admin.vendors.index')->with(['success'=>'Vendor information has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Vendor::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }


    /**
     * Change Status the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $record = Vendor::findOrFail($request->id);
        $record->status = $request->status;
//        \App\Models\Product::where('vendor_code',$record->code)
//            ->update(['status' => $request->status]);
        if($record->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
//    public function clientRemoveImage(Request $request)
//    {
//        if ($deleteImage) {
//            return response()->json(['status' => true]);
//        } else {
//            return response()->json(['status' => false]);
//        }
//    }
    public function clientAjaxLogoImageUpload(Request $request){
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $file = $request->file;
        $image = $request->file;

        $tmpFolder = Vendor::VENDOR_LOGO_TMP_DIR.date('Y-m-d') . '/';
        $rootFolder = public_path() . "/" . $tmpFolder;

        // dd($rootFolder);
        !is_dir($rootFolder) ? mkdir($rootFolder,0777,true) : '';
        $thumbnail = uniqid() . '.' . $image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(550)->heighten(400);

        $response = $img->resize(114, 114, function ($constraint) {
            $constraint->aspectRatio();
        })->save($rootFolder . '/' . $thumbnail);
        $filename = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move($rootFolder, $filename);
        if (isset($request->id) && !empty($request->id)) {
            $response = $this->saveUpdatedImage($request->id, $filename, $thumbnail);
            return $response;
        } else {
            return response()->json(['status' => true, 'filename' => $filename, 'file_url' => asset($tmpFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($tmpFolder . $thumbnail)]);
        }
    }
    public function export()
    {
        $table = Vendor::with("country")->get()->sortByDesc("id");
        $filename = "vendors.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Vendor Name','Vendor Code','Country',"Website","Vendor Email","Dial Code","Vendor Phone","Comment"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->name,$row->vendor_code,$row->country->name,$row->website,$row->email,$row->dial_code,$row->phone,$row->comment));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'vendors.csv', $headers);
    }

}
