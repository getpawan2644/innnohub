<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use CommonHelper;
use Illuminate\Support\Str;
use Response;
use Image;
use DB;
class CategoriesController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $records = $category->sortable('id','DESC');

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereLike('name', '%'.$request->query('search').'%');
                $q->orWhereLike('slug', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.categories.index',['records'=>$records]);
    }
    public function create(){
        $record = new Category;
        return view('admin.categories.create', compact('record'));
    }

    public function store(CategoriesRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = \Str::slug('name');

        $category = Category::create($validated);
        // dd($category);
        return redirect()->route('admin.categories.index')->with(['success'=>'Category added successfully.']);
    }
    public function edit($id)
    {
        $record = Category::findOrFail($id);
        return view('admin.categories.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id){
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $affected = Product::Where("category_slug",$category->slug)->update(array(
                'category_slug' => Str::slug('name')
            )
        );
        $category->fill($validated);
        $category->save();
        return redirect()->route('admin.categories.index')->with(['success'=>'Category updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Category deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = Category::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            DB::table('sub_categories')->where("category_id",$request->id)->update(array('status' => $request->status));
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function changeFooterStatus(Request $request)
    {
        if( $request->status=="Active" && Category::where("display_footer","Active")->count()>=5) {
            $error = 1;
            $message = 'You can not select more than 5 categories to the footer.';
        }else{
            $record = Category::findOrFail($request->id);
            $record->display_footer = $request->status;
            if($record->save()){
                $error = 0;
                $message ='Category footer status changed to <strong>'.$record->status.'</strong>';
            } else {
                $error = 1;
                $message ='Unable to change status';
            }
        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function csv()
    {
        $table = Category::get();
        $filename = "categories.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Category Name',"Category Code"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->translate("en")->name,$row->code));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'categories.csv', $headers);
    }

    public function postAjaxImg(Request $request){
		//dd($request->all());
		$validator = \Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        if($validator->fails()){
             return response()->json(['status'=>false,'message' => $validator->errors()->first()]);
        }

        $file = $request->file;
        $image = $request->file;

        $tmpFolder = Category::PHOTOS_TMP_DIR . date('Y-m-d').'/';
		$rootFolder = public_path()."/".$tmpFolder;

        //dd(is_dir($rootFolder));
        !is_dir($rootFolder)?mkdir($rootFolder):'';
        $thumbnail = uniqid().'.'.$image->getClientOriginalExtension();
        //Code for resizing an image
        $img = Image::make($image)->orientate()->widen(550)->heighten(400);

        $response = $img->resize(428, 350, function($constraint) {
            $constraint->aspectRatio();
        })->save($rootFolder.'/'.$thumbnail);


        $filename = uniqid().".".$file->getClientOriginalExtension();
        $file->move($rootFolder, $filename);

        return response()->json(['status'=>true,'filename'=>$filename,'file_url' => asset($tmpFolder.$thumbnail), 'thumbnail'=>$thumbnail, 'thumbnail_url'=> asset($tmpFolder.$thumbnail)]);

	}
    public function saveUpdatedImage($product_id = null, $filename = null, $thumbnail = null)
    {
        $productImage = ProductImage::create(['product_id' => $product_id, 'image' => $filename, 'thumbnail' => $thumbnail]);
        //  dd($properyImage->id);
        if (!empty($productImage)) {
            $rootFolder = Product::PRODUCT_DIR . $productImage->product_id . '/';
            return response()->json(['status' => true, 'image_id' => $productImage->id, 'filename' => $filename, 'file_url' => asset($rootFolder . $thumbnail), 'thumbnail' => $thumbnail, 'thumbnail_url' => asset($rootFolder . $thumbnail)]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong while updting the image']);
        }
    }
}
