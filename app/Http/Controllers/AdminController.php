<?php

namespace App\Http\Controllers;

use App\Product;
use App\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

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
                    break;
                case "GetProxieList":
                    echo "Get proxielist from ".$request->apiName;
                    switch ($request->apiName) {
                        case "foxtools":
                            $apiFoxtool = Http::get("http://api.foxtools.ru/v2/Proxy?free=Yes&type=3&anonymity=12");
                            //filter high anonimity
                            if ($apiFoxtool->status() == 200) {
                                $proxieList = $apiFoxtool->json()["response"]["items"];
                            };
                            foreach ($proxieList as $proxy) {
                                $type="";
                                switch ($proxy['type']){
                                    case 0:
                                        $type="None";
                                        break;
                                    case 1:
                                        $type="HTTP";
                                        break;
                                    case 2:
                                        $type="HTTPS";
                                        break;
                                    case 4:
                                        $type="SOCKS4";
                                        break;
                                    case 8:
                                        $type="SOCKS5";
                                        break;
                                    case 15:
                                        $type="All";
                                        break;
                                }
                                Proxy::add(array ("Proxy"=>$proxy['ip'], "Port"=>$proxy['port'], "Type"=>$type ));

                            }

                    }
                }

        } else return view('pages.welcome');

    }
}
