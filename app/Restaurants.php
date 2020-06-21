<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurants extends Model
{
    use SoftDeletes;
    protected $table = 'restaurants';
    protected $primaryKey = 'endroits_reference';
    public $incrementing = false;
    protected $keyType = "string";
    protected $fillable = ['endroits_reference','type','specialite','prixCarte','prixMoyenne'];

    public function endroit()
    {
        return $this->belongsTo('App\Endroits', 'reference', 'endroits_reference');
    }
}
