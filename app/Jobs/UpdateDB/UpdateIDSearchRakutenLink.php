<?php

namespace App\Jobs\UpdateDB;

use App\Product;
use App\ProductID;
use App\Services\GoutteService;

class UpdateIDSearchRakutenLink extends AbstractJob
{
    protected $item;

    /**
     * GetLotInfo constructor.
     * @param $item
     */
    public function __construct($item)
    {
        parent::__construct();
        $this->item=$item;
    }


    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get item data
         //if JAV Code is Known
        /*if (!empty($this->item->JAN)) {
            //search Yahoo by Jan
            $result[0]=GoutteService::searchYahooByJan($this->item->JAN);
        } else {*/

            //search item by data
        $itemName=$this->item->ItemName;
        //replace separated x
        //replace parentheses with spaces
        $filter=array('【' => ' ',
            '】' => ' ',
            ' x '=>'x',
            ' X '=>'x',
            '['=>'',
            ']'=>'',
            ','=>'',
            '、'=>' ');
        $words=strtr($itemName, $filter);
        $keyWords=explode(" ",$words);
        $count=count($keyWords);
        $generatedIndexes=array();
        //get random indexes from keywords
        for ($i=0; $i<min(min(intdiv($count, 2),$count-2), 5); $i++) {
            $requestString="";
            $flag=false;
            while (!$flag){
                $preparedIndex=$i;
                $indexes = array_rand($keyWords, min(2, intdiv($count, 2)));
                //adding keyword according loop number
                if (in_array($preparedIndex,$indexes)) {
                    while (!in_array($preparedIndex, $indexes)) {
                        $preparedIndex++;
                    }
                }
                array_push($indexes,$preparedIndex);

                if (!in_array($indexes,$generatedIndexes)){
                    array_push($generatedIndexes,$indexes);
                    $flag=true;
                }
            }
            foreach ($indexes as $index) {
                $requestString.=$keyWords[$index]." ";
            }
            print $requestString[$i];
            $searchResult[$i]=GoutteService::searchRakutenByString(
                $requestString,
                0.5*$this->item->AmazonPrice,
                3*$this->item->AmazonPrice,
                1);
            print_r($searchResult[$i]);
        }
        //combining same results from different requests
        //variable for result
        $combinedResult=array();
        //varianle for filter
        $links=array();
        foreach ($searchResult as $result){
            foreach ($result as $record){
                //variable for  current matches
                $matches=0;
                $keywordWeight=0;
                foreach ($keyWords as $key){
                    if (strpos($record['RakutenItemName'], $key)) {
                        switch ($keywordWeight){
                            case 0: $matches+=$count; break;
                            case 1: $matches+=intdiv($count, 2); break;
                            case 2: $matches+=intdiv($count, 4); break;
                            default : $matches++;
                        }
                        $keywordWeight++;
                    }
                }
                $record['matches']=$matches;
                //check if item is in result
                if (!in_array($record['RakutenLink'], $links)){
                    //if not adding record to result
                    array_push($links, $record['RakutenLink']);
                    array_push($combinedResult, $record);
                }

            }
        }
        //filter final result by max matches
        $maxMatches=max(array_column($combinedResult,'matches'));
        $combinedResult=array_filter($combinedResult, function ($var) use ($maxMatches){
            return ($var['matches'] == $maxMatches);
        });
        //sort by price
        usort($combinedResult, function($a, $b) {
            return $a['RakutenPrice'] <=> $b['RakutenPrice'];
        });
        //add link to DB
        ProductID::updateRakutenData($this->item->BananaId,
            $combinedResult[0]["RakutenLink"],
            $combinedResult[0]["RakutenPrice"]
        );
        //Update pic
        if(empty($this->item->ImgSRC)) Product::UpdateItemImgSRC($this->item->BananaId, $combinedResult[0]["RakutenImageSrc"]);


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
