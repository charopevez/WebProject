<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //
    protected $fillable = [
        'ItemName', 'BananaId'
    ];

    //get list of items in local DB by Category
    public static function getListIDbyCategory($CategoryId)
    {
        DB::table('products')->where('CategoryId', $CategoryId)
            ->select('BananaId')->get()->toArray();
    }
}

