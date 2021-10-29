<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cms;
use App\Models\ContactDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CmsStoreRequest;
use App\Http\Requests\Admin\ContactDetailsRequest;
use Illuminate\Support\Facades\Cache;
use App\Helpers\CommonHelper;

class CmsController extends Controller
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
    public function index(Request $request, Cms $cms)
    {

        $records = $cms->withTranslation()->sortable(['id' => 'desc']);

		if($request->query('search')){
			$records = $records->where(function($q) use ($request) {
				$q->orWhere('page_name', 'like', '%'.$request->query('search').'%');
				$q->orWhereTranslationLike('title', '%'.$request->query('search').'%');
				$q->orWhereTranslationLike('url', '%'.$request->query('search').'%');
			});
		}



		if($request->sort && $request->direction){
			if(in_array($request->sort, $cms->translatedAttributes)){
				$records->orderByTranslation($request->sort,$request->direction );
			} else {
				$records->orderBy($request->sort,$request->direction );
			}
		}

		$records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

		return view('admin.cms.index',['records'=>$records]);
    }
    public function create(){
        $record = new Cms;
        return view('admin.cms.create', compact('record'));
    }

    public function store(CmsStoreRequest $request)
    {
      // dd($request);
        $validated = $request->validated();
        $cms = Cms::create($validated);
        return redirect()->route('admin.cms.index')->with(['success'=>'CMS Page added successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function edit(Cms $cms,$id)
    {
        $record = $cms->findOrFail($id);
		return view('admin.cms.edit',['record'=>$record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function update(CmsStoreRequest $request,$id){
		$record = Cms::findOrFail($id);
		$record->fill($request->validated());
		$record->save();
		return redirect()->route('admin.cms.index')->with(["success"=>"CMS updated successfully."]);
    }

    public function contactDetailUpdate(ContactDetailsRequest $request){
        $record = ContactDetail::findOrFail(1);
        //dd($request->validated());
        $record->fill($request->validated());
        $record->save();
        return redirect()->route('admin.cms.contact-detail-edit')->with(["success"=>"CMS updated successfully."]);
    }


    public function contactDetailEdit (ContactDetail $contact)
    {
        $record = $contact->findOrFail(1);
        return view('admin.cms.contact_edit',['record'=>$record]);
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
