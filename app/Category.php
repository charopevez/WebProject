<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CategoryId',
        'CategoryName',
        'AmazonCategoryNode',
        'RakutenCategoryNode',
        'YahooCategoryNode'];
    //add Category to DB
    public static function createCategory($array)
    {
        try {DB::table('categories')->insert($array);
            return 0;
        }catch (QueryException $e){
            return -1;
        }
    }
    //get Category's children
    public static function getCategoryChildrenList($parentId){
        //calculate category lvl
        $categoryLvL =4;
        $tempID=$parentId;
        while ($tempID%100==0){
            $categoryLvL--;
            $tempID/=100;
        }
        return DB::table('categories')->whereBetween('CategoryId', [$parentId, $parentId+pow(10, 10-$categoryLvL*2)])->
                select('CategoryId', 'AmazonCategoryNode')->get()->toArray();
    }

    //get $parent category and its children
    public static function getCategoryList($parentId)
    {    //get array of categoriesID
         return DB::table('categories')->whereBetween('CategoryId', [$parentId, $parentId+100000000])
             ->select('CategoryId', 'AmazonCategoryNode')->get()->toArray();
    }

}
