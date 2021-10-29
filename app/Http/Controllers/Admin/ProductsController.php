<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ProductAnalytics;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductImage;
use App\Http\Requests\Admin\ProductRequest;
use Image;
use Response;
use Route;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {

//        dd(Route::current()->getName());
        $records = $product->with(['category','subcategory','vendor'])->withTranslation();
        if($request->query('search')){
            $records = $records->orwhere(function($q) use ($request) {
                $q->orWhereTranslationLike('product_title', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            })->orWhereRaw("CONCAT(country_code, vendor_code, category_code,sub_category_code,code) LIKE ?", ['%'.$request->query('search').'%']);
        }
        if($request->sort && $request->direction){
            if($request->sort=='product_title'){
                $records->orderByTranslation($request->sort,$request->direction );
            } else if($request->sort == "category_name"){
                $records->join("categories","categories.slug",'=','products.category_slug')
//                    ->where("locale",app()->getLocale())
                    ->select("products.*")
                    ->orderBy("categories.slug",$request->direction);
            } elseif($request->sort == "sub_category"){
                $records->join("sub_category_translations","sub_category_translations.sub_category_id",'=','products.subcategory_id')
                    ->where("locale",app()->getLocale())
                    ->select("products.*")
                    ->orderBy("sub_category_translations.name",$request->direction);
            } elseif($request->sort == "vendor_name"){
                $records->join("vendors","vendors.id",'=','products.vendor_id')
                    ->select("products.*")
                    ->orderBy("vendors.name",$request->direction);
            } else if($request->sort == "product_code") {
                $records->orderBy("country_code",$request->direction );
                $records->orderBy("vendor_code",$request->direction );
                $records->orderBy("category_code",$request->direction );
                $records->orderBy("sub_category_code",$request->direction );
                $records->orderBy("code",$request->direction );
            }else{
                $records->orderBy($request->sort,$request->direction);
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        //dd($records->toArray());
        if(Route::current()->getName()=="admin.products.index.status"){
            return view('admin.products.index_status', ['records' => $records]);
        }else{
            return view('admin.products.index', ['records' => $records]);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Product();
        return view('admin.products.create',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
//        dd($request->all());
        $allData = $request->validated();
        $allData['slug'] = \Str::slug($allData['en']['product_title']).'-'.time();
        if(!empty($allData["price"])){
            $allData['show_price']="Active";
        }else{
            $allData['show_price']="Inactive";
        }
        if(!empty($allData["price"]) && !empty($allData["discount_percent"])){
            $allData['final_discount_price']=($allData["price"]*(100-number_format($allData["discount_percent"],0)))/100;
            $allData['display_discount']="Active";
        }else{
            $allData['display_discount']="Inactive";
        }

        $product_img = @$request->product_img;
        $product = Product::create($allData);
        if (!empty($product_img['images'])) {
            foreach ($product_img['images'] as $key => $value) {
                $images[$key] = new ProductImage(['image' => $value, 'thumbnail' => $product_img['thumbnail'][$key]]);
            }
            $product->ProductImage()->saveMany($images);
        }
        return redirect()->route('admin.products.index')->with(['success'=>'Product added successfully.']);
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
        $record = Product::with(['ProductImage'])->findOrFail($id);
        //dd($record);
        return view('admin.products.edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $record = Product::findOrFail($id);
        $validated=$request->validated();
//        if(!empty($validated["price"]) && !empty($validated["discount_percent"])){
//            $validated['final_discount_price']=number_format(($validated["price"]*(100-number_format($validated["discount_percent"],0)))/100,0);
//            $validated['display_discount']="Active";
//        }else{
//            $validated['display_discount']="Inactive";
//        }
        if(!empty($validated["price"])){
            $validated['show_price']="Active";
        }else{
            $validated['show_price']="Inactive";
        }
        if(!empty($validated["price"]) && !empty($validated["discount_percent"])){
            $validated['final_discount_price']=($validated["price"]*(100-number_format($validated["discount_percent"],0)))/100;
            $validated['display_discount']="Active";
        }else{
            $validated['display_discount']="Inactive";
        }

        $record->fill($validated);
        $record->save();
        return redirect()->route('admin.products.index')->with(['success'=>'Product information has been updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        if($record->delete()){
            ProductImage::where('product_id', $id)->delete();
            ProductTranslation::where('product_id', $id)->delete();
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
        $record = Product::findOrFail($request->id);
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
     * Mark unmark best offer the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeOfferStatus(Request $request)
    {
        $record = Product::findOrFail($request->id);
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
    /**
     * Mark unmark best offer the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeDisplayDiscountStatus(Request $request)
    {
        $record = Product::findOrFail($request->id);
        $record->display_discount = $request->status;
        if(!empty($record->price) && !empty($record->discount_percent)) {
            if ($record->save()) {
                $error = 0;
                $message = 'Display discount status is <strong>' . $record->best_offer . '</strong>';
            } else {
                $error = 1;
                $message = 'Unable to change offer status';
            }
        }else{
            $error = 1;
            $message = 'Please set price and discount percent first.';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
    /**
     * Mark unmark product code display status the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProductDisplayStatus(Request $request)
    {
        $record = Product::findOrFail($request->id);
        $record->display_product_code = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Now offer status is <strong>'.$record->display_product_code.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change display status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
 /**
     * Mark unmark vendor display status the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeVendorDisplayStatus(Request $request)
    {
        $record = Product::findOrFail($request->id);
        $record->display_vendor = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Now offer status is <strong>'.$record->display_vendor.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change display status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }

    /**
     * Mark unmark best offer the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trendingSale(Request $request)
    {
        $record = Product::findOrFail($request->id);
        $record->trending_sale = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Now trending sale for current product is <strong>'.$record->trending_sale.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change tranding sale status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }

    public function displayPrice(Request $request){
        $record = Product::findOrFail($request->id);
        //dd($record);
        $record->show_price = $request->status;
        if(!empty($record->price) && $record->save()){
            $error = 0;
            $message ='Now pice status is <strong>'.$record->show_price.'</strong>';
        } else {
            $error = 1;
            $message ='Firstly set price field';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }


    public function productAjaxImageUpload(Request $request){
        //dd($request->all());

        $validator = \Validator::make($request->all(), [
//            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000|dimensions:min_width=1100,min_height=900,max_width=1150,max_height=950',
              'file' => 'required|image|mimes:jpeg,png,jpg|max:10000',
//            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000|dimensions:ratio=11/9',
        ],[
//            "file.dimensions"=>"Image width should be (1100px to 1150px) and height should (900px to 950px)" ,
//            "file.dimensions"=>"Please upload the image in 11:9 format." ,
            "file.max"=>"Image size can not be more than 10 MB.",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }
        $file = $request->file;
        $image = $request->file;

        $tmpFolder = Product::PRODUCT_TMP_DIR.date('Y-m-d') . '/';
        $rootFolder = public_path() . "/" . $tmpFolder;

        //dd(is_dir($rootFolder));
        !is_dir($rootFolder) ? mkdir($rootFolder) : '';
        $thumbnail = uniqid() . '.' . $image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(550)->heighten(400);

        $response = $img->resize(550, 450, function ($constraint) {
            //$constraint->aspectRatio();
        })->save($rootFolder . '/' . $thumbnail);


        $filename = uniqid() . "." . $file->getClientOriginalExtension();
        $file->move($rootFolder, $filename);
        if (isset($request->product_id) && !empty($request->product_id)) {
            $response = $this->saveUpdatedImage($request->product_id, $filename, $thumbnail);
            return $response;
        } else {
            return response()->json(['status' => true, 'filename' => $filename, 'file_url' => asset($tmpFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($tmpFolder . $thumbnail)]);
        }
    }

    public function saveUpdatedImage($product_id = null, $filename = null, $thumbnail = null){
        $max= ProductImage::where("product_id",$product_id)->max('image_order');
        if(empty($max)){
            $max=0;
            $productImage = ProductImage::create(['product_id' => $product_id, 'image' => $filename, 'image_order' => $max, 'featured' => 1, 'thumbnail' => $thumbnail]);
        }else{
            $productImage = ProductImage::create(['product_id' => $product_id, 'image' => $filename, 'image_order' => $max, 'thumbnail' => $thumbnail]);
        }
        //  dd($properyImage->id);
        if (!empty($productImage)) {
            $rootFolder = Product::PRODUCT_DIR . $productImage->product_id . '/';
            return response()->json(['status' => true, 'image_id' => $productImage->id, 'filename' => $filename, 'file_url' => asset($rootFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($rootFolder . $thumbnail)]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong while updting the image']);
        }
    }
    public function productRemoveImage(Request $request)
    {
        $deleteImage = ProductImage::destroy($request->image_id);
        if ($deleteImage) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function getImage(Request $request){
        $records= ProductImage::where("product_id",$request->id)->orderBy("image_order")->orderBy("id")->get();
        $view=view('admin.products.get_image')->with('records',$records)->render();
        return response()->json(['modal_content'=>$view]);
    }
    public function markedFeatured(Request $request){
        ProductImage::where("product_id",$request->product_id)->update(['featured' => 0]);
        ProductImage::where("id",$request->id)->update(['featured' => 1]);
        return response()->json([
            'error' => 0,
            'message' => "Image marked as featured."
        ]);

    }
    public function imageReorder(Request $request){
       $orders=$request->data;
       if(!empty($orders)){
           foreach($orders as $key=>$order){
               $record = ProductImage::findOrFail($order);
               if($record){
                   $record->image_order = $key;
                   $record->save();
               }else{
                   continue;
               }
           }
       }

    }

    public function normalCsv(Product $product)
    {
        $table = $product->with(['category','subcategory',"vendor"])->withTranslation()->orderBy('view_count', 'DESC')->get();
        $filename = "product_without_image.csv";
        $handle = fopen($filename, 'w+');
        //dd($table);
        putcsv($handle, array('S.No','Product Name','Product Code','Vendor Name','Category','Sub-Category','Price','Price After Discount','Status'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->product_title,$row->product_code,$row->vendor->name,@$row->category->name,@$row->subcategory->name,@$row->price,@$row->final_discount_price,@$row->status));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_without_image.csv', $headers);
    }

    public function statusNormalCsv(Product $product)
    {
        $table = $product->with(['category','subcategory',"vendor"])->withTranslation()->orderBy('view_count', 'DESC')->get();
        $filename = "product_status_without_image.csv";
        $handle = fopen($filename, 'w+');
        //dd($table);
        fputcsv($handle, array('S.No','Product Name','Product Code','Product Display Code','Display Factory','Best Offer','Trending sale','Product Discount(%)',"Discount Status","Product Status"));
        $i=1;
        foreach($table as $row) {
            $discount_percent=(!empty($row->discount_percent))?$row->discount_percent:"N/A";
            fputcsv($handle, array($i,$row->product_title,$row->product_code,$row->display_product_code,$row->display_vendor,$row->best_offer,$row->trending_sale,$discount_percent,$row->display_discount,$row->status));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_status_without_image.csv', $headers);
    }


    public function Imagecsv(Product $product)
    {
        $table = $product->with(['category','subcategory','latestImage','vendor'])->withTranslation()->orderBy('view_count', 'DESC')->get()->toArray();
        $filename = "product_with_image.csv";
        $handle = fopen($filename, 'w+');
        //dd($table);
        fputcsv($handle, array('S.No','Product Name','Product Code','Vendor Name','Category','Sub-Category','Price','Price After Discount','Status','Image URL','Thumbnail URL'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->product_title,$row->product_code,$row->vendor->name,@$row->category->name,@$row->subcategory->name,@$row->price,@$row->final_discount_price,@$row->status,@$row->latestImage->image_url,@$row->latestImage->thumbnail_url));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_with_image.csv', $headers);
    }

    public function statusImagecsv(Product $product)
    {
        $table = $product->with(['category','subcategory','latestImage',"vendor"])->withTranslation()->orderBy('view_count', 'DESC')->get();
        $filename = "product_with_image.csv";
        $handle = fopen($filename, 'w+');
        //dd($table);
        fputcsv($handle, array('S.No','Product Name','Product Code','Product Display Code','Display Factory','Best Offer','Trending sale','Product Discount(%)',"Discount Status","Product Status",'Image URL','Thumbnail URL'));
        $i=1;
        foreach($table as $row) {
//            dd($row->latestImage->thumbnail_url);
            $discount_percent=(!empty($row->discount_percent))?$row->discount_percent:"N/A";
            fputcsv($handle, array($i,$row->product_title,$row->product_code,$row->display_product_code,$row->display_vendor,$row->best_offer,$row->trending_sale,$discount_percent,$row->display_discount,$row->status,@$row->latestImage->image_url,@$row->latestImage->thumbnail_url));
            $i++;
        }
        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_with_image.csv', $headers);
    }

    public function csv()
    {
        $table = ProductAnalytics::with(["product.vendor"])->get()->sortByDesc("number_of_visits");
        $filename = "product_analytics.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Product Category','Product Sub Category','Country','Product Vendor','Product Code','Product Price','Product Discount(%)','Product Name',"User Name","User Email","User Phone","Number Of Visit","Last View Date","Last View Time"));
        $i=1;
        foreach($table as $row) {
//            dd($row->vendor()->name);
            $price=(!empty($row->product->price))?$row->product->price:"N/A";
            $discount_percent=(!empty($row->product->discount_percent))?$row->product->discount_percent:"N/A";
            fputcsv($handle, array($i,$row->product_category,$row->product_sub_category,$row->product->vendor->country->name,$row->product->vendor->name,$row->product->product_code,$price,$discount_percent,$row->product_title,$row->user_name,$row->user_email,$row->user_number,$row->number_of_visits,date("d-M-Y" ,strtotime($row->updated_at)),date("h:i:s A" ,strtotime($row->updated_at))));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_analytics.csv', $headers);
    }
    public function statusCsv()
    {
        $table = ProductAnalytics::with(["product","product.vendor"])->get()->sortByDesc("number_of_visits");
        $filename = "product_analytics.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Product Name','Product Code','Product Display Code','Display Factory','Best Offer','Trending sale','Product Discount(%)',"Discount Status","User Name","User Email","User Phone","Number Of Visit","Last View Date","Last View Time"));
        $i=1;
        foreach($table as $row) {
//            dd($row->vendor()->name);
            $price=(!empty($row->product->price))?$row->product->price:"N/A";
            $discount_percent=(!empty($row->product->discount_percent))?$row->product->discount_percent:"N/A";
            fputcsv($handle, array($i,$row->product_title,$row->product->product_code,$row->product->display_product_code,$row->product->display_vendor,$row->product->best_offer,$row->product->trending_sale,$discount_percent,$row->product->display_discount,$row->user_name,$row->user_email,$row->user_number,$row->number_of_visits,date("d-M-Y" ,strtotime($row->updated_at)),date("h:i:s A" ,strtotime($row->updated_at))));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'product_analytics.csv', $headers);
    }
    public function singleClientCsv($id){
        $product = Product::with(["vendor"])->get()->where("id",$id)->sortByDesc("id")->first();
        $table = ProductAnalytics::with(["product.vendor"])->get()->where("product_id",$id)->sortByDesc("number_of_visits");
        $filename = $product->product_title."_product_analytics.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Product Category','Product Sub Category','Country','Product Vendor','Product Code','Product Price','Product Discount(%)','Product Name',"User Name","User Email","User Phone","Number Of Visit","Last View Date","Last View Time"));
        $i=1;
        foreach($table as $row) {
            $price=(!empty($row->product->price))?$row->product->price:"N/A";
            $discount_percent=(!empty($row->product->discount_percent))?$row->product->discount_percent:"N/A";
            fputcsv($handle, array($i,$row->product_category,$row->product_sub_category,$row->product->vendor->country->name,$row->product->vendor->name,$row->product->product_code,$price,$discount_percent,$row->product_title,$row->user_name,$row->user_email,$row->user_number,$row->number_of_visits,date("d-M-Y" ,strtotime($row->updated_at)),date("h:i:s A" ,strtotime($row->updated_at))));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, $product->product_title.'_product_analytics.csv', $headers);
    }

}
