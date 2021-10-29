<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ParentMessage extends Model
{
    use \Kyslik\ColumnSortable\Sortable;
    public $table = "parent_messges";

    protected $fillable = [
        'agent_id', 'customer_id','propery_id','status','subject'
    ];
    public function messages(){
        return $this->hasMany('\App\Models\Messages', 'parent_id', 'id');
    }
    public function customer(){
        return $this->belongsTo('\App\Models\User', 'customer_id', 'id');
    }
    public function last_message(){
        return $this->hasOne('\App\Models\Messages','parent_id','id')->latest();
    }


}
