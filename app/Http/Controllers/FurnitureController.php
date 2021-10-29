<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\InviteReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    public function index(Request $request){
        $category=$request->category;
        $records = Category::with([ 'sub_categories.products.category','sub_categories.products.latestImage',
                        'sub_categories' => function($query){
                            $query->where('status','Active');
                            $query->whereHas('products', function (Builder $query) {
                                $query->where('status','Active');
                                $query->whereHas('vendor', function (Builder $query) {
                                    $query->where('status', '=', 'Active');
                                    $query->whereHas('country', function (Builder $query) {
                                        $query->where('status', '=', 'Active');
                                    });
                                });
                                $query->where(function($query){
                                    $query->orWhereHas('client', function (Builder $query) {
                                        $query->where('clients.status', '=', 'Active');
                                    });
                                    $query->orWhereNull('products.client_id');
                                });
                            });
                        },
                        'sub_categories.products' => function($q) {
                            // Query the name field in status table
                            $q->where('status', '=', "Active"); // '=' is optional
                            $q->where(function($query){
                                $query->orWhereHas('client', function (Builder $query) {
                                    $query->where('clients.status', '=', 'Active');
                                });
                                $query->orWhereNull('products.client_id');
                            });
                            $q->whereHas('vendor', function (Builder $query) {
                                $query->where('status', '=', 'Active');
                                $query->whereHas('country', function (Builder $query) {
                                    $query->where('status', '=', 'Active');
                                });
                            });
                        }
                        ])
                        ->whereHas('sub_categories', function (Builder $query) {
                            $query->where('status','Active');
                        })
                        ->whereHas('sub_categories.products.vendor', function (Builder $query) {
                            $query->where('status', '=', 'Active');
                        })->whereHas('sub_categories.products.vendor.country', function (Builder $query) {
                            $query->where('status', '=', 'Active');
                        })->WhereHas('sub_categories.products', function (Builder $query) {
                                $query->where(function($query){
                                    $query->orWhereHas('client', function (Builder $query) {
                                        $query->where('clients.status', '=', 'Active');
                                    });
                                    $query->orWhereNull('products.client_id');
                                });

                        })
                        ->where('status','Active');
            if(!empty($category)){
                $records->where("categories.slug",$category);
            }
        $records = $records->orderByTranslation("name","ASC")->get();
        return view('furniture.index',compact(['records']));
    }
}
