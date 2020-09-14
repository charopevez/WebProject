<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proxy extends Model
{
    //
    public static function add(array $array)
    {
        DB::table('proxies')->insert([
            "Proxy"=>$array['Proxy'],
            "Port"=>$array['Port'],
            "Type"=>$array['Type']
        ]);
    }

    public static function getRandom()
    {
        return DB::table('proxies')->orderByRaw("RAND()")->get()->take(1)->toArray();
    }
}
