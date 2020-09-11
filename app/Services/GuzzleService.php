<?php


namespace App\Services;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Http;

class GuzzleService
{
        protected $headerList;
        const languageList=array(
            "en-GB,en-US;q=0.9,en;q=0.8",
            "en-US,en;q=0.9",
            "en-US,en;q=0.5",
            "en-US,en;q=0.9,ru-RU;q=0.8,ru;q=0.7,ja;q=0.6",
            "ru-RU;q=0.8,ru;q=0.7,ja;q=0.6",
            "ru-RU;q=0.8",
            "ru;q=0.7",
            "ja;q=0.6"
        );

        const encodingList=array(
            "gzip", "compress", "deflate", "br", "identity",  "*"
        );

        const refererList=array(
            "www.google.com",
            "www.bing.com",
            "yandex.com",
            "duckduckgo.com",
            "www.kakaku.co.jp",
            "www.yahoo.co.jp"
        );

        const localProxiesList=array(
            "138.68.161.14:3128","207.154.231.213:3128","188.226.141.211:8080",
            "46.4.96.137:3128","46.4.96.137:8080","88.198.24.108:3128",
            "176.9.75.42:8080","176.9.75.42:3128","88.198.50.103:8080",
            "176.9.119.170:8080","176.9.119.170:3128","88.198.24.108:8080",
            "188.166.83.17:3128","46.4.96.137:8080","46.250.171.31:8080",
            "109.86.153.157:30237","134.209.29.120:3128","79.175.51.212:29205",
            "188.226.141.61:3128","167.71.5.83:3128","88.198.50.103:3128",
            "161.35.70.249:8080","51.158.184.150:3128","95.141.193.35:80",
            "51.15.125.20:3128","161.35.70.249:3128","138.68.161.14:8080",
            "188.166.83.17:8080","159.8.114.37:25","207.154.231.213:8080",
            "51.15.47.6:3128","51.15.226.10:3128","95.141.193.14:80",
            "3.11.214.31:80",
        );


    public function __construct()
    {

    }

    public static function getHTMLfromPage(string $uri)
    {
        $headerList=array(
            "Connection"=>"keep-alive",
            "DNT"=>"1",
            "Upgrade-Insecure-Requests"=>"1",
            "User-Agent"=>"",
            "Accept"=>"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
            "Sec-Fetch-Site"=>"none",
            "Sec-Fetch-Mode"=>"navigate",
            "Sec-Fetch-Dest"=>"document",
            "Referer"=>"",
            "Accept-Encoding"=> "",
            "Accept-Language"=>""
        );
        //wait from 10-20 sec
        sleep(rand(1,3));
        //get random User Agent from DB
       # $headerList["User-Agent"]=UserAgent::getAgent();
        //get random values for header;
        /*$headerList["Referer"]=self::refererList[rand(0,5)];
        $encoding="";
        $count=rand(1,3);
        for ($i=0; $i<=$count;$i++){
            $r=rand(0,5);
            if ($r==5) {
                $encoding=self::encodingList[$r];
                break;
            }
            if (!strpos($encoding,self::encodingList[$r])) $encoding.=self::encodingList[$r];
            if ($i!=$count) $encoding.=", ";
        }
        $headerList["Accept-Encoding"]=$encoding;
        $headerList["Accept-Language"]=self::languageList[rand(0,5)];*/
        $proxy="";
        //generate random proxy
        $flag=false;
        do {
            switch (2) {
                case 0:
                    //get proxy from Foxtools.ru
                    $apiFoxtool = Http::get("http://api.foxtools.ru/v2/Proxy?free=Yes&type=3&anonymity=12");
                    //filter high anonimity
                    if ($apiFoxtool->status() == 200) {
                        $items = $apiFoxtool->json()["response"]["items"];
                        $proxyWithData=$items[rand(0, count($items)-1)];
                        $proxy=$proxyWithData["ip"].":".$proxyWithData["port"];
                        $flag=true;
                    };

                    break;
                case 1:
                    $proxy=self::localProxiesList[rand(0,count(self::localProxiesList))];
                    $flag=true;
                    break;
                case 2:
                    //get proxy from luminati.io
                    $flag=true;
                    break;
                case 3:
                    //get proxy from zenscrape
                    $apiZenscrape=Http::get("https://app.zenscrape.com/api/v1/get?".
                    "apikey=2aa60cd0-d7b2-11ea-bda5-072adb4aebaa&url=https%3A%2F%2Ffreegeoip.app%2Fjson%2F&location=jp")->body()    ;
                    return $apiZenscrape;
            }
        } while ($flag!=true);

        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout'=>60,
            #'proxy'=>$proxy,
            'verify' => false,
        ));
        $goutteClient->setClient($guzzleClient);

        return $goutteClient->request('GET', $uri , [
            'headers'=>$headerList
        ]);
    }

}
