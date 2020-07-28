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


    //Add new Items
    public static function AddNewItem(int $bananaID, int $categoryId)
    {
        DB::table('products')->insert([
            'BananaId'=>$bananaID,
            'CategoryId'=>$categoryId
        ]);
    }


    //return items without name
    public static function GetNewItemsID()
    {

        return  DB::table('products')
                        ->join('product_i_d_s','product_i_d_s.BananaId','=', 'products.BananaId')
                        ->select(['products.BananaId','product_i_d_s.AmazonId'])
                        ->whereNull('products.ItemName')->get()->toArray();

    }

    //update Item info
    public static function updateLotInfo(int $bananaID, $data)
    {
        DB::table('products')->insert([
            'BananaId'=>$bananaID,
            'ItemName'>$data
        ]);
    }
}

