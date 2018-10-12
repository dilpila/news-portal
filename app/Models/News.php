<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use SoftDeletes;
    protected  $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
