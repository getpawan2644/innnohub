<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\SaveFavorite;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public $successStatus = 200;
    public function index(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=null;
        $userId = Auth::guard("api")->id();
        $records = SaveFavorite::with(['product.latestImage'])->where('user_id', $userId)->where('status',1);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('API_PAGINATION_LIMIT')));
        $data = $records->toArray();
        if(!empty($data['data'])){
            $response["status"]=1;
            $response["data"]=$records;
        }else {
//            $this->successStatus = 200;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }

    public function saveFavorites(Request $request){
        $user = Auth::guard("api")->user();
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=null;
        if ($user) {
            if (SaveFavorite::where('product_id', $request->product_id)->first()) {
                $message = trans('messages.fav_pro_list_update');
            } else {
                $message = trans('messages.successfuly_marked_fav');
            }
            $favorite = SaveFavorite::updateOrCreate(
                ['user_id' => $user->id, 'product_id' => $request->product_id],
                ['product_id' => $request->product_id]
            );
            $response["status"] = 1;
            $response['isFav'] = $favorite->status;
            $response["message"] = ($favorite->status)?trans('messages.successfuly_marked_fav'):trans('messages.successfuly_unmark_fav');

        } else {
            $this->successStatus = 200;
            $response["status"] = 0;
            $response["message"] = trans('messages.fav_login_error');
        }
        return response()->json($response, $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=null;
        $record = SaveFavorite::where('id',$request->id)->first();
        if(!empty($record) && $record->delete()){
            $response["status"] = 1;
            $response["message"] = trans('messages.record_delete_success');
        } else {
//            $this->successStatus = 200;
            $response["status"] = 0;
            $response["message"] = trans('messages.records_not_available');
        }
        return response()->json($response, $this->successStatus);
    }
}
