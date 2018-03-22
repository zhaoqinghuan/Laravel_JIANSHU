<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SeedMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //  将传入参数定义一个私有的属性
    private $notice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Notice $notice)
    {//  在构造函数中将通知信息传入 应用模型绑定的方式

        $this->notice = $notice;//  将传递进来的notice属性传递给私有notice
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {// 实际要执行的操作
        //  将通知分发给每个用户
        $users = \App\User::all();//将当前所有的用户信息拿出来
        foreach ($users as $user){//  将所有的用户轮询出来
            $user->addNotices($this->notice);// 将系统通知下发给所有用户
        }
    }
}
