<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cultures extends Model
{
    use SoftDeletes;
    protected $table = 'cultures';
    protected $primaryKey = 'endroits_reference';
    public $incrementing = false;
    protected $keyType = "string";
    protected $fillable = ['endroits_reference','type'];

    public function endroit(){
        return $this->belongsTo('App\Endroits','reference','endroits_reference');
    }
}
