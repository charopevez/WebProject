<?php

namespace App\Jobs\UpdateID;

class UpdateIDMainJob extends AbstractJob
{
    protected $categories;

    public function __construct($categoryId)
    {

    }

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //
        $chainMain=[
            new UpdateIDfromAmazonJob(),
            new UpdateIdGetJanCodeJob(),
            new UpdateIDfromRakutenJob(),
            new UpdateIDfromYahooJob()
        ];

        $chainLast=[
            new UpdateIDUpdateDatabaseJob()
        ];

        $chain=array_merge($chainMain,$chainLast);

        UpdateIDJob::withChain($chain)->dispatch();


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
