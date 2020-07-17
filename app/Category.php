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

    //get $parent category and its children
    public static function getCategoryList($parentId)
    {    //get array of categoriesID
         return DB::table('categories')->whereBetween('CategoryId', [$parentId, $parentId+1000000])
             ->select('CategoryId', 'AmazonCategoryNode')->get()->toArray();
    }

}
