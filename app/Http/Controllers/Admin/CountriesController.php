<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountriesRequest;
use Response;

class CountriesController extends Controller
{
    public function __construct() {

    }
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function index(Country $countries,Request $request)
    {
        $records = $countries->orderBy("id","DESC");

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->Where('code', 'like', '%'.$request->query('search').'%');
                $q->orWhere('dial_code', 'like', '%'.$request->query('search').'%');
                $q->orWhere('currency_name', 'like', '%'.$request->query('search').'%');
                $q->orWhere('currency_symbol', 'like', '%'.$request->query('search').'%');
                $q->orWhere('currency_code', 'like', '%'.$request->query('search').'%');
                $q->orWhere('status', 'like', '%'.$request->query('search').'%');
                $q->orWhereLike('name', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.countries.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Country;
        return view('admin.countries.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesRequest $request) {
        // dd($request);
        $data=$request->validated();
        // dd($data);
        $data["code"]=strtoupper($data["code"]);
        $country = Country::create($data);
        return redirect()->route('admin.countries.index')->with(['success'=>'Country added successfully.']);
    }

    public function changeStatus(Request $request){
        $country = Country::findOrFail($request->id);
//        \App\Models\Vendor::where("country_code",$country->code)->update(['status' => $request->status]);
//        $vendors=\App\Models\Vendor::where("country_code",$country->code)->pluck('code')->toArray();
//        \App\Models\Product::whereIn('vendor_code',$vendors)
//            ->update(['status' => $request->status]);
        $country->status = $request->status;
        if($country->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$country->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Country::findOrFail($id);
        return view('admin.countries.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesRequest $request, $id)
    {
        $data=$request->validated();
        $data["code"]=strtoupper($data["code"]);
        //dd($data);
        $country = Country::findOrFail($id);
//        dd($country["code"]);
        //$record = Vendor::findOrFail($id);
        \App\Models\Vendor::where('country_code',$country["code"])
            ->update(['country_code' => $data["code"]]);
        \App\Models\Product::where('country_code',$country["code"])
            ->update(['country_code' => $data["code"]]);
        $country->fill($data);
        $country->save();
        return redirect()->route('admin.countries.index')->with(['success'=>'Country updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Country::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }
    public function csv()
    {
        $table = Country::get();

        $filename = "countries.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Country Name',"Country Code","Dial Code","Currency Name","Currency Code"));
        $i=1;
        foreach($table as $row) {
//            dd($row);
            fputcsv($handle, array($i,$row->name,$row->code,$row->dial_code,$row->currency_name,$row->currency_code));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'countries.csv', $headers);
    }

}
