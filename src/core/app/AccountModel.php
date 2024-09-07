<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
	//define table, primary and fillable field
	protected $table   		= 'account';
	protected $primaryKey = 'accountid';
	public $timestamps = false;
	protected $keyType = 'int';
	protected $fillable  	= ['name,balance,description','user_id'];

	public function transfersFrom()
    {
        return $this->hasMany('App\TransferModel', 'from_account_id', 'accountid');
    }

    public function transfersTo()
    {
        return $this->hasMany('App\TransferModel', 'to_account_id', 'accountid');
    }

	public function transactions()
    {
        return $this->hasMany(TransactionModel::class, 'accountid', 'accountid');
    }

}
