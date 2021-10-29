<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientCategoriesRequest;
use App\Models\ClientCategory;
use Illuminate\Http\Request;
use CommonHelper;
use Response;

class ClientCategoriesController extends Controller
{
    public function index(Request $request, ClientCategory $category)
    {
        $records = $category->withTranslation();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('name', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if(in_array($request->sort, $category->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.client_categories.index',['records'=>$records]);
    }
    public function create(){
        $record = new ClientCategory;
        return view('admin.client_categories.create', compact('record'));
    }

    public function store(ClientCategoriesRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = \Str::slug($validated['en']['name']);
        $category = ClientCategory::create($validated);
        return redirect()->route('admin.client_categories.index')->with(['success'=>'Client Category added successfully.']);
    }
    public function edit($id)
    {
        $record = ClientCategory::findOrFail($id);
        return view('admin.client_categories.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientCategoriesRequest $request, $id)
    {
        $category = ClientCategory::findOrFail($id);
        $validated = $request->validated();
        $category->fill($validated);
        $category->save();
        return redirect()->route('admin.client_categories.index')->with(['success'=>'Client Category updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = ClientCategory::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Client Category deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = ClientCategory::findOrFail($request->id);
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
        $table = ClientCategory::get();
        $filename = "client_categories.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Client Category Name'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->translate("en")->name));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'client_categories.csv', $headers);
    }
}
