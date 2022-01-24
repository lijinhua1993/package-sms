<?php

namespace Lijinhua\Sms\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{

    protected $guarded = [];

    protected $casts = [
        'is_sent' => 'bool',
    ];
}