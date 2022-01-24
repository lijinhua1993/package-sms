<?php

namespace Lijinhua\Sms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Lijinhua\Sms\Models\SmsLog;

class DbLogger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 验证码
     *
     * @var
     */
    private $code;

    /**
     * 请求结果
     *
     * @var
     */
    private $result;

    /**
     * 发送状态
     *
     * @var
     */
    private $flag;

    /**
     * Create a new job instance.
     */
    public function __construct($code, $result, $flag)
    {
        $this->code   = $code;
        $this->result = $result;
        $this->flag   = $flag;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if (!config('sms.dblog')) {
            return;
        }
        if ($this->code->phoneArea) {
            $mobile = '+' . $this->code->phoneArea . $this->code->phoneNumber;
        } else {
            $mobile = $this->code->phoneNumber;
        }

        $modelName      = config('sms.dblog_model', SmsLog::class);
        $model          = new $modelName();
        $model->mobile  = $mobile;
        $model->data    = json_encode($this->code);
        $model->is_sent = $this->flag;
        $model->result  = $this->result;
        $model->save();
    }
}
