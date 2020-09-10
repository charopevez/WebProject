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
        while ($parentId%100==0&&$parentId%10000==0){
            $categoryLvL--;
            $parentId/=100;
        }
        if ($categoryLvL<4)
                $list=DB::table('categories')
                    ->whereBetween('CategoryId',[$parentId*pow(100, 4-$categoryLvL), ($parentId+100)*pow(100, 4-$categoryLvL)])
                    ->where('CategoryId',">", $parentId)
                    ->select('CategoryId', 'AmazonCategoryNode', 'CategoryName')->get()->toArray();
        else return DB::table('categories')->where('CategoryId',"=", $parentId)
                        ->select('CategoryId', 'AmazonCategoryNode', 'CategoryName')->get()->toArray();
        //filter categories
        $filterredList=[];
        //remove last category in list
        array_pop($list);

        //research categories for children
        foreach ($list as $record) {
            //calculate category lvl
            $lvl =4;
            $category=$record->CategoryId;
            $temp=$category;
            while ($temp%100==0&&$temp%10000==0){
                $lvl--;
                $temp/=100;
            }
            //check if categories has children
            $childCount=count(array_filter($list, function ($var) use ($category, $lvl) {
                return ($var->CategoryId>$category&&$var->CategoryId<$category+pow(100, 5-$lvl));
            }));
            //if category does not have children adding to result
            if ($childCount==0) array_push($filterredList, $record);
        }

        return $filterredList;
    }

    //get $parent category and its children
    public static function getCategoryList($parentId)
    {    //get array of categoriesID
         return DB::table('categories')->whereBetween('CategoryId', [$parentId, $parentId+100000000])
             ->select('CategoryId', 'AmazonCategoryNode')->get()->toArray();
    }

}
