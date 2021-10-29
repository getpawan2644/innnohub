<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductRequest;
use App\Models\InviteReview;
use Illuminate\Http\Request;
use App\Mail\InviteForReview;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use App\Models\EmailTemplate;

class RatingController extends Controller
{
    public function index(Request $request) {
        //pr($request->all()); die;
        $records = InviteReview::with(['product']);
        if($request->query('search')){
            //die('Hii');
            $records = $records->where('name', $request->query('search'));
            $records = $records->orWhere('email', $request->query('search'));
            // $records = $records->orWhere(function($q) use ($request) {
            //     $q->orWhereHas('product', function(Builder $query) use($request){
            //         $query->orWhereTranslationLike('product_title', '%'.$request->query('search').'%');
            //         $query->orWhereTranslationLike('slug', '%'.$request->query('search').'%');
            //     });
            // });
        }
        if($request->sort && $request->direction){
            $records->orderBy($request->sort,$request->direction );
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        //dd($records->toArray());
        return view('admin.review-ratings.index',compact(['records']));
    }

    public function inviteForReview(Request $request, $id){
        //echo $id; die;
        $record = ProductRequest::findOrFail($id);
        $inviteReview = new InviteReview();
        $inviteReview->prod_req_id = @$record->id;
        $inviteReview->user_id = @$record->user_id;
        $inviteReview->name = @$record->name;
        $inviteReview->email = @$record->email;
        $inviteReview->product_slug = @$record->product_slug;
        $inviteReview->token = Hash::make(@$record->prod_req_number);
        if($inviteReview->save()){
            $this->inviteUserEmail('invite-for-review',@$record->name,@$inviteReview->email,@$inviteReview->token);
//            $this->inviteUserEmail('invite-for-review','ar',@$record->name,@$inviteReview->email,@$inviteReview->token);
            return back()->with(['success'=>'Successfully invited for review.']);
        }else {
            return back()->with(['error'=>'Something went wrong.']);
        }

    }

    public function inviteUserEmail($pageName,$name,$email,$token){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $subject = str_replace(["{user}"], [$name], $englishSubject);
        $en_message = $englishContent;
        $ar_message = $arabicContent;
        $url = route('rate-product',['token'=>$token]);
        //echo $url; die;
        Mail::to($email)->send(new InviteForReview($subject,$en_message,$ar_message,$url));
    }
}
