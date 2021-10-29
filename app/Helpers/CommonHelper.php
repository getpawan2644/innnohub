<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;

use App\Model\Country;
use App\Model\Ads;
use App\Model\ad_abuses;
use App\Model\Profile;
use Illuminate\Database\Eloquent\Builder;
Use DB;
use Route;

class CommonHelper {

	const ACTIVE = 'Active';
	const INACTIVE = 'Inactive';
	const PRELIMINARY = 'Preliminary';
	const COMPLETED = 'Completed';
	const DRAFT = 'draft';
	const UNPUBLISH = 'unpublish';
	const PUBLISH = 'publish';
	const Expire = 'Expire';
	const No      = 'No';
	const Yes     = 'Yes';
	const USER_ACTIVE = 'Active';
	const USER_BLOCK = 'Block';
	const BLOCK = 'Block';
	const DISPLAY_PRICE = 1;
	const HIDE_PRICE = 0;

	public static function getLimitOption(){
		return [
			'10' => '10',
			'20' => '20',
			'30' => '30',
			'50' => '50',
			'70' => '70',
			'100' => '100'
		];
	}public static function isEditable($page_name){
		if(in_array($page_name,\App\Models\Cms::NOT_EDITABLE_PAGE)){
		    return false;
        }else{
		    return true;
        }
	}

