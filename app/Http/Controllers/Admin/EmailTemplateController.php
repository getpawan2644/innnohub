<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmailTemplateRequest;
use Illuminate\Support\Facades\Cache;
use App\Helpers\CommonHelper;

class EmailTemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EmailTemplate $emailTemplate)
    {

        $records = $emailTemplate->sortable(['id' => 'desc']);

		if($request->query('search')){
			$records = $records->where(function($q) use ($request) {
				$q->orWhere('page_name', 'like', '%'.$request->query('search').'%');
				$q->orWhereLike('title', '%'.$request->query('search').'%');
			});
		}


		$records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

		return view('admin.email_template.index',['records'=>$records]);
    }
    public function create(){
        $record = new EmailTemplate;
        return view('admin.email_template.create', compact('record'));
    }

    public function store(EmailTemplateRequest $request)
    {
        $validated = $request->validated();
        $emailTemplate = EmailTemplate::create($validated);
        return redirect()->route('admin.email_template.index')->with(['success'=>'CMS Page added successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTemplate $emailTemplate,$id)
    {
        $record = $emailTemplate->findOrFail($id);
		return view('admin.email_template.edit',['record'=>$record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateRequest $request,$id){
		$record = EmailTemplate::findOrFail($id);
		$record->fill($request->validated());
		$record->save();
		return redirect()->route('admin.email-template.index')->with(["success"=>"CMS updated successfully."]);
    }

    public function changeStatus(Request $request)
    {
        foreach(CommonHelper::getLanguages() as $language => $locale){
            Cache::forget('cms-general-route-'.$locale);
            Cache::forget('cms-service-route-'.$locale);

        }
       //dd(Cache::has("cms-general-route-en"));
        $record = Cms::findOrFail($request->id);
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

    public function destroy($id)
    {
        $record = Cms::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'CMS deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

}
