<?php

namespace App\Services;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;


class GoutteService{

    public function searchYahooByJan($jan)
    {
        //prepare url
        $uriTemplate="https://shopping.yahoo.co.jp/search?p=%s&used=2&X=2";
        $uri=sprintf($uriTemplate,$jan);
        //get HTML code
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout'=>60,
        ));
        $goutteClient->setClient($guzzleClient);
        $cheapestItem=$goutteClient->request('get',$uri)     //get page
        ->filter('.LoopList__item')->eq(0);         //find first item

        //get link
        $link=$cheapestItem->filter('div')->eq(2)->
        filter('a')->eq(0)->attr('href');
        //get Price

        $price=str_replace(",","",
            $cheapestItem->filter('div')->eq(3)->
            filter('span')->eq(0)->text());
        //検索結果を返す
        return array('YahooLink'=>$link,'YahooPrice'=>$price);
    }

    public function searchRakutenByJan($jan)
    {
        //prepare url
            $uriTemplate="https://search.rakuten.co.jp/search/mall/%s/?s=2&used=0";
            $uri=sprintf($uriTemplate,$jan);
        //get HTML code
            $goutteClient = new Client();
            $guzzleClient = new GuzzleClient(array(
                'timeout'=>60,
            ));
            $goutteClient->setClient($guzzleClient);

        //research HTML
        $cheapestItem=$goutteClient->request('get',$uri)                             //get page
        ->filter('.searchresultitem')->eq(0);         //find first item

        //get link
        $link=$cheapestItem->filter('.title')->eq(0)->
        filter('a')->eq(0)->attr('href');
        //get Price
        //remove ","
        $price=str_replace(",","",
            $cheapestItem->filter('.important')->eq(0)->text());
        //remove　"円"
        $price=str_replace("円","",$price);
        //検索結果を返す
        return array('RakutenLink'=>$link,'RakutenPrice'=>$price);
    }

    public function searchProductFromAmazonByCategory($node)
    {   //https://www.amazon.co.jp/s?rh=i:computers,n:3482011&bbn=3481981    3481981
        //prepare url
        $uriTemplate="https://www.amazon.co.jp/b?node=%s";
        $uri=sprintf($uriTemplate,$node);
        //get HTML code
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout'=>60,
        ));
        $goutteClient->setClient($guzzleClient);

        //research HTML
            $itemList=$goutteClient->request('get',$uri)       //get page
            ->filter('#mainResults')->filter('li');         //get Search Result Blog

        //loop throw items
        $result=$itemList->each(function ($node){

            //get asin
            $asin=$node->attr('data-asin');
            $link=null;$price=null;$name=null;
            if (!empty($asin)){
                //get name
                $name=$node->filter('h2')->text();
                //get link
                $link="https://www.amazon.co.jp/dp/".$asin;
                //get price without ","
                $price=str_replace(",","",
                    $node->filter('.s-price')->text());
                //get price without "￥"
                $price=str_replace("￥ ","", $price);
                return array("asin"=>$asin, "name"=>$name,"link"=>$link,"price"=>$price);
            }
        });
        return array_values(array_filter($result));
    }

    public static function getChildGategoriesFromAmazon( $id, $node, $parentLevel)
    {
        if ($parentLevel>3) exit(1);
        //prepare url
        $uriTemplate="https://www.amazon.co.jp/b?node=%s";
        $uri=sprintf($uriTemplate,$node);
        //get HTML code
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout'=>60,
        ));
        $goutteClient->setClient($guzzleClient);

        //research HTML
        $categoryList=$goutteClient->request('get',$uri)       //get page
        ->filter('.octopus-pc-category-card-v2-content')->eq(0);         //get Search Result Blog

        //loop throw items
        $result=$categoryList->filter('.octopus-pc-category-card-v2-category-link')-> each(function ($node, $increment) use ($id,$parentLevel) {
            //get id
            $categoryName=$node->filter('a')->attr('title');
            //get link
            $categoryNode=$node->filter('a')->attr('href');
            //get id from link
            $categoryNode=substr($categoryNode,strpos($categoryNode,'node=')+5);
            $categoryNode=substr($categoryNode, 0, strpos($categoryNode,'&'));
            //generate Category ID
            $categoryId=$id+($increment+1)*pow(10,8-2*$parentLevel);
            return array("CategoryId"=>$categoryId,"AmazonCategoryNode"=>$categoryNode, "CategoryName"=>$categoryName);
        });

        return  $result;
    }

}
