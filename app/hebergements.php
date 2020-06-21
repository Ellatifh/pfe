<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hebergements extends Model
{
    use SoftDeletes;
    protected $table = 'hebergements';
    protected $primaryKey = 'endroits_reference';
    public $incrementing = false;
    protected $keyType = "string";
    protected $fillable = ['endroits_reference', 'ranking', 'wifi', 'piscine', 'spa', 'fitness', 'rooms'];

    public function endroit()
    {
        return $this->belongsTo('App\Endroits', 'reference', 'endroits_reference');
    }
}
