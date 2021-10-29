<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertisementAnalytics;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\AdvertisementTranslation;
use App\Models\AdvertisementImage;
use App\Http\Requests\Admin\AdvertisementsRequest;
use Image;
use Response;

class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Advertisement $product)
    {
        $records = $product->withTranslation();
        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('product_title', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            });
        }
        if($request->sort && $request->direction){
            if(in_array($request->sort, $product->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.advertisements.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Advertisement();
        return view('admin.advertisements.create', compact('record'));
//        if (Advertisement::get()->count() < 3){
//            $record = new Advertisement();
//            return view('admin.advertisements.create', compact('record'));
//        }else{
//            return redirect()->route('admin.advertisements.index')->with(['error'=>'You can not create more than 3 Advertisements.']);
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementsRequest $request)
    {
        //dd($request->all());
        $allData = $request->validated();
        $allData["status"]="Inactive";
        //$allData['slug'] = \Str::slug($allData['en']['name']).'-'.time();
        //dd($allData);
        $client = Advertisement::create($allData);
        return redirect()->route('admin.advertisements.index')->with(['success'=>'Advertisement added successfully.']);
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
        $record = Advertisement::findOrFail($id);
        //dd($record);
        return view('admin.advertisements.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementsRequest $request, $id)
    {
        $record = Advertisement::findOrFail($id);
        $record->fill($request->validated());
        $record->save();
        return redirect()->route('admin.advertisements.index')->with(['success'=>'Advertisement information has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Advertisement::findOrFail($id);
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
//    public function changeStatus(Request $request)
//    {
//        $record = Advertisement::findOrFail($request->id);
//        $record->status = $request->status;
//        if($record->save()){
//            $error = 0;
//            $message ='Status changed to <strong>'.$record->status.'</strong>';
//        } else {
//            $error = 1;
//            $message ='Unable to change status';
//        }
//        return response()->json(['error' => $error,'message' => $message]);
//    }

    public function changeStatus(Request $request)
    {
//        if( $request->status=="Active" && Advertisement::where("status","Active")->count()>=3) {
//            $error = 1;
//            $message = 'You can not active more than 3 advertisements.';
//        }else{
            $record = Advertisement::findOrFail($request->id);
            $record->status = $request->status;
            if($record->save()){
                $error = 0;
                $message ='Status changed to <strong>'.$record->status.'</strong>';
            } else {
                $error = 1;
                $message ='Unable to change status';
            }
//        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function clientRemoveImage(Request $request)
    {
        $deleteImage = AdvertisementImage::destroy($request->image_id);
        if ($deleteImage) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function clientAjaxLogoImageUpload(Request $request){
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000',
//            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000|dimensions:min_width=400,min_height=250,max_width=450,max_height=300',
        ],[
//            "file.dimensions"=>"Image width should be (400px to 450px) and height should (250px to 300px)" ,
//            "file.dimensions"=>"Please upload the image in 11:9 format." ,
            "file.max"=>"Image size can not be more than 10 MB.",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $file = $request->file;
        $image = $request->file;

        $tmpFolder = Advertisement::IMAGE_TMP_DIR.date('Y-m-d') . '/';
        $rootFolder = public_path() . "/" . $tmpFolder;

        // dd($rootFolder);
        !is_dir($rootFolder) ? mkdir($rootFolder,0777,true) : '';
        $thumbnail = uniqid() . '.' . $image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(550)->heighten(400);

        $response = $img->resize(437, 258, function ($constraint) {
            $constraint->aspectRatio();
        })->save($rootFolder . '/' . $thumbnail);
        $filename = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move($rootFolder, $filename);
        if (isset($request->client_id) && !empty($request->client_id)) {
            $response = $this->saveUpdatedImage($request->client_id, $filename, $thumbnail);
            return $response;
        } else {
            return response()->json(['status' => true, 'filename' => $filename, 'file_url' => asset($tmpFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($tmpFolder . $thumbnail)]);
        }
    }
}
