<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqsRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use CommonHelper;
use Response;

class FaqsController extends Controller
{
    public function index(Request $request, Faq $faq)
    {
        $records = $faq->withTranslation();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('name', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if(in_array($request->sort, $faq->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.faqs.index',['records'=>$records]);
    }
    public function create(){
        $record = new Faq;
        return view('admin.faqs.create', compact('record'));
    }

    public function store(FaqsRequest $request)
    {
        $validated = $request->validated();
        $faq = Faq::create($validated);
        return redirect()->route('admin.faqs.index')->with(['success'=>'Faq added successfully.']);
    }
    public function edit($id)
    {
        $record = Faq::findOrFail($id);
//        dd($record->translateOrNew("ar")->answer);
        return view('admin.faqs.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqsRequest $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $validated = $request->validated();

        $faq->fill($validated);
        $faq->save();
        return redirect()->route('admin.faqs.index')->with(['success'=>'Faq updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = Faq::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Faq deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = Faq::findOrFail($request->id);
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
        $table = Faq::get();
        $filename = "faqs.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','Faq Name'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->translate("en")->name));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'faqs.csv', $headers);
    }
}
