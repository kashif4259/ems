<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceHistoryModel extends Model
{
    protected $table 		= 'balance_history';
    protected $primarykey	='id'; 
    protected $guarded		= [];
    public $timestamps = false;
 
}
