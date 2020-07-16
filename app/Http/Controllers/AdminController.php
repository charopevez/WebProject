<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    //
    function console(Request $request){
        $login=$request->user;
        $pass=$request->pass;
        echo "sign in<br>";
        if ($login =="sk2a2020c"&&$pass=="x8YfVPj81NhPAgxfA6Da") {
            $command=$request->command;
            echo "run ".$command."<br>";
            switch ($command){
                case "Amazon-categoryTree":
                    echo "execute Amazon:categoryTree<br>";
                    $id=$request->id;
                    $name=$request->name;
                    $node=$request->node;
                    echo "arguments ".$id.$name.$node;
                    Artisan::call('Amazon:categoryTree',['categoryId'=>$id,'AmazonCategoryNode'=>$node,'categoryName'=>$name]);
                    dd("run Amazon:categoryTree command with Id ".$id." and name ".$name);
            }

        } else return view('pages.welcome');

    }
}
