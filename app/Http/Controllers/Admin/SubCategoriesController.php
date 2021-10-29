<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoriesRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use DB;

class SubCategoriesController extends Controller
{
    public function index(Request $request, SubCategory $sub_category)
    {
        $records = $sub_category->with("category")->orderBy("id","DESC");
        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereLike('name', '%'.$request->query('search').'%');
                $q->orWhereLike('slug', '%'.$request->query('search').'%');
            });
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.sub_categories.index',['records'=>$records]);
    }
    public function create(){
        $record = new SubCategory;
        return view('admin.sub_categories.create', compact('record'));
    }

    public function store(SubCategoriesRequest $request) {
        $validated = $request->validated();
        $validated['slug'] = \Str::slug('name');

        $sub_category = SubCategory::create($validated);
        // dd($sub_category);
        return redirect()->route('admin.sub_categories.index')->with(['success'=>'SubCategory added successfully.']);
    }
    public function edit($id)
    {
        $record = SubCategory::findOrFail($id);
        return view('admin.sub_categories.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoriesRequest $request, $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $validated = $request->validated();
        // dd($sub_category);
        // $affected = Product::where("id",$id)->update(array(
        //         "name"=>$validated['name']
        //     )
        // );
        $sub_category->fill($validated);
        $sub_category->save();
        return redirect()->route('admin.sub_categories.index')->with(['success'=>'SubCategory updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = SubCategory::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'SubCategory deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = SubCategory::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
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
    public function csv()
    {
        $table = SubCategory::get();
        $filename = "sub-categories.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No',"Category Name",'Sub-Category',"Sub-Category Code"));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->category->translate("en")->name,$row->translate("en")->name,$row->category->code.'-'.$row->code));
            $i++;
        }
        fclose($handle);
        $headers = array(
            "Content-Encoding"=>"UTF-8",
            'Content-Type' => 'text/csv; charset=utf-8',
            "Content-Transfer-Encoding"=>"binary",
            "Content-Encoding"=>"UTF-8",
        );
        return Response::download($filename, 'sub-categories.csv', $headers);
    }
}
