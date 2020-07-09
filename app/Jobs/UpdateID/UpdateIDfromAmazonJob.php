<?php

namespace App\Jobs\UpdateID;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateIDfromAmazonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        include 'simple_html_dom.php';
        function dlPage($href) {

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_URL, $href);
            curl_setopt($curl, CURLOPT_REFERER, $href);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
            $str = curl_exec($curl);
            curl_close($curl);

            // Create a DOM object
            $dom = new simple_html_dom();
            // Load HTML from a string
            $dom->load($str);

            return $dom;
        }

        function getData($href){
            echo $href;
            $amazonURL="https://amazon.co.jp/";
            $html = dlPage($amazonURL.$href);
            $search=$html->find('div.s-main-slot',0);
            foreach ($search->children as $div){
                if (!empty($div->attr['data-asin'])){
                    echo '<tr><td>'.$div->attr['data-asin'].'</td>';
                    echo '<td>'.$div->find('h2',0)->find('span',0).'</td>';
                    echo '<td><a href="http://amazon.co.jp/'.$div->find('a',0)->href.'" target="_blank">Amazon</a></td>';
                    echo '<td>'.$div->find('span.a-price-whole',0).'</td>';
                    echo '<td><img src="'.$div->find('img',0)->src.'"></td></tr>';
                }
            }
            if (strpos($html->find('li.a-last',0),"a-disabled")== false) {

                getData ($html->find('li.a-last',0)->find('a',0)->href);

            }
        }
    }
}
