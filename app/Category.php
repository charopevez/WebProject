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
    //
    public static function createCategory($array)
    {
        try {DB::table('categories')->insert($array);
            return 0;
        }catch (QueryException $e){
            return -1;
        }
    }
}
