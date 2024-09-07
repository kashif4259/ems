<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferModel extends Model
{
    protected $table 		= 'transfers';
    protected $primarykey	='id'; 
    protected $guarded		= [];
    public $timestamps = false;

    public function fromAccount()
    {
        return $this->belongsTo('App\AccountModel', 'from_account_id', 'accountid');
    }

    public function toAccount()
    {
        return $this->belongsTo('App\AccountModel', 'to_account_id', 'accountid');
    }
}
