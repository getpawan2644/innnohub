<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\SubCategory;

class ServiceCategory extends Model
{
	 use Sortable;

	public $sortable = ['service_name']; 

    protected $fillable = [
        'service','sub_category','category',
    ];

   


}
