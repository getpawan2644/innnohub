<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\SaveFavorite;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index(Request $request){
        $userId = Auth::id();
        $records = SaveFavorite::with(['product.latestImage'])->where('user_id', $userId)->where('status',1);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('PAGINATION_LIMIT')));
        return view('favorites.index', compact(['records']));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = SaveFavorite::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>trans('messages.record_delete_success')]);
        } else {
            return back()->with(['error'=>trans('messages.record_delete_fail')]);
        }
    }
}