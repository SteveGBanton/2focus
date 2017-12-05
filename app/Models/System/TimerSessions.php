<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimerSessions extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timer_sessions';

    /**
     * @var array
     */
    protected $fillable = [
        'client_id',
        'target_length',
        'focused_length',
        'success',
        'bill_amt',
    ];
}
