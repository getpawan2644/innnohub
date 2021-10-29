<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Country;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request ,ContactUs $contactUs){

//        $records =contactUs::query();
//        $records =contactUs::with('Country');
        //dd($request);
        $records = $contactUs->orderBy("id","DESC");
        if($request->query('search')) {
            // dd($request->query('search'));
            $records = $records->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->query('search').'%');
                $q->orWhere('email', 'like', '%'.$request->query('search').'%');
                $q->orWhere('mobile', 'like', '%'.$request->query('search').'%');
            });

        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        return view('admin.contacts.index',compact('records'));
    }

    public function changeStatus(Request $request){
        $contact = contactUs::findOrFail($request->id);
        $contact->status = $request->status;
        if($contact->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$contact->status.'</strong>';
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
        $record = contactUs::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }
}
