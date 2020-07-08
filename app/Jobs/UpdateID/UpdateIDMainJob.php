<?php

namespace App\Jobs\UpdateID;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateIDMainJob extends AbstractJob
{

    public function handle()
    {
        //仕事開始をローグに登録
        $this=debug("start");

        //仕事
        UpdateIDCacheJob::dispatchNow();

        //仕事終了をローグに登録
        $this=debug("finish");
    }
}
