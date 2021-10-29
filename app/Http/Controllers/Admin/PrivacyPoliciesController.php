<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrivacyPoliciesRequest;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use CommonHelper;
use Response;

class PrivacyPoliciesController extends Controller
{
    public function index(Request $request, PrivacyPolicy $privacy_policy)
    {
        $records = $privacy_policy->withTranslation();

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->orWhereTranslationLike('name', '%'.$request->query('search').'%');
                $q->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            });
        }

        if($request->sort && $request->direction){
            if(in_array($request->sort, $privacy_policy->translatedAttributes)){
                $records->orderByTranslation($request->sort,$request->direction );
            } else {
                $records->orderBy($request->sort,$request->direction );
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.privacy_policies.index',['records'=>$records]);
    }
    public function create(){
        $record = new PrivacyPolicy;
        return view('admin.privacy_policies.create', compact('record'));
    }

    public function store(PrivacyPoliciesRequest $request)
    {
        $validated = $request->validated();
        $privacy_policy = PrivacyPolicy::create($validated);
        return redirect()->route('admin.privacy_policies.index')->with(['success'=>'Privacy Policy added successfully.']);
    }
    public function edit($id)
    {
        $record = PrivacyPolicy::findOrFail($id);
//        dd($record->translateOrNew("ar")->answer);
        return view('admin.privacy_policies.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrivacyPoliciesRequest $request, $id)
    {
        $privacy_policy = PrivacyPolicy::findOrFail($id);
        $validated = $request->validated();

        $privacy_policy->fill($validated);
        $privacy_policy->save();
        return redirect()->route('admin.privacy_policies.index')->with(['success'=>'Privacy Policy updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = PrivacyPolicy::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Privacy Policy deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = PrivacyPolicy::findOrFail($request->id);
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
        $table = PrivacyPolicy::get();
        $filename = "privacy_policies.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('S.No','PrivacyPolicy Name'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,$row->translate("en")->name));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'privacy_policies.csv', $headers);
    }
}
