<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index(Request $request){
        $user_id = Auth::id();
        $email = Auth::user()->email;
        $date = (!empty($request->query('search')))?date('Y-m-d', strtotime($request->query('search'))):date('Y-m-d');
        $records = ProductRequest::with(['user','product'])->where('user_id',$user_id)->orWhere('email',$email)->orderByDesc("id");
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT')));
        //dd($records->toArray());
        return view('request.index',compact(['records']));
    }

    public function cancelRequest(Request $request, $id){
        $record = ProductRequest::findOrFail($request->id);
        $record->status = 'Canceled';
        if($record->save()){
            return redirect()->back()->with(['success'=>'Request Cancelled Successfully.']);
        } else {
            return redirect()->back()->with(['error'=>'Please check your input and try again.']);
        }

    }
}
