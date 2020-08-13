<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserAgent extends Model
{
    //
    public static function getAgent()
    {
        return DB::table('user_agents')->select('UserAgent')->inRandomOrder()->first()->UserAgent;
    }
}
