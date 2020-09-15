<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Result;

class Product extends Model
{
    //
    protected $fillable = [
        'ItemName', 'BananaId'
    ];

    const filter = array("Amazon", "Rakuten", "Yahoo");


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
                        ->whereNull('products.ItemName')->get()->take(100)->toArray();

    }
    public static function GetItemsIDbyBananaId($id)
    {

        return  DB::table('products')
            ->join('product_i_d_s','product_i_d_s.BananaId','=', 'products.BananaId')
            ->select(['products.BananaId','product_i_d_s.AmazonId'])
            ->where('products.BananaId', $id)->get()->take(100)->toArray();

    }

    public static function GetItemContains(string $string)
    {
        return DB::table('products')
            ->join('product_i_d_s','product_i_d_s.BananaId','=', 'products.BananaId')
            ->select(['products.BananaId','product_i_d_s.AmazonId'])
            ->where('products.Maker',"like","%{$string}%")->get()->toArray();

    }

    //update Item info
    public static function updateLotInfo(int $bananaID, $data)
    {
        DB::table('products')->where('BananaId', $bananaID)
            ->update([
            'Maker'=>$data['Maker'],
            'ItemName'=>$data['ItemName'],
            'ImgSRC'=>$data['ImgSRC']
        ]);
    }

    public static function GetItemData($bananaId)
    {
        return DB::table('products')->where('BananaId', $bananaId)->get()->toArray();
    }

    public static function SearchDB($string,$sortBy,$searchMode)
    {
        $result=[];
        /* $mode=10*$sortBy+$searchMode;
        switch ($mode) {
            case 0:
        } */
        $query=DB::table('products')
            ->join('product_i_d_s','product_i_d_s.BananaId','=', 'products.BananaId')
            ->where('ItemName',"like","%{$string}%")
            ->select("products.*");
        //setfilter
        if ($searchMode=="All") {
            $query=$query->addSelect("product_i_d_s.*");
        } else {
                $first=true;
                $query=$query->addSelect("product_i_d_s.BananaId");
                foreach (self::filter as $key){
                    if (strpos($searchMode, $key)!==false) {
                        if ($first) $query = $query->whereNotNull('product_i_d_s.' . $searchMode . 'Price');
                        else $query = $query->orwhereNotNull('product_i_d_s.' . $searchMode . 'Price');
                    }
                    $query=$query->addSelect("product_i_d_s." . $searchMode . "Link","product_i_d_s." . $searchMode . "Price");
                }

        }
        $result=$query->paginate(15);
        return $result;
    }

    public static function UpdateItemImgSRC($bananaId, $imgSRC)
    {
        DB::table("products")->where('BananaId',$bananaId)
            ->update([
                'ImgSRC'=> $imgSRC
            ]);
    }


}

