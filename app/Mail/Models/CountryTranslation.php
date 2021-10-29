<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    use \Kyslik\ColumnSortable\Sortable;

	public $timestamps = false;

    protected $table = 'country_translations';

    protected $fillable = ['country_id', 'locale','name'];

	public $sortable = ['name'];

}
