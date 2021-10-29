<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AjaxController extends Controller
{
    public function activeSubcategory(Request $request){
        //$records = SubCategory::where('category_id', $request->category_id)->get();
        $records = SubCategory::whereHas('Category', function (Builder $query) use($request) {
                                $query->where('slug',$request->category_slug);
                            })->get();
        $jsonRecords = [];
        foreach($records as $key => $record){
            $jsonRecords[$key]['label'] =  $record->name;
            $jsonRecords[$key]['title'] =  $record->name;
            $jsonRecords[$key]['value'] =  $record->id;
            $jsonRecords[$key]['id'] =  $record->id;
            $jsonRecords[$key]['name'] =  $record->name;
        }
        if(count($jsonRecords)==0){
            $jsonRecords[0]['label'] =  'No data';
            $jsonRecords[0]['title'] =  'No data';
            $jsonRecords[0]['value'] =  '';
            $jsonRecords[0]['id'] =  '';
            $jsonRecords[0]['name'] =  'No data';
        }
         
        //{label: 'Option 1', title: 'Option 1', value: '1', selected: true},
        return response()->json($jsonRecords);
    }
    public function getProductCode(Request $request){
        $records = Product::where('category_code',$request->category_code)
            ->where('sub_category_code',$request->sub_category_code)
            ->where('vendor_code',$request->vendor_code)
            ->where('country_code',$request->country_code)
            ->get();
        if(!$records->isEmpty()){
            $last_record = Product::where('category_code',$request->category_code)
                ->where('sub_category_code',$request->sub_category_code)
                ->where('vendor_code',$request->vendor_code)
                ->where('country_code',$request->country_code)
                ->orderBy("code","DESC")->first();
            $code=$last_record->code+1;

        }else{
            $code=1;
        }
        return $code;
    }
}