	public static function getadStatusOption(){
		return [
			self::PUBLISH => self::PUBLISH,
			self::UNPUBLISH => self::UNPUBLISH,
			self::DRAFT => self::DRAFT,
			self::Expire => self::Expire,
			self::BLOCK => self::BLOCK
		];
	}
	public static function getuserStatusOption(){
		return [
			self::USER_ACTIVE => self::USER_ACTIVE,
			self::USER_BLOCK => self::USER_BLOCK
		];
	}
	public static function changeAdsStatus($routeName, $status,$id){
		if($status  == self::PUBLISH){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_ad_status" data-action="'.route($routeName).'" data-status="'.self::BLOCK.'" data-id="'.$id.'">'.self::PUBLISH.'</span></a>';
		} elseif($status == self::BLOCK){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_ad_status" data-action="'.route($routeName).'" data-status="'.self::PUBLISH.'" data-id="'.$id.'">'.self::BLOCK.'</span></a>';
		}
	}
	public static function getUserStatus($routeName, $status,$id){
		if($status  == self::USER_ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_user_status" data-action="'.route($routeName).'" data-status="'.self::USER_BLOCK.'" data-id="'.$id.'">'.self::USER_ACTIVE.'</span></a>';
		} elseif($status == self::USER_BLOCK){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_user_status" data-action="'.route($routeName).'" data-status="'.self::USER_ACTIVE.'" data-id="'.$id.'">'.self::USER_BLOCK.'</span></a>';
		}
	}
	public static function getFooterCategoryUpdateUrl($routeName, $status,$id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}
	}
	public static function getStatusUrl($routeName, $status,$id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}
	}
	public static function changeOfferStatus($routeName, $status,$id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}

	}public static function changeDisplayCodeStatus($routeName, $status,$id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}
	}

	public static function changeTrendingSale($routeName, $status,$id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}
	}

	public static function changeDisplayPrice($routeName, $show_price,$id){
		if($show_price  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-action="'.route($routeName).'" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($show_price == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($show_price == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-action="'.route($routeName).'" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		}
	}

	public static function displayStatus($status, $id){
		if($status  == self::ACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-success change_status" data-status="'.self::INACTIVE.'" data-id="'.$id.'">'.self::ACTIVE.'</span></a>';
		} elseif($status == self::INACTIVE){
			return '<a href="javascript:void(0);"><span class="badge badge-danger change_status" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::INACTIVE.'</span></a>';
		} elseif($status == self::PRELIMINARY){
			return '<a href="javascript:void(0);"><span class="badge badge-info change_status" data-status="'.self::ACTIVE.'" data-id="'.$id.'">'.self::PRELIMINARY.'</span></a>';
		} elseif($status == self::DRAFT){
			return '<span class="badge badge-info">'.ucfirst(self::DRAFT).'</span>';
		} elseif($status == self::UNPUBLISH){
			return '<span class="badge badge-danger">'.ucfirst(self::UNPUBLISH).'</span>';
		} elseif($status == self::PUBLISH){
			return '<span class="badge badge-success changestus">'.__('content.Published').'</span>';
		}elseif($status == self::Expire){
			return '<span class="badge badge-warning">'.__('content.Expired').'</span>';
		}elseif($status == self::BLOCK){
			return '<span class="badge badge-danger">'.__('content.Blocked').'</span>';
		}
	}

	public static function displayAppointmentStatus($appointment_status=null){
		if($appointment_status  == 'Pending'){
			return '<span class="badge badge-secondary">'.trans('content.pending').'</span>';
		} else if($appointment_status == 'Confirm'){
			return '<span class="badge badge-primary">'.trans('content.confirm').'</span>';
	    } else if($appointment_status == 'Cancel'){
			return '<span class="badge badge-danger">'.trans('content.cancel').'</span>';
	    }
	}



	public static function getStatusOption(){
		return [
			self::ACTIVE => self::ACTIVE,
			self::INACTIVE => self::INACTIVE,
			self::PRELIMINARY => self::PRELIMINARY
		];
	}

	public static function getDateRange($from,$to,$format="D"){
		$begin = new \DateTime($from);
        $end = new \DateTime($to);
        $interval = new \DateInterval('P1D');

        $datePeriodRange = new \DatePeriod($begin, $interval ,$end);

        $dateRange = array();
        $i=0;
        foreach($datePeriodRange as $date){
            $dateRange[$i++] = $date->format($format);
        }

		return $dateRange;
	}

	public static function getLanguages(){
		return Cache::rememberForever('languages', function () {
			return DB::table('languages')->where('status', 'Active')->pluck('iso_code', 'name')->toArray();
		});
	}

    public static function getAlignment($lang_code){
           $align_array = ["ar"=>"rtl","en"=>'lrt'];
            return $align_array[strtolower($lang_code)];

    }
    public static function getTextAlign($lang_code){
        $align_array = ["ar"=>"right","en"=>'left'];
        return $align_array[strtolower($lang_code)];
    }

	public static function getCountries(){
		return Cache::rememberForever('countries-'.app()->getLocale(), function () {
			return Country::where('status', 'Active')->withTranslation()->get()->toArray();
		});
	}

	public static function getLevel2AdsCount($categroryLable2){
		$getcountryCode = \App\Model\Ip2Nation::getCountryCodeFromIp(request()->ip());
        $countryCode = $getcountryCode;
        $ads = new Ads;
     //    $ads = $ads->join('ad_groups', function ($query) {
					//     $query->on('ads.ad_id','=', 'ad_groups.id')->whereIn('user_id', function($query){
					//     	$query->select(DB::raw(1))
					//     	->from('users')
					//     	->where('users.status', '!=', 'Block');
					//     });
					// });
        if(Auth::user()){
            $user=Auth::user();
            $userInfo = $user->toArray();
            $conditionsOr=[];
            if(!empty($userInfo['user_ad_country_id'])) $conditions['ad_groups.country_id']=$userInfo['user_ad_country_id'];
            if(!empty($userInfo['user_ad_state_id']))$conditionsOr['ad_groups.state_id']=$userInfo['user_ad_state_id'];
            if(!empty($userInfo['user_ad_municipality_id']))$conditionsOr['ad_groups.municipality_id']=$userInfo['user_ad_municipality_id'];
            if(!empty($userInfo['user_ad_city_id']))$conditionsOr['ad_groups.city_id']=$userInfo['user_ad_city_id'];
            $ads = $ads->join('ad_groups', function($join)use($conditions, $conditionsOr)	{
                        $join->on('ads.ad_id','=', 'ad_groups.id')
                        ->where(function($query)use($conditions, $conditionsOr) {
                        	$query->where($conditions)->orWhere($conditionsOr);
                        })->whereNotIn ('ad_groups.user_id', function($query){
					    	$query->select(DB::raw(1))
					    	->from('users')
					    	->where('users.status', '=', '%Block%');
					    });;
                    });
        }else{
            $ads = $ads->join('ad_groups', function($join){
                        $join->on('ads.ad_id','=', 'ad_groups.id')
                        ->whereNotIn ('ad_groups.user_id', function($query){
					    	$query->select(DB::raw(1))
					    	->from('users')
					    	->where('users.status', '=', '%Block%');
					    });;
                    })->where('ads.country_code','like', '%'.$countryCode.'%');
        }
        //dd(Auth::user()->toArray());
		$adsCount = $ads->where('category_level_2', '=', $categroryLable2)->where('ads.status','like','%publish%')->count();
		return $adsCount;
	}

	public static function getAdsCount($categroryLable3){
		$getcountryCode = \App\Model\Ip2Nation::getCountryCodeFromIp(request()->ip());
        $countryCode = $getcountryCode;
        $ads = new Ads;
     //    $ads = $ads->join('ad_groups', function ($query) {
					//     $query->on('ads.ad_id','=', 'ad_groups.id')->whereIn('user_id', function($query){
					//     	$query->select(DB::raw(1))
					//     	->from('users')
					//     	->where('users.status', '!=', 'Block');
					//     });
					// });
        if(Auth::user()){
            $user=Auth::user();
            $userInfo = $user->toArray();
            $conditionsOr=[];
            if(!empty($userInfo['user_ad_country_id'])) $conditions['ad_groups.country_id']=$userInfo['user_ad_country_id'];
            if(!empty($userInfo['user_ad_state_id']))$conditionsOr['ad_groups.state_id']=$userInfo['user_ad_state_id'];
            if(!empty($userInfo['user_ad_municipality_id']))$conditionsOr['ad_groups.municipality_id']=$userInfo['user_ad_municipality_id'];
            if(!empty($userInfo['user_ad_city_id']))$conditionsOr['ad_groups.city_id']=$userInfo['user_ad_city_id'];
            $ads = $ads->join('ad_groups', function($join)use($conditions, $conditionsOr)	{
                        $join->on('ads.ad_id','=', 'ad_groups.id')
                        ->where(function($query)use($conditions, $conditionsOr) {
                        	$query->where($conditions)->orWhere($conditionsOr);
                        })->whereNotIn ('ad_groups.user_id', function($query){
					    	$query->select(DB::raw(1))
					    	->from('users')
					    	->where('users.status', '=', '%Block%');
					    });;
                    });
        }else{
            $ads = $ads->join('ad_groups', function($join){
                        $join->on('ads.ad_id','=', 'ad_groups.id')
                        ->whereNotIn ('ad_groups.user_id', function($query){
					    	$query->select(DB::raw(1))
					    	->from('users')
					    	->where('users.status', '=', '%Block%');
					    });;
                    })->where('ads.country_code','like', '%'.$countryCode.'%');
        }
        //dd(Auth::user()->toArray());
		$adsCount = $ads->where('category_level_3', '=', $categroryLable3)->where('ads.status','like','%publish%')->count();
		return $adsCount;
	}

	public static function getCategories($parent_id)
    {
		if(!$parent_id){
			return response()->json([]);
		} else {
			$category =  Category::where(['status' => Category::ACTIVE])
					->where('parent_id',$parent_id)
					->withTranslation()
					->orderByTranslation('name','asc')
					->get()
					->toArray();
			return $category;
		}
	}

	public static function gitTimeOtions( $default = '', $interval = '+15 minutes' ) {
		$output = '';
		$current = strtotime( '00:00' );
		$end = strtotime( '23:59' );
		while( $current <= $end ) {
			$time = date( 'H:i', $current );
			$sel = ( $time == $default ) ? ' selected' : '';

			$output .= "<option value=\"{$time}\"{$sel}>" . date( 'H:i', $current ) .'</option>';
			$current = strtotime( $interval, $current );
		}
		return $output;
	}
    public static function getallowRoutes(){
    //use App\Models\Admin;
        $subadmin=\App\Models\Admin::SUBADMIN;
        $admin=\App\Models\Admin::ADMIN;
        $routeName = Route::currentRouteName();
        $user = Auth::user();
        $public_routes=[
            'admin.showProfileForm',
            'admin.updateProfile',
            'admin.updateProfilePic',
            'admin.showPasswordForm',
            'admin.updatePassword',
        ];
        $allowed_routes=["admin.dashboard.index"];
        /*Explode via $ and get the modules wise allow routes*/
        $modules_route= @explode('$',$user->modules);
        //dd($modules_route);
        $route_permissions=array();
        foreach($modules_route as $key =>$module_route){
            $route_permissions=array_merge($route_permissions,@explode('|',$module_route));
        }
        $route_permissions=array_unique($route_permissions);
        $allowed_routes = array_merge($allowed_routes,$public_routes);
        $allowed_routes = array_merge($allowed_routes,$route_permissions);
        //dd($allowed_routes);
return $allowed_routes;
    }
	public static function getAdminModules(){
        $route = array(
            'Country Management' => array(
                'Only View' => 'admin.countries.index|admin.countries.csv',
                'Add/Edit' => 'admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.store|admin.countries.update|admin.countries.csv',
                'Delete' => 'admin.countries.index|admin.countries.destroy|admin.countries.csv',
                'Full Admin Access' => 'admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update|admin.countries.csv'
            ),
            'Banner Management' => Array(
                'Only View' => 'admin.banners.index',
                'Add/Edit' => 'admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.store|admin.banners.update',
                'Delete' => 'admin.banners.index|admin.banners.destroy',
                'Full Admin Access' => 'admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates',
            ),
            'Advertisement Management' => Array(
                'Only View' => 'admin.advertisements.index',
                'Add/Edit' => 'admin.advertisements.index||admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage',
                'Delete' => 'admin.advertisements.index|admin.advertisements.destroy',
                'Full Admin Access' => 'admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage',
            ),
            'Factory / Vendor Management'=> Array(
                'Only View' => 'admin.vendors.index|admin.vendors.export.csv|admin.vendors.csv',
                'Add/Edit' => 'admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one',
                'Delete' => 'admin.vendors.index|admin.vendors.destroy|admin.export.analytics.csv|admin.vendors.csv',
                'Full Admin Access' => 'admin.vendors.index|admin.vendors.create|admin.vendors.edit|admin.vendors.store|admin.vendors.update|admin.vendors.changeStatus|admin.vendors.changeOfferStatus|admin.vendors.destroy|admin.vendors.clientAjaxImageUpload|admin.vendors.clientAjaxLogoImageUpload|admin.vendors.clientRemoveImage|admin.vendors.clientRemoveLogoImage|admin.vendors.export.csv|admin.vendors.csv|admin.vendors.export_one'
            ),
            'Category Management' => Array(
                'Only View' => 'admin.categories.index|admin.categories.csv',
                'Add/Edit' => 'admin.categories.index||admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.csv|admin.category.postAjaxImg',
                'Delete' => 'admin.categories.index|admin.categories.csv|admin.categories.destroy',
                'Full Admin Access' => 'admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.category.postAjaxImg',
            ),
            'SubCategory Management' => Array(
                'Only View' => 'admin.sub_categories.index|admin.sub_categories.csv',
                'Add/Edit' => 'admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.csv|admin.ajax.subcategory',
                'Delete' => 'admin.sub_categories.index|admin.sub_categories.destroy|admin.sub_categories.csv',
                'Full Admin Access' => 'admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory',
            ),
            'Product Management' => Array(
                'Only View' => 'admin.products.index|admin.products.normal-csv|admin.products.image-csv|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.index.status|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv',
                'Add/Edit' => 'admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.changeProductDisplayStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv',
                'Delete' => 'admin.products.index|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.index.status|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv',
                'Full Admin Access' => 'admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.changeProductDisplayStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage|admin.products.export_one|admin.products.analytics.csv|admin.products.get_images|admin.products.image.reorder|admin.products.marked_featured|admin.ajax.get_product_code|admin.products.index.status|admin.products.display_discount|admin.products-status.normal-csv|admin.products-status.image-csv|admin.products-status.analytics.csv',
            ),
            'Product Request' => Array(
                'Only View' => 'admin.all-requests|admin.review-ratings',
                'Order-Status/Customer-Message/Invite-review' => 'admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review|edit',
                'Delete' => 'disabled',
                'Full Admin Access' => 'admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review',
            ),
            'User Management' => Array(
                'Only View' => 'admin.users.index|admin.users.csv',
                'Add/Edit' => 'admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message',
                'Delete' => 'admin.users.index|admin.users.destroy',
                'Full Admin Access' => 'admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv'
            ),
            'Appointment Management' => Array(
                'Only View' => 'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.show||admin.appointment.csv',
                'Add-Appointment /Edit-Appointment' => 'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show',
                'Delete/Cancel-appointment/Reschedule-appointment' => 'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.show||admin.appointment.csv',
                'Full Admin Access' => 'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show'
            ),
            'Messages' => Array(
                'Only View' => 'admin.message.index',
                'View-Full-Conversation / Reply' => 'admin.message.index|admin.message.message|admin.message-reply|reply',
                'Delete' => 'disabled',
                'Full Admin Access' => 'admin.message.index|admin.message.message|admin.message-reply'
            ),
            'Client Category' => Array(
                'Only View' => 'admin.client_categories.index',
                'Add/Edit' => 'admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.csv',
                'Delete' => 'admin.client_categories.index|admin.client_categories.destroy|admin.client_categories.csv',
                'Full Admin Access' => 'admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv'
            ),
            'Client Management'=> Array(
                'Only View' => 'admin.clients.index|admin.clients.analytics.csv|admin.clients.csv',
                'Add/Edit' => 'admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|clients.changeFeatured|admin.clients.changeOfferStatus|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one',
                'Delete' => 'admin.clients.index|admin.clients.destroy|admin.clients.analytics.csv|admin.clients.csv',
                'Full Admin Access' => 'admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|clients.changeFeatured|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one'
            ),
            'CMS Management' => Array(
                'Only View' => 'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index',
                'Add/Edit' => 'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus',
                'Delete' => 'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.privacy_policies.destroy|admin.term_conditions.destroy',
                'Full Admin Access' => 'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy'
            ),
            'FAQ Management' => Array(
                'Only View' => 'admin.faqs.index',
                'Add/Edit' => 'admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus',
                'Delete' => 'admin.faqs.index|admin.faqs.destroy',
                'Full Admin Access' => 'admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy'
            ),
            'Sub-Admins Management' => Array(
                'Only View' => 'admin.admins.index',
                'Add/Edit' => 'admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.store|admin.admins.update',
                'Delete' => 'admin.admins.index|admin.admins.destroy',
                'Full Admin Access' => 'admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update',
            ),
            'Email Template' => Array(
                'Only View' => 'admin.email-template.index',
                'Edit' => 'admin.email-template.index|admin.email-template.edit|admin.email-template.update|edit',
                'Delete' => 'disabled',
                'Full Admin Access' => 'admin.email-template.index|admin.email-template.edit|admin.email-template.update'
            ),
            'Settings' => Array(
                'Only View' => 'admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index',
                'Edit' => 'admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks|edit',
                'Delete' => 'disabled',
                'Full Admin Access' => 'admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks'
            )
        );

        return $route;




//        $routes=array(
//        'Country Management' => [
//            'admin.countries.index'=>"Only View",
//            'admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.store|admin.countries.update'=>"Add/Edit",
//            'admin.countries.index|admin.countries.destroy'=>"Delete",
//            'admin.countries.index|admin.countries.create|admin.countries.changeStatus|admin.countries.edit|admin.countries.destroy|admin.countries.store|admin.countries.update'=>"Full Admin Access"
//        ],
//        'Banner Management' => [
//            'admin.banners.index'=>"Only View",
//            'admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.store|admin.banners.update|'=>"Add/Edit",
//            'admin.banners.index|admin.banners.destroy'=>"Delete",
//            'admin.banners.index|admin.banners.create|admin.banners.edit|admin.banners.changeStatus|admin.banners.destroy|admin.banners.store|admin.banners.update|admin.banners.show|admin.banners.getStates'=>"Full Admin Access"
//        ],
//        'Advertisement Management' => [
//            'admin.advertisements.index'=>"Only View",
//            'admin.advertisements.index||admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage'=>"Add/Edit",
//            'admin.advertisements.index|admin.advertisements.destroy'=>"Delete",
//            'admin.advertisements.index|admin.advertisements.create|admin.advertisements.edit|admin.advertisements.changeStatus|admin.advertisements.destroy|admin.advertisements.store|admin.advertisements.update|admin.advertisements.clientAjaxLogoImageUpload|admin.advertisements.clientRemoveImage'=>"Full Admin Access"
//        ],
//        'Category Management'=> [
//            'admin.categories.index|admin.categories.csv'=>"Only View",
//            'admin.categories.index||admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.csv|admin.categories.postAjaxImg'=>"Add/Edit",
//            'admin.categories.index|admin.categories.csv|admin.categories.destroy'=>"Delete",
//            'admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.store|admin.categories.update|admin.categories.topCategory|admin.categories.changeStatus|admin.categories.changeFooterStatus|admin.categories.destroy|admin.categories.csv|admin.categories.postAjaxImg'=>"Full Admin Access"
//        ],
//        'SubCategory Management' => [
//            'admin.sub_categories.index|admin.sub_categories.csv'=>"Only View",
//            'admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.csv|admin.ajax.subcategory'=>"Add/Edit",
//            'admin.sub_categories.index|admin.sub_categories.destroy|admin.sub_categories.csv'=>"Delete",
//            'admin.sub_categories.index|admin.sub_categories.create|admin.sub_categories.edit|admin.sub_categories.store|admin.sub_categories.update|admin.sub_categories.topCategory|admin.sub_categories.changeStatus|admin.sub_categories.destroy|admin.sub_categories.csv|admin.ajax.subcategory'=>"Full Admin Access"
//        ],
//        'Product Management' => [
//            'admin.products.index|admin.products.normal-csv|admin.products.image-csv'=>"Only View",
//            'admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage'=>"Add/Edit",
//            'admin.products.index|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv'=>"Delete",
//            'admin.products.index|admin.products.create|admin.products.changeStatus|admin.products.edit|admin.products.changeOfferStatus|admin.products.trendingSale|admin.products.displayPrice|admin.products.destroy|admin.products.normal-csv|admin.products.image-csv|admin.products.store|admin.products.update|admin.products.productAjaxImageUpload|admin.products.productRemoveImage'=>"Full Admin Access"
//        ],
//        'Product Request' => [
//            'admin.all-requests|admin.review-ratings'=>"Only View",
//            '||admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review'=>"Order-Status/Customer-Message/Invite-review",
//            'disabled'=>"Delete",
//            'admin.all-requests|admin.review-ratings|admin.product-request|admin.all-request|admin.product-request.change-status|admin.product-request.message|admin.product-request.sent-message|admin.all-requests.csv|admin.invite-for-review'=>"Full Admin Access"
//        ],
//        'User Management' => [
//            'admin.users.index|admin.users.csv'=>"Only View",
//            'admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message'=>"Add/Edit",
//            'admin.users.index|admin.users.destroy'=>"Delete",
//            'admin.users.index|admin.users.create|admin.users.edit|admin.users.changeStatus|admin.users.destroy|admin.users.store|admin.users.update|admin.users.show|admin.users.getStates|admin.users.reset_link|admin.users.message|admin.users.sent-message|admin.users.csv'=>"Full Admin Access"
//        ],
//        'Appointment Management' => [
//            'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.show||admin.appointment.csv'=>"Only View",
//            'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show'=>"Add-Appointment /Edit-Appointment",
//            'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.show||admin.appointment.csv'=>"Delete/Cancel-appointment/Reschedule-appointment ",
//            'admin.appointment.booking-detail|admin.appointment.index|admin.appointment.all-appointments|admin.appointment.changeStatus|admin.appointment.destroy|admin.appointment.cancel-appointment|admin.appointment.reschedule-appointment|admin.appointment.csv|admin.appointment.store|admin.appointment.create|admin.appointment.edit|admin.appointment.update|admin.appointment.show'=>"Full Admin Access"
//        ],
//        'Messages'=> [
//            'admin.message.index'=>"Only View",
//            '||admin.message.index|admin.message.message|admin.message-reply'=>"View-Full-Conversation / Reply",
//            'disabled'=>"Delete",
//            'admin.message.index|admin.message.message|admin.message-reply'=>"Full Admin Access"
//        ],
//        'Client Category|admin.client_categories.csv' => [
//            'admin.client_categories.index'=>"Only View",
//            'admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.csv'=>"Add/Edit",
//            'admin.client_categories.index|admin.client_categories.destroy|admin.client_categories.csv'=>"Delete",
//            'admin.client_categories.index|admin.client_categories.create|admin.client_categories.edit|admin.client_categories.store|admin.client_categories.update|admin.client_categories.topCategory|admin.client_categories.changeStatus|admin.client_categories.destroy|admin.client_categories.csv'=>"Full Admin Access"
//        ],
//        'Client Management' => [
//            'admin.clients.index|admin.clients.analytics.csv|admin.clients.csv'=>"Only View",
//            'admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one'=>"Add/Edit",
//            'admin.clients.index|admin.clients.destroy|admin.clients.analytics.csv|admin.clients.csv'=>"Delete",
//            'admin.clients.index|admin.clients.create|admin.clients.edit|admin.clients.store|admin.clients.update|admin.clients.changeStatus|admin.clients.changeOfferStatus|admin.clients.destroy|admin.clients.clientAjaxImageUpload|admin.clients.clientAjaxLogoImageUpload|admin.clients.clientRemoveImage|admin.clients.clientRemoveLogoImage|admin.clients.analytics.csv|admin.clients.csv|admin.clients.export_one'=>"Full Admin Access"
//        ],
//        'CMS Management' => [
//            'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index'=>"Only View",
//            'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus'=>"Add/Edit",
//            'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.privacy_policies.destroy|admin.term_conditions.destroy'=>"Delete",
//            'admin.cms.contact-detail-edit|admin.cms.index|admin.privacy_policies.index|admin.term_conditions.index|admin.cms.create|admin.cms.edit|admin.cms.store|admin.cms.update|admin.cms.destroy|admin.cms.changeStatus|admin.cms.contact-detail-edit|admin.cms.contact-detail-update|admin.privacy_policies.edit|admin.privacy_policies.create|admin.privacy_policies.store|admin.privacy_policies.update|admin.privacy_policies.topCategory|admin.privacy_policies.changeStatus|admin.privacy_policies.destroy|admin.term_conditions.edit|admin.term_conditions.create|admin.term_conditions.store|admin.term_conditions.update|admin.term_conditions.topCategory|admin.term_conditions.changeStatus|admin.term_conditions.destroy'=>"Full Admin Access"
//        ],
//        'FAQ Management' => [
//            'admin.faqs.index'=>"Only View",
//            'admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus'=>"Add/Edit",
//            'admin.faqs.index|admin.faqs.destroy'=>"Delete",
//            'admin.faqs.index|admin.faqs.create|admin.faqs.edit|admin.faqs.store|admin.faqs.update|admin.faqs.topCategory|admin.faqs.changeStatus|admin.faqs.destroy'=>"Full Admin Access"
//        ],
//        'Sub-Admins Management' => [
//            'admin.admins.index'=>"Only View",
//            'admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.store|admin.admins.update'=>"Add/Edit",
//            'admin.admins.index|admin.admins.destroy'=>"Delete",
//            'admin.admins.index|admin.admins.create|admin.admins.changeStatus|admin.admins.edit|admin.admins.destroy|admin.admins.store|admin.admins.update'=>"Full Admin Access"
//        ],
//        'Email Template' => [
//            'admin.email-template.index'=>"Only View",
//            '||admin.email-template.index|admin.email-template.edit|admin.email-template.update'=>"Edit",
//            'disabled'=>"Delete",
//            'admin.email-template.index|admin.email-template.edit|admin.email-template.update'=>"Full Admin Access"
//        ],
//        'Settings' => [
//            'admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index'=>"Only View",
//            '||admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks'=>"Edit",
//            'disabled'=>"Delete",
//            'admin.settings.socialLinks|admin.settings.siteSettings|admin.settings.index|admin.settings.updateSiteSettings|admin.settings.updateSocialLinks'=>"Full Admin Access"
//        ],
//);
//return $routes;

//		return [
//            'Public Routes'=>[
//                'admin.showProfileForm',
//                'admin.updateProfile',
//                'admin.updateProfilePic',
//                'admin.showPasswordForm',
//                'admin.updatePassword',
//            ],
//			'Country Management'=>[
//				'admin.countries.index' => 'Country List',
//				'admin.countries.create' => 'Country Create',
//				'admin.countries.changeStatus' => 'Country changeStatus',
//				'admin.countries.edit' => 'Country Edit',
//				'admin.countries.destroy' => 'Country destroy',
//				'admin.countries.store' => 'Country store',
//				'admin.countries.update' => 'Country update',
//			],
//			'Banner Management' => [
//			    'admin.banners.index' => 'Only View',
//				'admin.banners.create' => 'Banner Create',
//				'admin.banners.edit' => 'Banner Edit',
//				'admin.banners.changeStatus' => 'Banner status',
//				'admin.banners.destroy' => 'Banner delete',
//				'admin.banners.store' => 'Banner store',
//				'admin.banners.update' => 'Banner update',
//				'admin.banners.show' => 'Banner show',
//				'admin.banners.getStates' => 'Banner getStates',
//			],
//			'Advertisement Management' => [
//				'admin.advertisements.index' => 'Advertisement List',
//				'admin.advertisements.create' => 'Advertisement Create',
//				'admin.advertisements.edit' => 'Advertisement Edit',
//				'admin.advertisements.changeStatus' => 'Advertisement changeStatus',
//				'admin.advertisements.destroy' => 'Advertisement destroy',
//				'admin.advertisements.store' => 'Advertisement store',
//				'admin.advertisements.update' => 'Advertisement update',
//				'admin.advertisements.clientAjaxLogoImageUpload' => 'Advertisement clientAjaxLogoImageUpload',
//				'admin.advertisements.clientRemoveImage' => 'Advertisement clientRemoveImage',
//			],
//			'Category Management' => [
//				'admin.categories.index' => 'Category List',
//				'admin.categories.create' => 'Category Create',
//				'admin.categories.edit' => 'Category Edit',
//				'admin.categories.store' => 'Category store',
//				'admin.categories.update' => 'Category update',
//				'admin.categories.topCategory' => 'Category topCategory',
//				'admin.categories.changeStatus' => 'Category changeStatus',
//				'admin.categories.changeFooterStatus' => 'Category changeFooterStatus',
//				'admin.categories.destroy' => 'Category destroy',
//				'admin.categories.csv' => 'Category csv',
//				'admin.categories.postAjaxImg' => 'Category postAjaxImg',
//			],
//			'SubCategory Management' => [
//				'admin.sub_categories.index' => 'Subcategory List',
//				'admin.sub_categories.create' => 'Subcategory Create',
//				'admin.sub_categories.edit' => 'Subcategory Edit',
//				'admin.sub_categories.store' => 'Subcategory store',
//				'admin.sub_categories.update' => 'Subcategory update',
//				'admin.sub_categories.topCategory' => 'Subcategory topCategory',
//				'admin.sub_categories.changeStatus' => 'Subcategory changeStatus',
//				'admin.sub_categories.destroy' => 'Subcategory destroy',
//				'admin.sub_categories.csv' => 'Subcategory csv',
//				'admin.ajax.subcategory' => 'ajax.subcategory',
//			],
//			'Product Management' => [
//				'admin.products.index' => 'Product List',
//				'admin.products.create' => 'Product Create',
//				'admin.products.changeStatus' => 'Product changeStatus',
//				'admin.products.edit' => 'Product Edit',
//				'admin.products.changeOfferStatus' => 'Product changeOfferStatus',
//				'admin.products.trendingSale' => 'Product trendingSale',
//				'admin.products.displayPrice' => 'Product displayPrice',
//				'admin.products.destroy' => 'Product destroy',
//				'admin.products.normal-csv' => 'Product normal-csv',
//				'admin.products.image-csv' => 'Product image-csv',
//				'admin.products.store' => 'Product store',
//				'admin.products.update' => 'Product update',
//				'admin.products.productAjaxImageUpload' => 'Product productAjaxImageUpload',
//				'admin.products.productRemoveImage' => 'Product productRemoveImage',
//			],
//			'Product Request' => [
//				'admin.all-requests' => 'All Request',
//				'admin.product-request' => 'product-request',
//				'admin.all-request' => 'all-request',
//				'admin.product-request.change-status' => 'product-request.change-status',
//				'admin.product-request.message' => 'product-request.message',
//				'admin.product-request.sent-message' => 'product-request.sent-message',
//				'admin.review-ratings' => 'Review and Rating',
//				'admin.all-requests.csv' => 'all-requests.csv',
//				'admin.invite-for-review' => 'invite-for-review',
//			],
//			'User Management' => [
//				'admin.users.index' => 'All Users',
//				'admin.users.create' => 'Create User',
//				'admin.users.edit' => 'Edit User',
//				'admin.users.changeStatus' => 'Edit changeStatus',
//				'admin.users.destroy' => 'Edit destroy',
//				'admin.users.store' => 'Edit store',
//				'admin.users.update' => 'Edit update',
//				'admin.users.show' => 'Edit show',
//				'admin.users.getStates' => 'Edit getStates',
//				'admin.users.reset_link' => 'Edit reset_link',
//				'admin.users.message' => 'Edit message',
//				'admin.users.sent-message' => 'Edit sent-message',
//				'admin.users.csv' => 'Edit csv',
//			],
//			'Appointment Management' => [
//				'admin.appointment.index' => 'Appointment Dates',
//				'admin.appointment.booking-detail' => 'Booking Details',
//				'admin.appointment.changeStatus' => 'changeStatus',
//				'admin.appointment.all-appointments' => 'All Appointments',
//                'admin.appointment.destroy' => 'destroy',
//                'admin.appointment.cancel-appointment' => 'cancel-appointment',
//                'admin.appointment.reschedule-appointment' => 'reschedule-appointment',
//                'admin.appointment.csv' => 'csv',
//                'admin.appointment.store' => 'store',
//                'admin.appointment.create' => 'create',
//                'admin.appointment.edit' => 'edit',
//                'admin.appointment.update' => 'update',
//                'admin.appointment.show' => 'show',
//			],
//			'Messages' => [
//				'admin.message.index' => 'Message List',
//				'admin.message.message' => 'Message Board',
//				'admin.message-reply' => 'Message Reply'
//			],
//			'Client Category' => [
//				'admin.client_categories.index' => 'Client Categories',
//				'admin.client_categories.create' => 'Clent Category Create',
//				'admin.client_categories.edit' => 'Clent Category Edit',
//				'admin.client_categories.store' => 'Clent Category store',
//				'admin.client_categories.update' => 'Clent Category update',
//				'admin.client_categories.topCategory' => 'Clent Category topCategory',
//				'admin.client_categories.changeStatus' => 'Clent Category changeStatus',
//				'admin.client_categories.destroy' => 'Clent Category destroy',
//				'admin.client_categories.csv' => 'Clent Category csv',
//			],
//			'Client Management' => [
//				'admin.clients.index' => 'Client List',
//				'admin.clients.create' => 'Client Create',
//				'admin.clients.edit' => 'Client Edit',
//				'admin.clients.store' => 'Client store',
//				'admin.clients.update' => 'Client update',
//				'admin.clients.changeStatus' => 'Client changeStatus',
//				'admin.clients.changeOfferStatus' => 'Client changeOfferStatus',
//				'admin.clients.destroy' => 'Client destroy',
//				'admin.clients.clientAjaxImageUpload' => 'Client clientAjaxImageUpload',
//				'admin.clients.clientAjaxLogoImageUpload' => 'Client clientAjaxLogoImageUpload',
//				'admin.clients.clientRemoveImage' => 'Client clientRemoveImage',
//				'admin.clients.clientRemoveLogoImage' => 'Client clientRemoveLogoImage',
//				'admin.clients.analytics.csv' => 'Client analytics.csv',
//				'admin.clients.csv' => 'Client csv',
//				'admin.clients.export_one' => 'Client export_one',
//			],
//			'CMS Management' => [
//				'admin.cms.index' => 'Cms List',
//				'admin.cms.create' => 'Create Cms',
//				'admin.cms.edit' => 'Edit Cms',
//				'admin.cms.store' => 'Edit store',
//				'admin.cms.update' => 'Edit update',
//				'admin.cms.destroy' => 'Edit destroy',
//				'admin.cms.changeStatus' => 'Edit changeStatus',
//				'admin.cms.contact-detail-edit' => 'Edit Contact Details',
//				'admin.cms.contact-detail-update' => 'contact-detail-update',
//				'admin.privacy_policies.index' => 'Privacy Policies',
//				'admin.privacy_policies.edit' => 'Edit Privacy Policy',
//				'admin.privacy_policies.create' => 'Create Privacy Policy',
//				'admin.privacy_policies.store' => 'store Privacy Policy',
//				'admin.privacy_policies.update' => 'update Privacy Policy',
//				'admin.privacy_policies.topCategory' => 'topCategory Privacy Policy',
//				'admin.privacy_policies.changeStatus' => 'changeStatus Policy',
//				'admin.privacy_policies.destroy' => 'destroy Privacy Policy',
//				'admin.term_conditions.index' => 'Terms and Conditions',
//				'admin.term_conditions.edit' => 'Edit Terms and Condition',
//				'admin.term_conditions.create' => 'Create Terms and Conditions',
//				'admin.term_conditions.create' => 'Create Terms and Conditions',
//				'admin.term_conditions.store' => 'store Terms and Conditions',
//				'admin.term_conditions.update' => 'update Terms and Conditions',
//				'admin.term_conditions.topCategory' => 'topCategory Terms and Conditions',
//				'admin.term_conditions.changeStatus' => 'changeStatus Terms and Conditions',
//				'admin.term_conditions.destroy' => 'destroy Terms and Conditions',
//			],
//			'FAQ Management' => [
//				'admin.faqs.index'=>'FAQ List',
//				'admin.faqs.create' => 'Create FAQ',
//				'admin.faqs.edit' => 'Edit FAQ',
//				'admin.faqs.store' => 'store FAQ',
//				'admin.faqs.update' => 'update FAQ',
//				'admin.faqs.topCategory' => 'topCategory FAQ',
//				'admin.faqs.changeStatus' => 'changeStatus FAQ',
//				'admin.faqs.destroy' => 'destroy FAQ',
//			],
//            'Sub-Admins Management' => [
//				'admin.admins.index'=>'Admin Index',
//				'admin.admins.create'=>'Admin create',
//				'admin.admins.changeStatus'=>'Admin changeStatus',
//				'admin.admins.edit'=>'Admin edit',
//				'admin.admins.destroy'=>'Admin destroy',
//				'admin.admins.store'=>'Admin store',
//				'admin.admins.update'=>'Admin update',
//			],
//			'Email Template' => [
//				'admin.email-template.index' => 'Email Template',
//				'admin.email-template.edit' => 'Edit Email Template',
//				'admin.email-template.update' => 'Update Email Template'
//			],
//			'Settings' => [
//				'admin.settings.index' => 'Settings',
//				'admin.settings.siteSettings' => 'Site Settings',
//				'admin.settings.socialLinks' => 'Social Links',
//				'admin.settings.updateSiteSettings' => 'Update Site settings',
//				'admin.settings.updateSocialLinks' => 'updateSocialLinks',
//			]
//		];
	}

	public static function getIcons() {
		return array(
			array(
				'key' => 'arrows',
				'label' => 'Arrows & Direction Icons',
				'icons' => array(
					'ti-arrow-up' => 'arrow-up',
					'ti-arrow-right' => 'arrow-right',
					'ti-arrow-left' => 'arrow-left',
					'ti-arrow-down' => 'arrow-down',
					'ti-arrows-vertical' => 'arrows-vertical',
					'ti-arrows-horizontal' => 'arrows-horizontal',
					'ti-angle-up' => 'angle-up',
					'ti-angle-right' => 'angle-right',
					'ti-angle-left' => 'angle-left',
					'ti-angle-down' => 'angle-down',
					'ti-angle-double-up' => 'angle-double-up',
					'ti-angle-double-right' => 'angle-double-right',
					'ti-angle-double-left' => 'angle-double-left',
					'ti-angle-double-down' => 'angle-double-down',
					'ti-move' => 'move',
					'ti-fullscreen' => 'fullscreen',
					'ti-arrow-top-right' => 'arrow-top-right',
					'ti-arrow-top-left' => 'arrow-top-left',
					'ti-arrow-circle-up' => 'arrow-circle-up',
					'ti-arrow-circle-right' => 'arrow-circle-right',
					'ti-arrow-circle-left' => 'arrow-circle-left',
					'ti-arrow-circle-down' => 'arrow-circle-down',
					'ti-arrows-corner' => 'arrows-corner',
					'ti-split-v' => 'split-v',
					'ti-split-v-alt' => 'split-v-alt',
					'ti-split-h' => 'split-h',
					'ti-hand-point-up' => 'hand-point-up',
					'ti-hand-point-right' => 'hand-point-right',
					'ti-hand-point-left' => 'hand-point-left',
					'ti-hand-point-down' => 'hand-point-down',
					'ti-back-right' => 'back-right',
					'ti-back-left' => 'back-left',
					'ti-exchange-vertical' => 'exchange-vertical',
				)
			),
			array(
				'key' => 'web',
				'label' => 'Web App Icons',
				'icons' => array(
					'ti-wand' => 'wand',
					'ti-save' => 'save',
					'ti-save-alt' => 'save-alt',
					'ti-direction' => 'direction',
					'ti-direction-alt' => 'direction-alt',
					'ti-user' => 'user',
					'ti-link' => 'link',
					'ti-unlink' => 'unlink',
					'ti-trash' => 'trash',
					'ti-target' => 'target',
					'ti-tag' => 'tag',
					'ti-desktop' => 'desktop',
					'ti-tablet' => 'tablet',
					'ti-mobile' => 'mobile',
					'ti-email' => 'email',
					'ti-star' => 'star',
					'ti-spray' => 'spray',
					'ti-signal' => 'signal',
					'ti-shopping-cart' => 'shopping-cart',
					'ti-shopping-cart-full' => 'shopping-cart-full',
					'ti-settings' => 'settings',
					'ti-search' => 'search',
					'ti-zoom-in' => 'zoom-in',
					'ti-zoom-out' => 'zoom-out',
					'ti-cut' => 'cut',
					'ti-ruler' => 'ruler',
					'ti-ruler-alt-2' => 'ruler-alt-2',
					'ti-ruler-pencil' => 'ruler-pencil',
					'ti-ruler-alt' => 'ruler-alt',
					'ti-bookmark' => 'bookmark',
					'ti-bookmark-alt' => 'bookmark-alt',
					'ti-reload' => 'reload',
					'ti-plus' => 'plus',
					'ti-minus' => 'minus',
					'ti-close' => 'close',
					'ti-pin' => 'pin',
					'ti-pencil' => 'pencil',
					'ti-pencil-alt' => 'pencil-alt',
					'ti-paint-roller' => 'paint-roller',
					'ti-paint-bucket' => 'paint-bucket',
					'ti-na' => 'na',
					'ti-medall' => 'medall',
					'ti-medall-alt' => 'medall-alt',
					'ti-marker' => 'marker',
					'ti-marker-alt' => 'marker-alt',
					'ti-lock' => 'lock',
					'ti-unlock' => 'unlock',
					'ti-location-arrow' => 'location-arrow',
					'ti-layout' => 'layout',
					'ti-layers' => 'layers',
					'ti-layers-alt' => 'layers-alt',
					'ti-key' => 'key',
					'ti-image' => 'image',
					'ti-heart' => 'heart',
					'ti-heart-broken' => 'heart-broken',
					'ti-hand-stop' => 'hand-stop',
					'ti-hand-open' => 'hand-open',
					'ti-hand-drag' => 'hand-drag',
					'ti-flag' => 'flag',
					'ti-flag-alt' => 'flag-alt',
					'ti-flag-alt-2' => 'flag-alt-2',
					'ti-eye' => 'eye',
					'ti-import' => 'import',
					'ti-export' => 'export',
					'ti-cup' => 'cup',
					'ti-crown' => 'crown',
					'ti-comments' => 'comments',
					'ti-comment' => 'comment',
					'ti-comment-alt' => 'comment-alt',
					'ti-thought' => 'thought',
					'ti-clip' => 'clip',
					'ti-check' => 'check',
					'ti-check-box' => 'check-box',
					'ti-camera' => 'camera',
					'ti-announcement' => 'announcement',
					'ti-brush' => 'brush',
					'ti-brush-alt' => 'brush-alt',
					'ti-palette' => 'palette',
					'ti-briefcase' => 'briefcase',
					'ti-bolt' => 'bolt',
					'ti-bolt-alt' => 'bolt-alt',
					'ti-blackboard' => 'blackboard',
					'ti-bag' => 'bag',
					'ti-world' => 'world',
					'ti-wheelchair' => 'wheelchair',
					'ti-car' => 'car',
					'ti-truck' => 'truck',
					'ti-timer' => 'timer',
					'ti-ticket' => 'ticket',
					'ti-thumb-up' => 'thumb-up',
					'ti-thumb-down' => 'thumb-down',
					'ti-stats-up' => 'stats-up',
					'ti-stats-down' => 'stats-down',
					'ti-shine' => 'shine',
					'ti-shift-right' => 'shift-right',
					'ti-shift-left' => 'shift-left',
					'ti-shift-right-alt' => 'shift-right-alt',
					'ti-shift-left-alt' => 'shift-left-alt',
					'ti-shield' => 'shield',
					'ti-notepad' => 'notepad',
					'ti-server' => 'server',
					'ti-pulse' => 'pulse',
					'ti-printer' => 'printer',
					'ti-power-off' => 'power-off',
					'ti-plug' => 'plug',
					'ti-pie-chart' => 'pie-chart',
					'ti-panel' => 'panel',
					'ti-package' => 'package',
					'ti-music' => 'music',
					'ti-music-alt' => 'music-alt',
					'ti-mouse' => 'mouse',
					'ti-mouse-alt' => 'mouse-alt',
					'ti-money' => 'money',
					'ti-microphone' => 'microphone',
					'ti-menu' => 'menu',
					'ti-menu-alt' => 'menu-alt',
					'ti-map' => 'map',
					'ti-map-alt' => 'map-alt',
					'ti-location-pin' => 'location-pin',
					'ti-light-bulb' => 'light-bulb',
					'ti-info' => 'info',
					'ti-infinite' => 'infinite',
					'ti-id-badge' => 'id-badge',
					'ti-hummer' => 'hummer',
					'ti-home' => 'home',
					'ti-help' => 'help',
					'ti-headphone' => 'headphone',
					'ti-harddrives' => 'harddrives',
					'ti-harddrive' => 'harddrive',
					'ti-gift' => 'gift',
					'ti-game' => 'game',
					'ti-filter' => 'filter',
					'ti-files' => 'files',
					'ti-file' => 'file',
					'ti-zip' => 'zip',
					'ti-folder' => 'folder',
					'ti-envelope' => 'envelope',
					'ti-dashboard' => 'dashboard',
					'ti-cloud' => 'cloud',
					'ti-cloud-up' => 'cloud-up',
					'ti-cloud-down' => 'cloud-down',
					'ti-clipboard' => 'clipboard',
					'ti-calendar' => 'calendar',
					'ti-book' => 'book',
					'ti-bell' => 'bell',
					'ti-basketball' => 'basketball',
					'ti-bar-chart' => 'bar-chart',
					'ti-bar-chart-alt' => 'bar-chart-alt',
					'ti-archive' => 'archive',
					'ti-anchor' => 'anchor',
					'ti-alert' => 'alert',
					'ti-alarm-clock' => 'alarm-clock',
					'ti-agenda' => 'agenda',
					'ti-write' => 'write',
					'ti-wallet' => 'wallet',
					'ti-video-clapper' => 'video-clapper',
					'ti-video-camera' => 'video-camera',
					'ti-vector' => 'vector',
					'ti-support' => 'support',
					'ti-stamp' => 'stamp',
					'ti-slice' => 'slice',
					'ti-shortcode' => 'shortcode',
					'ti-receipt' => 'receipt',
					'ti-pin2' => 'pin2',
					'ti-pin-alt' => 'pin-alt',
					'ti-pencil-alt2' => 'pencil-alt2',
					'ti-eraser' => 'eraser',
					'ti-more' => 'more',
					'ti-more-alt' => 'more-alt',
					'ti-microphone-alt' => 'microphone-alt',
					'ti-magnet' => 'magnet',
					'ti-line-double' => 'line-double',
					'ti-line-dotted' => 'line-dotted',
					'ti-line-dashed' => 'line-dashed',
					'ti-ink-pen' => 'ink-pen',
					'ti-info-alt' => 'info-alt',
					'ti-help-alt' => 'help-alt',
					'ti-headphone-alt' => 'headphone-alt',
					'ti-gallery' => 'gallery',
					'ti-face-smile' => 'face-smile',
					'ti-face-sad' => 'face-sad',
					'ti-credit-card' => 'credit-card',
					'ti-comments-smiley' => 'comments-smiley',
					'ti-time' => 'time',
					'ti-share' => 'share',
					'ti-share-alt' => 'share-alt',
					'ti-rocket' => 'rocket',
					'ti-new-window' => 'new-window',
					'ti-rss' => 'rss',
					'ti-rss-alt' => 'rss-alt',
				)
			),
			array(
				'key' => 'control',
				'label' => 'Control Icons',
				'icons' => array(
					'ti-control-stop' => 'control-stop',
					'ti-control-shuffle' => 'control-shuffle',
					'ti-control-play' => 'control-play',
					'ti-control-pause' => 'control-pause',
					'ti-control-forward' => 'control-forward',
					'ti-control-backward' => 'control-backward',
					'ti-volume' => 'volume',
					'ti-control-skip-forward' => 'control-skip-forward',
					'ti-control-skip-backward' => 'control-skip-backward',
					'ti-control-record' => 'control-record',
					'ti-control-eject' => 'control-eject',
				)
			),
			array(
				'key' => 'text-editor',
				'label' => 'Text Editor',
				'icons' => array(
					'ti-paragraph' => 'paragraph',
					'ti-uppercase' => 'uppercase',
					'ti-underline' => 'underline',
					'ti-text' => 'text',
					'ti-Italic' => 'Italic',
					'ti-smallcap' => 'smallcap',
					'ti-list' => 'list',
					'ti-list-ol' => 'list-ol',
					'ti-align-right' => 'align-right',
					'ti-align-left' => 'align-left',
					'ti-align-justify' => 'align-justify',
					'ti-align-center' => 'align-center',
					'ti-quote-right' => 'quote-right',
					'ti-quote-left' => 'quote-left',
				)
			),
			array(
				'key' => 'layout',
				'label' => 'Layout Icons',
				'icons' => array(
					'ti-layout-width-full' => 'layout-width-full',
					'ti-layout-width-default' => 'layout-width-default',
					'ti-layout-width-default-alt' => 'layout-width-default-alt',
					'ti-layout-tab' => 'layout-tab',
					'ti-layout-tab-window' => 'layout-tab-window',
					'ti-layout-tab-v' => 'layout-tab-v',
					'ti-layout-tab-min' => 'layout-tab-min',
					'ti-layout-slider' => 'layout-slider',
					'ti-layout-slider-alt' => 'layout-slider-alt',
					'ti-layout-sidebar-right' => 'layout-sidebar-right',
					'ti-layout-sidebar-none' => 'layout-sidebar-none',
					'ti-layout-sidebar-left' => 'layout-sidebar-left',
					'ti-layout-placeholder' => 'layout-placeholder',
					'ti-layout-menu' => 'layout-menu',
					'ti-layout-menu-v' => 'layout-menu-v',
					'ti-layout-menu-separated' => 'layout-menu-separated',
					'ti-layout-menu-full' => 'layout-menu-full',
					'ti-layout-media-right' => 'layout-media-right',
					'ti-layout-media-right-alt' => 'layout-media-right-alt',
					'ti-layout-media-overlay' => 'layout-media-overlay',
					'ti-layout-media-overlay-alt' => 'layout-media-overlay-alt',
					'ti-layout-media-overlay-alt-2' => 'layout-media-overlay-alt-2',
					'ti-layout-media-left' => 'layout-media-left',
					'ti-layout-media-left-alt' => 'layout-media-left-alt',
					'ti-layout-media-center' => 'layout-media-center',
					'ti-layout-media-center-alt' => 'layout-media-center-alt',
					'ti-layout-list-thumb' => 'layout-list-thumb',
					'ti-layout-list-thumb-alt' => 'layout-list-thumb-alt',
					'ti-layout-list-post' => 'layout-list-post',
					'ti-layout-list-large-image' => 'layout-list-large-image',
					'ti-layout-line-solid' => 'layout-line-solid',
					'ti-layout-grid4' => 'layout-grid4',
					'ti-layout-grid3' => 'layout-grid3',
					'ti-layout-grid2' => 'layout-grid2',
					'ti-layout-grid2-thumb' => 'layout-grid2-thumb',
					'ti-layout-cta-right' => 'layout-cta-right',
					'ti-layout-cta-left' => 'layout-cta-left',
					'ti-layout-cta-center' => 'layout-cta-center',
					'ti-layout-cta-btn-right' => 'layout-cta-btn-right',
					'ti-layout-cta-btn-left' => 'layout-cta-btn-left',
					'ti-layout-column4' => 'layout-column4',
					'ti-layout-column3' => 'layout-column3',
					'ti-layout-column2' => 'layout-column2',
					'ti-layout-accordion-separated' => 'layout-accordion-separated',
					'ti-layout-accordion-merged' => 'layout-accordion-merged',
					'ti-layout-accordion-list' => 'layout-accordion-list',
					'ti-widgetized' => 'widgetized',
					'ti-widget' => 'widget',
					'ti-widget-alt' => 'widget-alt',
					'ti-view-list' => 'view-list',
					'ti-view-list-alt' => 'view-list-alt',
					'ti-view-grid' => 'view-grid',
					'ti-upload' => 'upload',
					'ti-download' => 'download',
					'ti-loop' => 'loop',
					'ti-layout-sidebar-2' => 'layout-sidebar-2',
					'ti-layout-grid4-alt' => 'layout-grid4-alt',
					'ti-layout-grid3-alt' => 'layout-grid3-alt',
					'ti-layout-grid2-alt' => 'layout-grid2-alt',
					'ti-layout-column4-alt' => 'layout-column4-alt',
					'ti-layout-column3-alt' => 'layout-column3-alt',
					'ti-layout-column2-alt' => 'layout-column2-alt',
				)
			),
			array(
				'key' => 'brand',
				'label' => 'Brand Icons',
				'icons' => array(
					'ti-flickr' => 'flickr',
					'ti-flickr-alt' => 'flickr-alt',
					'ti-instagram' => 'instagram',
					'ti-google' => 'google',
					'ti-github' => 'github',
					'ti-facebook' => 'facebook',
					'ti-dropbox' => 'dropbox',
					'ti-dropbox-alt' => 'dropbox-alt',
					'ti-dribbble' => 'dribbble',
					'ti-apple' => 'apple',
					'ti-android' => 'android',
					'ti-yahoo' => 'yahoo',
					'ti-trello' => 'trello',
					'ti-stack-overflow' => 'stack-overflow',
					'ti-soundcloud' => 'soundcloud',
					'ti-sharethis' => 'sharethis',
					'ti-sharethis-alt' => 'sharethis-alt',
					'ti-reddit' => 'reddit',
					'ti-microsoft' => 'microsoft',
					'ti-microsoft-alt' => 'microsoft-alt',
					'ti-linux' => 'linux',
					'ti-jsfiddle' => 'jsfiddle',
					'ti-joomla' => 'joomla',
					'ti-html5' => 'html5',
					'ti-css3' => 'css3',
					'ti-drupal' => 'drupal',
					'ti-wordpress' => 'wordpress',
					'ti-tumblr' => 'tumblr',
					'ti-tumblr-alt' => 'tumblr-alt',
					'ti-skype' => 'skype',
					'ti-youtube' => 'youtube',
					'ti-vimeo' => 'vimeo',
					'ti-vimeo-alt' => 'vimeo-alt',
					'ti-twitter' => 'twitter',
					'ti-twitter-alt' => 'twitter-alt',
					'ti-linkedin' => 'linkedin',
					'ti-pinterest' => 'pinterest',
					'ti-pinterest-alt' => 'pinterest-alt',
					'ti-themify-logo' => 'themify-logo',
					'ti-themify-favicon' => 'themify-favicon',
					'ti-themify-favicon-alt' => 'themify-favicon-alt',
				)
			),
		);
	}
	public static function displaySettingLabel($name){
		$wordArray = explode("_", $name);
		foreach($wordArray as $key=>$value){
			$wordArray[$key]=ucfirst($value);
		}
		return join(' ', $wordArray);
	}

    public static function displaySettingStatusLabel($name){
        $wordArray = explode("_", $name);
        foreach($wordArray as $key=>$value){
            $wordArray[$key]=ucfirst($value);
        }
        $wordArray[1]="Status";
        return join(' ', $wordArray);
    }

	public static function ip_details()
    {
    	$IPaddress = getenv("HTTP_CLIENT_IP");
        $json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
        $details    = json_decode($json,true);
        return $details;
    }

	public static function getMyCurrentLocation(){
		$getcountryCode = \App\Model\Ip2Nation::getCountryCodeFromIp(request()->ip());
		$getDetails = \App\Model\Country::where('code', $getcountryCode)->withTranslation()->first();
    	return $getDetails;
	}
	//Get details from Profile table
	public static function getUserDetails($id){
		$userDetails = Profile::where('user_id', '=', $id)->get()->toArray();
		return $userDetails;
	}
	//Get details from User table
	public static function getUserTblDetails($id){
		if($id){
			$getUserTblDetails = User::where('id', '=', $id)->get()->toArray();
			return $getUserTblDetails;
		} else {
			return false;
		}

	}

	public static function getAllUser(){
		$getAllUser = User::where('status','Active')->where('user_type','vendor')->get()->toArray();
		return $getAllUser;
	}

	public static function getAllCategory(){
		$getAllUser = Category::where('status','Active')->get()->toArray();
		return $getAllUser;
	}

	public static function getAllSubCategory(){
		$SubCategory = SubCategory::where('status','Active')->get()->toArray();
		return $SubCategory;
	}


}
