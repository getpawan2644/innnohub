<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use CommonHelper;

class StateTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

	public $timestamps = false;

    protected $table = 'state_translations';

    protected $fillable = ['state_id', 'locale','name'];

	public static function boot()
    {
        parent::boot();

        self::created(function($model){
            self::deleteCache($model);
        });

        self::updated(function($model){
			self::deleteCache($model);
        });

        self::deleted(function($model){
			self::deleteCache($model);
        });
    }

	private static function deleteCache($model){
		$state = State::find($model->state_id);
		foreach(CommonHelper::getLanguages() as $language => $locale){
			Cache::forget('states-'.$state->country_id.'-'.$locale);
		}
	}
}
