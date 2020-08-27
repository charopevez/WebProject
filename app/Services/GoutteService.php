<?php

namespace App\Services;


use mysql_xdevapi\Exception;
use Symfony\Component\DomCrawler\Crawler;

class GoutteService{


    //Take item info from Amazon
    public static function getItemData($asin)
    {
        //prepare url
        $uri="https://www.amazon.co.jp/dp/".$asin;

        $page=GuzzleService::getHTMLfromPage($uri);     //get page
        $img=$page->filter('#imgTagWrapperId')->eq(0)
            ->filter('img')->eq(0)->attr('data-old-hires');
        $name=$page->filter('#productTitle')->eq(0)->text();
        $brand=$page->filter('#bylineInfo')->eq(0)->text();
        return array(
                    'Maker'=>$brand,
                    'ItemName'=>$name,
                    'ImgSRC'=>$img
                    );
    }

    public static function searchYahooByString($request, $min, $max, $pagecount)
    {
        $searchResult=[];
        //prepare url
        $uriTemplate = "https://shopping.yahoo.co.jp/search?p=%s&pf=%d&pt=%d&sc_i=shp_pc_search_prcrange_prng&b=%d";
        for ($i=1; $i<=$pagecount; $i++) {
            $uri[$i] = sprintf($uriTemplate, $request, $min, $max, 1 + 30 * ($i - 1));
            //get page
            $page = GuzzleService::getHTMLfromPage($uri[$i]);
            //chech if there a result
            if (empty($page->filter(".LoopList"))) return -1;
            $itemlist=$page->filter(".LoopList__item");
            foreach ($itemlist as $item) {
                $itemDom=new Crawler($item);
                //get link
                $link=$itemDom->filter('div')->eq(2)->filter('a')->eq(0)->attr('href');
                //get item name
                $name=$itemDom->filter('div')->eq(2)->filter('a')->eq(0)
                                ->filter('span')->text();
                //get img src
                $img=$itemDom->filter('div')->eq(1)->filter('a')
                            ->filter('img');
                $imgSrc=[];
                foreach ($img as $image)
                    if (!str_contains((new Crawler($image))->attr('class'), 'LazyImage__skeleton')) $imgSrc=(new Crawler($image))->attr('src');
                //get Price

                $price = str_replace(",", "", $itemDom->filter('div')->eq(3)->filter('span')->eq(0)->text());
                array_push($searchResult, array('YahooItemName'=>$name,'YahooImageSrc'=>$imgSrc,'YahooLink'=>$link,'YahooPrice'=>$price));
            }

        }
        return $searchResult;
    }

    public static function searchYahooByJan($jan)
    {
        $searchResult=[];
            //prepare url
        $uriTemplate = "https://shopping.yahoo.co.jp/search?p=%sX=2";
        $uri = sprintf($uriTemplate, $jan);
        //get page
        $page = GuzzleService::getHTMLfromPage($uri);
        //chech if there a result
        if (empty($page->filter(".LoopList"))) return -1;
        $cheapestItem=$page->filter('.LoopList__item')->eq(0);         //find first item
        //get link
        $link = $cheapestItem->filter('div')->eq(2)->
        filter('a')->eq(0)->attr('href');
        //get Price
        $price = str_replace(",", "",
            $cheapestItem->filter('div')->eq(3)->
            filter('span')->eq(0)->text());
        $searchResult+=array('YahooLink'=>$link,'YahooPrice'=>$price);
        //検索結果を返す
        return $searchResult;
    }

    public static function searchRakutenByString($request, $min, $max, $pagecount)
    {
        $searchResult=[];
        //prepare url
        $uriTemplate = "https://search.rakuten.co.jp/search/mall/%s/?max=%d&min=%d&p=%d";
        for ($i=1; $i<=$pagecount; $i++) {
            $uri[$i] = sprintf($uriTemplate, $request, $max, $min, $i);
            //get page
            $page = GuzzleService::getHTMLfromPage($uri[$i]);
            //chech if there a result
            if (empty($page->filter(".searchresultitem"))) return -1;
            $itemlist = $page->filter(".searchresultitem");
            foreach ($itemlist as $item) {
                $itemDom = new Crawler($item);
                //get link
                $link = $itemDom->filter('.title')->eq(0)->
                filter('a')->eq(0)->attr('href');
                //get item name
                $name = $itemDom->filter('.title')->eq(0)->
                filter('a')->eq(0)->text();
                //get img src
                $img = $itemDom->filter('img')->eq(0)->attr('src');
                //get Price
                //remove ","
                $price=str_replace(",","",
                    $itemDom->filter('.important')->eq(0)->text());
                //remove　"円"
                $price=str_replace("円","",$price);
                //検索結果を返す
                array_push($searchResult, array('RakutenItemName' => $name, 'RakutenImageSrc' => $img, 'RakutenLink' => $link, 'RakutenPrice' => $price));
            }
        }
        return $searchResult;
    }

    public static function searchRakutenByJan($jan)
    {
        //prepare url
            $uriTemplate="https://search.rakuten.co.jp/search/mall/%s/?s=2";
            $uri=sprintf($uriTemplate,$jan);
        //research HTML
        $page=GuzzleService::getHTMLfromPage($uri);
        if (empty($page->filter(".searchresultitem"))) return -1;
        $cheapestItem=$page->filter('.searchresultitem')->eq(0);         //find first item
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

    public static function searchProductFromAmazonByCategory($node,$page)
    {
        //prepare url
        $uriTemplate="https://www.amazon.co.jp/b?node=%s&page=%d";
        $uri=sprintf($uriTemplate, $node, $page);
        echo $uri;
        //research HTML
        $page=GuzzleService::getHTMLfromPage($uri);       //get page

        // if there is no results return error
        if (empty($page->filter('#mainResults'))) return -1;

        $itemList=$page->filter('#mainResults')->filter('li');         //get Search Result Blog

        //loop throw items
        $result = $itemList->each(function ($node) {

            //get asin
            $asin = $node->attr('data-asin');
            $link = null;
            $price = null;
            $name = null;
            if (!empty($asin)) {
                try {
                    $rawPrice = $node->filter('.s-price')->text();
                    //get price without ","
                    $price = str_replace(",", "", $rawPrice);
                    //get price without "￥"
                    $price = str_replace("￥ ", "", $price);
                    //if its a price range, set it to min
                    $price = explode(" ", $price)[0];
                    return array("AmazonId" => $asin, "AmazonPrice" => $price);
                } catch (\Exception $e) {}
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
        //research HTML
        $categoryList=GuzzleService::getHTMLfromPage($uri)       //get page
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
