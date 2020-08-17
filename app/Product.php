<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable=[
        'code','name','description','prices_id'
    ];
    
    public function prices()
    {
        return $this->belongsTo(Price::class,'price_id');
    }
}
