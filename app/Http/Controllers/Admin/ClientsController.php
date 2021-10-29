<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientAnalytics;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientTranslation;
use App\Models\ClientImage;
use App\Http\Requests\Admin\ClientsRequest;
use Image;
use Response;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $product)
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
            }  else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.clients.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Client();
        return view('admin.clients.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request)
    {
        //dd($request->all());
        $allData = $request->validated();
        //$allData['slug'] = \Str::slug($allData['en']['name']).'-'.time();

        $client_img = @$request->client_img;
        $allData['video_url']=implode("~",$allData['video_url']);
        $allData['video_id']=implode("~",$allData['video_id']);
        $client = Client::create($allData);
        if (!empty($client_img['images'])) {
            foreach ($client_img['images'] as $key => $value) {
                $images[$key] = new ClientImage(['image' => $value, 'thumbnail' => $client_img['thumbnail'][$key]]);
            }
            $client->ClientImage()->saveMany($images);
        }
        return redirect()->route('admin.clients.index')->with(['success'=>'Client added successfully.']);
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
        $record = Client::with(['ClientImage'])->findOrFail($id);
//        dd($record->video_url_array);
        return view('admin.clients.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientsRequest $request, $id)
    {
        $record = Client::findOrFail($id);
        $allData=$request->validated();
        $allData['video_url']=implode("~",$allData['video_url']);
        $allData['video_id']=implode("~",$allData['video_id']);
        $record->fill($allData);
        $record->save();
        return redirect()->route('admin.clients.index')->with(['success'=>'Client information has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        if($record->delete()){
            ClientImage::where('client_id', $id)->delete();
            ClientTranslation::where('client_id', $id)->delete();
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
        $record = Client::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
/**
     * Change Status the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeFeatured(Request $request)
    {
        $record = Client::findOrFail($request->id);
        $record->is_featured = $request->status;
//        dd($record);
        if($record->save()){
            $error = 0;
            $message ='Featured Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }

    /**
     * Mark unmark best offer the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeOfferStatus(Request $request)
    {
        $record = Client::findOrFail($request->id);
        $record->best_offer = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Now offer status is <strong>'.$record->best_offer.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change offer status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }



    public function clientAjaxImageUpload(Request $request){
        //dd($request->all());
        $validator = \Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $file = $request->file;
        $image = $request->file;

        $tmpFolder = ClientImage::CLIENT_TMP_DIR.date('Y-m-d') . '/';
        $rootFolder = public_path() . "/" . $tmpFolder;

       // dd($rootFolder);
        !is_dir($rootFolder) ? mkdir($rootFolder,0777,true) : '';
        $thumbnail = uniqid() . '.' . $image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(550)->heighten(400);

        $response = $img->resize(240, 160, function ($constraint) {
            $constraint->aspectRatio();
        })->save($rootFolder . '/' . $thumbnail);


        $filename = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move($rootFolder, $filename);
       // dd($request;
        if (isset($request->client_id) && !empty($request->client_id)) {
            $response = $this->saveUpdatedImage($request->client_id, $filename, $thumbnail);
            return $response;
        } else {
            return response()->json(['status' => true, 'filename' => $filename, 'file_url' => asset($tmpFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($tmpFolder . $thumbnail)]);
        }
    }
    public function saveUpdatedImage($client_id = null, $filename = null, $thumbnail = null)
    {
        $clientImage = ClientImage::create(['client_id' => $client_id, 'image' => $filename, 'thumbnail' => $thumbnail]);
//        dd($properyImage->id);
        if (!empty($clientImage)) {
            $rootFolder = ClientImage::CLIENT_DIR . $clientImage->client_id . '/';
            return response()->json(['status' => true, 'image_id' => $clientImage->id, 'filename' => $filename, 'file_url' => asset($rootFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($rootFolder . $thumbnail)]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong while updting the image']);
        }
    }
    public function clientRemoveImage(Request $request)
    {
        $deleteImage = ClientImage::destroy($request->image_id);
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
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $file = $request->file;
        $image = $request->file;

        $tmpFolder = Client::CLIENT_LOGO_TMP_DIR.date('Y-m-d') . '/';
        $rootFolder = public_path() . "/" . $tmpFolder;

        // dd($rootFolder);
        !is_dir($rootFolder) ? mkdir($rootFolder,0777,true) : '';
        $thumbnail = uniqid() . '.' . $image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(480)->heighten(480);

        $response = $img->resize(155, 150, function ($constraint) {
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
    public function csv()
    {
        $table = ClientAnalytics::get()->sortByDesc("number_of_visits");
        $filename = "client_analytics.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Category Name','Client Name','Client Email',"User Name","User Email","User Phone","Number Of Visit","Last View Date","Last View Time"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->client_category,$row->client_title,$row->client_email,$row->user_name,$row->user_email,$row->user_number,$row->number_of_visits,date("d-M-Y" ,strtotime($row->updated_at)),date("h:i:s A" ,strtotime($row->updated_at))));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'client_analytics.csv', $headers);
    }
    public function clientCsv(){
        $table = Client::get()->sortByDesc("id");
        $filename = "client.csv";
        $handle = fopen($filename, 'w+');
        //dd($table->toArray());
        fputcsv($handle, array('S.No','Client Name','Phone','Client Email',"Website","Logo Image","Logo Thumbnail"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->name,'+'.$row->dial_code.'+'.$row->phone,$row->email,$row->website,$row->logo_image_url,$row->logo_thumbnail_url));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'client.csv', $headers);
    }
    public function singleClientCsv($id){
        $client = Client::get()->where("id",$id)->sortByDesc("id")->first();
        $table = ClientAnalytics::get()->where("client_id",$id)->sortByDesc("number_of_visits");
        $filename = $client->name."_client_analytics.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Category Name','Client Name','Client Email',"User Name","User Email","User Phone","Number Of Visit","Last View Date","Last View Time"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->client_category,$row->client_title,$row->client_email,$row->user_name,$row->user_email,$row->user_number,$row->number_of_visits,date("d-M-Y" ,strtotime($row->updated_at)),date("h:i:s A" ,strtotime($row->updated_at))));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, $client->name.'_client_analytics.csv', $headers);
    }
}
