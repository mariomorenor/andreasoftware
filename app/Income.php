<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'date',
        'user_id',
        'quantity',
        'time'
    ];
    protected $casts=[
        'date'=>'datetime:Y-m-d',
        'user_id'=>'integer',
        'time'=>'time',
        'quantity'=>'integer'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
