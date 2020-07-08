<?php

namespace App\Jobs\UpdateID;

class UpdateIDMainJob extends AbstractJob
{

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //仕事
        UpdateIDCacheJob::dispatchNow();

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
