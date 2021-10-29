<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermConditionsRequest;
use App\Models\TermCondition;
use Illuminate\Http\Request;
use CommonHelper;
use Response;

class TermConditionsController extends Controller
{
    public function index(Request $request, TermCondition $terms_condition)
    {
        $records = $terms_condition->withTranslation();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('name', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if(in_array($request->sort, $terms_condition->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.term_conditions.index',['records'=>$records]);
    }
    public function create(){
        $record = new TermCondition;
        return view('admin.term_conditions.create', compact('record'));
    }

    public function store(TermConditionsRequest $request)
    {
        $validated = $request->validated();
        $terms_condition = TermCondition::create($validated);
        return redirect()->route('admin.term_conditions.index')->with(['success'=>'Terms & Conditions added successfully.']);
    }
    public function edit($id)
    {
        $record = TermCondition::findOrFail($id);
//        dd($record->translateOrNew("ar")->answer);
        return view('admin.term_conditions.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TermConditionsRequest $request, $id)
    {
        $terms_condition = TermCondition::findOrFail($id);
        $validated = $request->validated();

        $terms_condition->fill($validated);
        $terms_condition->save();
        return redirect()->route('admin.term_conditions.index')->with(['success'=>'Terms & Conditions updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = TermCondition::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Terms & Conditions deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = TermCondition::findOrFail($request->id);
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
        $table = TermCondition::get();
        $filename = "term_conditions.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','TermCondition Name'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->translate("en")->name));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'term_conditions.csv', $headers);
    }
}
