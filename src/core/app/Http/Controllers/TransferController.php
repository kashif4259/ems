<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TransferModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use App;
use Auth;
use App\User;
use App\AccountModel;
use App\BalanceHistoryModel;

class TransferController extends Controller
{
	use TraitSettings;
	public $globaldata;
	
	public function __construct() {
		$data = $this->getapplications();
		$lang = $data[0]->languages;
		App::setLocale($lang);
		$this->globaldata = $data;
		$this->middleware( 'auth' );
	}
	//show default data
	public function index() {
		$data = $this->globaldata;
        
        $accounts = AccountModel::all(['accountid', 'name']);
        
		if (Auth::user()->isrole('21')){
			return view( 'account.transfer.index' )->with([
                'accounts' => $accounts,
				'data' => $data
			]);
		} else{
			 return redirect('home')->with('data', $data);
		}
	}

	//show default data
	public function detail($id) {
		$data = $this->globaldata;
		if (Auth::user()->isrole('5')){
			return view( 'account.detail',compact('id') )->with('data', $data);
		} else{
			 return redirect('home')->with('data', $data);
		}
	}

	/**
	 * Get account data
	 *
	 * @return object
	 */
	public function getdata() {
        $transfers = DB::table('transfers')
			->join('account as af', 'af.accountid', '=', 'transfers.from_account_id')
            ->join('account as at', 'at.accountid', '=', 'transfers.to_account_id')
            ->join('users', 'users.userid', '=', 'transfers.created_by')
            ->select('transfers.id as transferid','af.name as fromaccount', 'at.name as toaccount','transfers.amount','users.name as transferby', 'transfers.created_at as transferdate', 'transfers.description as description')
			->get();
        
		return Datatables::of( $transfers )
		->addColumn( 'amount', function( $single ) {
				$setting = DB::table( 'settings' )->where( 'settingsid', '1' )->get();
				return $setting[0]->currency.number_format( $single->amount, 2 );
			} )
        ->addColumn('transferdate',function($single){
            $setting = DB::table('settings')->where('settingsid','1')->get();
            return date($setting[0]->dateformat,strtotime($single->transferdate));
        })
		->addColumn('description',function($single){
            return (!empty($single->description) ? $single->description : '-') ;
        })
		->make( true );
	}

	/**
	 * Get account data detail
	 *
	 * @return object
	 */
	public function getdatadetail($id){

		$data = DB::select("SELECT p.accountnumber, p.name,COALESCE(a.amount,0) as income,COALESCE(b.amount,0) as expense, COALESCE(p.balance+(COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance from account as p left join (select accountid,sum(amount) as amount from transaction where type=1 group by accountid) as a on a.accountid = p.accountid left join (select accountid,sum(amount) as amount from transaction where type=2 group by accountid) as b on b.accountid = p.accountid where p.accountid = $id group by p.accountid");
			
		$res['accountnumber'] = $data[0]->accountnumber;
		$res['name'] = $data[0]->name;
		$res['balance'] = number_format($data[0]->balance);
		return response($res);

	}

	/**
	 * Get account balance by month
	 *
	 * @return object
	 */
	public function accountbalancebymonth($id){
		
		$year = date('Y');
		$ijan 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=01 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=01 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ifeb 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=02 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=02 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$imar 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=03 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=03 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iapr 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=04 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=04 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$imay 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=05 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=05 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ijun 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=06 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=06 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ijul 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=07 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=07 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iags 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=08 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=08 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$isep 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=09 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=09 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$iokt 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=10 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=10 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$inov 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=11 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=11 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");
		$ides 		= DB::select("SELECT p.accountnumber, 
								  p.name,COALESCE(a.amount,0) as income,
								  COALESCE(b.amount,0) as expense, 
								  COALESCE((COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
								  from account as p 
								  left join (select accountid, 
								  sum(amount) as amount 
								  from transaction 
								  where type=1 and month(transactiondate)=12 and year(transactiondate)=$year group by accountid) as a on a.accountid = p.accountid 
								  left join (select accountid,sum(amount) as amount 
								  from transaction where type=2 and month(transactiondate)=12 and year(transactiondate)=$year group by accountid) as b on b.accountid = p.accountid 
								  where p.accountid = $id group by p.accountid");

        $res['ijan'] = $ijan[0]->balance;
		$res['ifeb'] = $ifeb[0]->balance;
		$res['imar'] = $imar[0]->balance;
		$res['iapr'] = $iapr[0]->balance;
		$res['imay'] = $imay[0]->balance;
		$res['ijun'] = $ijun[0]->balance;
		$res['ijul'] = $ijul[0]->balance;
		$res['iags'] = $iags[0]->balance;
		$res['isep'] = $isep[0]->balance;
		$res['iokt'] = $iokt[0]->balance;
		$res['inov'] = $inov[0]->balance;
		$res['ides'] = $ides[0]->balance;
		

		return response($res);            

	}

	/**
	 * insert data to database
	 *
	 * @param string  $name
	 * @param double  $balance
	 * @param string  $description
	 * @param string  $accountnumber
	 * @return object
	 */
	public function save( Request $request ) {
         
        // Begin transaction
        DB::beginTransaction();

        try {
            $transfer = TransferModel::create([
                'from_account_id' => $request->fromaccount,
                'to_account_id' => $request->toaccount,
                'amount' => $request->amount,
                'created_by' => Auth::user()['userid'],
                'created_at' => date('Y-m-d H:i:s'),
				'description' => $request->description
            ]);
            
            // Update balance of 'from' account
            $fromAccount = AccountModel::where('accountid', $request->fromaccount)->firstOrFail();
            $fromAccount->balance -= $request->amount;
            $fromAccount->save();

            // Update balance of 'to' account
            $toAccount = AccountModel::where('accountid', $request->toaccount)->firstOrFail();
            $toAccount->balance += $request->amount;
            $toAccount->save();
            
            // Record balance changes in history
            $BalanceHistoryModel = BalanceHistoryModel::create([
                'accountid' => $fromAccount->accountid,
                'old_balance' => $fromAccount->balance + $request->amount,
                'new_balance' => $fromAccount->balance,
                'transfer_id' => $transfer->id, // Assuming you have a transfer ID,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
           $BalanceHistoryModel2 = BalanceHistoryModel::create([
                'accountid' => $toAccount->accountid,
                'old_balance' => $toAccount->balance - $request->amount,
                'new_balance' => $toAccount->balance,
                'transfer_id' => $transfer->id, // Assuming you have a transfer ID,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            // Commit transaction
            DB::commit();

            $res['success'] = true;
			$res['message']= 'Transfer successful';
			return response( $res );

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();
            
            $res['success'] = true;
			$res['message']= 'Transfer failed: ' . $e->getMessage();
			return response( $res );
        }
	}



}
