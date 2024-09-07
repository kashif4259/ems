<?php

namespace App\Http\Controllers;
use App\TransactionModel;
use App\SettingModel;
use App\UserModel;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\TraitSettings;
use App;
use DB;
use Auth;
use App\AccountModel;

class HomeController extends Controller
{
	
	use TraitSettings;
	public $globaldata;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		
		 $data = $this->getapplications();
		// echo $data;
		 $lang = $data[0]->languages;
		 App::setLocale($lang);
		$this->middleware( 'auth' );
		$this->globaldata = $data;
		
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$data = $this->globaldata;
		return view( 'dashboard.index')->with('data', $data);
	}

	/**
	 * Show income vs expense by month.
	 *
	 * @return object
	 */

	public function incomevsexpense() {

		$thisyear= date("Y");

		$ijan   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ijan->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ijan->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ijan->where('account.user_id', '=', $user_id);
		}
		$ijan = $ijan->get();
		$ifeb   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ifeb->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ifeb->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ifeb->where('account.user_id', '=', $user_id);
		}
		$ifeb = $ifeb->get();
		$imar   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$imar->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$imar->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$imar->where('account.user_id', '=', $user_id);
		}
		$imar = $imar->get();
		$iapr   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iapr->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iapr->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iapr->where('account.user_id', '=', $user_id);
		}
		$iapr = $iapr->get();
		$imay   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$imay->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$imay->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$imay->where('account.user_id', '=', $user_id);
		}
		$imay = $imay->get();
		$ijun   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ijun->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ijun->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ijun->where('account.user_id', '=', $user_id);
		}
		$ijun = $ijun->get();
		$ijul   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ijul->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ijul->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ijul->where('account.user_id', '=', $user_id);
		}
		$ijul = $ijul->get();
		$iags   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iags->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iags->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iags->where('account.user_id', '=', $user_id);
		}
		$iags = $iags->get();
		$isep   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$isep->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$isep->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$isep->where('account.user_id', '=', $user_id);
		}
		$isep = $isep->get();
		$iokt   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iokt->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iokt->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iokt->where('account.user_id', '=', $user_id);
		}
		$iokt = $iokt->get();
		$inov   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$inov->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$inov->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$inov->where('account.user_id', '=', $user_id);
		}
		$inov = $inov->get();
		$ides   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ides->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ides->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$inov->where('account.user_id', '=', $user_id);
		}
		$ides = $ides->get();

		//upcoming income
		$uijan   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uijan->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uijan->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$inov->where('account.user_id', '=', $user_id);
		}
		$uijan = $uijan->get();
		$uifeb   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uifeb->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uifeb->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$inov->where('account.user_id', '=', $user_id);
		}
		$uifeb = $uifeb->get();
		$uimar   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uimar->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uimar->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uimar->where('account.user_id', '=', $user_id);
		}
		$uimar = $uimar->get();
		$uiapr   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uiapr->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uiapr->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uiapr->where('account.user_id', '=', $user_id);
		}
		$uiapr = $uiapr->get();
		$uimay   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uimay->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uimay->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uimay->where('account.user_id', '=', $user_id);
		}
		$uimay = $uimay->get();
		$uijun   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uijun->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uijun->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uijun->where('account.user_id', '=', $user_id);
		}
		$uijun = $uijun->get();
		$uijul   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uijul->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uijul->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uijul->where('account.user_id', '=', $user_id);
		}
		$uijul = $uijul->get();
		$uiags   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uiags->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uiags->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uiags->where('account.user_id', '=', $user_id);
		}
		$uiags = $uiags->get();
		$uisep   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uisep->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uisep->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uisep->where('account.user_id', '=', $user_id);
		}
		$uisep = $uisep->get();
		$uiokt   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uiokt->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uiokt->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uiokt->where('account.user_id', '=', $user_id);
		}
		$uiokt = $uiokt->get();
		$uinov   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uinov->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uinov->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uinov->where('account.user_id', '=', $user_id);
		}
		$uinov = $uinov->get();
		$uides   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$uides->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$uides->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$uides->where('account.user_id', '=', $user_id);
		}
		$uides = $uides->get();

		//expense
		$ejan   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ejan->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ejan->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ejan->where('account.user_id', '=', $user_id);
		}
		$ejan = $ejan->get();
		$efeb   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$efeb->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$efeb->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$efeb->where('account.user_id', '=', $user_id);
		}
		$efeb = $efeb->get();
		$emar   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$emar->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$emar->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$emar->where('account.user_id', '=', $user_id);
		}
		$emar = $emar->get();
		$eapr   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$eapr->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$eapr->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$eapr->where('account.user_id', '=', $user_id);
		}
		$eapr = $eapr->get();
		$emay   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$emay->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$emay->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$emay->where('account.user_id', '=', $user_id);
		}
		$emay = $emay->get();
		$ejun   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ejun->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ejun->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ejun->where('account.user_id', '=', $user_id);
		}
		$ejun = $ejun->get();
		$ejul   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ejul->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ejul->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ejul->where('account.user_id', '=', $user_id);
		}
		$ejul = $ejul->get();
		$eags   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$eags->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$eags->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$eags->where('account.user_id', '=', $user_id);
		}
		$eags = $eags->get();
		$esep   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$esep->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$esep->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$esep->where('account.user_id', '=', $user_id);
		}
		$esep = $esep->get();
		$eokt   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$eokt->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$eokt->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$eokt->where('account.user_id', '=', $user_id);
		}
		$eokt = $eokt->get();
		$enov   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$enov->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$enov->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$enov->where('account.user_id', '=', $user_id);
		}
		$enov = $enov->get();
		$edes   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$edes->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$edes->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '2')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$edes->where('account.user_id', '=', $user_id);
		}
		$edes = $edes->get();


		//upcoming expense
		$iejan   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iejan->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iejan->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '01')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iejan->where('account.user_id', '=', $user_id);
		}
		$iejan = $iejan->get();
		$iefeb   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iefeb->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iefeb->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '02')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iefeb->where('account.user_id', '=', $user_id);
		}
		$iefeb = $iefeb->get();
		$iemar   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iemar->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iemar->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '03')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iemar->where('account.user_id', '=', $user_id);
		}
		$iemar = $iemar->get();
		$ieapr   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ieapr->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ieapr->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '04')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ieapr->where('account.user_id', '=', $user_id);
		}
		$ieapr = $ieapr->get();
		$iemay   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iemay->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iemay->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '05')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iemay->where('account.user_id', '=', $user_id);
		}
		$iemay = $iemay->get();
		$iejun   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iejun->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iejun->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '06')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iejun->where('account.user_id', '=', $user_id);
		}
		$iejun = $iejun->get();
		$iejul   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iejul->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iejul->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '07')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iejul->where('account.user_id', '=', $user_id);
		}
		$iejul = $iejul->get();
		$ieags   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ieags->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ieags->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '08')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ieags->where('account.user_id', '=', $user_id);
		}
		$ieags = $ieags->get();
		$iesep   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iesep->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iesep->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '09')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iesep->where('account.user_id', '=', $user_id);
		}
		$iesep = $iesep->get();
		$ieokt   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ieokt->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ieokt->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '10')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ieokt->where('account.user_id', '=', $user_id);
		}
		$ieokt = $ieokt->get();
		$ienov   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$ienov->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$ienov->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '11')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$ienov->where('account.user_id', '=', $user_id);
		}
		$ienov = $ienov->get();
		$iedes   = DB::table('transaction');
		if(Auth::user()['role'] == 'Staff'){
			$iedes->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$iedes->select(DB::raw('sum(amount) as amount'))
		->where('type', '=', '4')
		->whereMonth('transactiondate', '=', '12')
		->whereYear('transactiondate', '=', $thisyear);
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$iedes->where('account.user_id', '=', $user_id);
		}
		$iedes = $iedes->get();

		$res['ijan'] = $ijan[0]->amount;
		$res['ifeb'] = $ifeb[0]->amount;
		$res['imar'] = $imar[0]->amount;
		$res['iapr'] = $iapr[0]->amount;
		$res['imay'] = $imay[0]->amount;
		$res['ijun'] = $ijun[0]->amount;
		$res['ijul'] = $ijul[0]->amount;
		$res['iags'] = $iags[0]->amount;
		$res['isep'] = $isep[0]->amount;
		$res['iokt'] = $iokt[0]->amount;
		$res['inov'] = $inov[0]->amount;
		$res['ides'] = $ides[0]->amount;


		$res['uijan'] = $uijan[0]->amount;
		$res['uifeb'] = $uifeb[0]->amount;
		$res['uimar'] = $uimar[0]->amount;
		$res['uiapr'] = $uiapr[0]->amount;
		$res['uimay'] = $uimay[0]->amount;
		$res['uijun'] = $uijun[0]->amount;
		$res['uijul'] = $uijul[0]->amount;
		$res['uiags'] = $uiags[0]->amount;
		$res['uisep'] = $uisep[0]->amount;
		$res['uiokt'] = $uiokt[0]->amount;
		$res['uinov'] = $uinov[0]->amount;
		$res['uides'] = $uides[0]->amount;



		$res['ejan'] = $ejan[0]->amount;
		$res['efeb'] = $efeb[0]->amount;
		$res['emar'] = $emar[0]->amount;
		$res['eapr'] = $eapr[0]->amount;
		$res['emay'] = $emay[0]->amount;
		$res['ejun'] = $ejun[0]->amount;
		$res['ejul'] = $ejul[0]->amount;
		$res['eags'] = $eags[0]->amount;
		$res['esep'] = $esep[0]->amount;
		$res['eokt'] = $eokt[0]->amount;
		$res['enov'] = $enov[0]->amount;
		$res['edes'] = $edes[0]->amount;


		$res['iejan'] = $iejan[0]->amount;
		$res['iefeb'] = $iefeb[0]->amount;
		$res['iemar'] = $iemar[0]->amount;
		$res['ieapr'] = $ieapr[0]->amount;
		$res['iemay'] = $iemay[0]->amount;
		$res['iejun'] = $iejun[0]->amount;
		$res['iejul'] = $iejul[0]->amount;
		$res['ieags'] = $ieags[0]->amount;
		$res['iesep'] = $iesep[0]->amount;
		$res['ieokt'] = $ieokt[0]->amount;
		$res['ienov'] = $ienov[0]->amount;
		$res['iedes'] = $iedes[0]->amount;

		return response($res);
	}

	/**
	 * Show expense by category monthly.
	 *
	 * @return object
	 */
	public function expensebycategory() {
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid');
		if(Auth::user()['role'] == 'Staff'){
			$data->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$data->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '2')
		->whereMonth('transactiondate', '=', date("m"));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$data->where('account.user_id', '=', $user_id);
		}
		$data = $data->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show upcoming expense by category monthly.
	 *
	 * @return object
	 */
	public function upcomingexpensebycategory() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '4')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show expense by category yearly.
	 *
	 * @return object
	 */
	public function expensebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '2')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show expense by category yearly.
	 *
	 * @return object
	 */
	public function upcomingexpensebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->where('transaction.type', '4')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show income by category monthly.
	 *
	 * @return object
	 */
	public function incomebycategory() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid');
		if(Auth::user()['role'] == 'Staff'){
			$data->join('account', 'account.accountid', '=', 'transaction.accountid');
		}
		$data->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '1')
		->whereMonth('transactiondate', '=', date("m"));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$data->where('account.user_id', '=', $user_id);
		}
		$data = $data->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show income by category yearly.
	 *
	 * @return object
	 */
	public function incomebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '1')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}


	/**
	 * Show upcoming income by category yearly.
	 *
	 * @return object
	 */
	public function upcomingincomebycategoryyearly() {

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '1')
		->where('transaction.type', '3')
		->whereYear('transactiondate', '=', date("Y"))
		->groupBy('category.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show total balance.
	 *
	 * @return object
	 */
	public function totalbalance() {
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(DB::raw('sum(amount) as amount, category.name as category, category.color as color'))
		->where('category.type', '2')
		->whereMonth('transactiondate', '=', date("m"))
		->groupBy('transaction.categoryid')
		->groupBy('category.name')
		->groupBy('category.color')
		->get();
		return response($data);
	}

	/**
	 * Show account balance.
	 *
	 * @return object
	 */
	public function accountbalance(){
		$user_id = '';
		
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$where = "p.user_id = $user_id";
		}
		
		$data = DB::select("SELECT p.name,COALESCE(a.amount,0) as income,COALESCE(b.amount,0) as expense, 
		COALESCE(p.balance+(COALESCE(a.amount,0)-COALESCE(b.amount,0)),0) as balance 
		from account as p 
		left join (select accountid,sum(amount) as amount from transaction where type=1 and year(transactiondate)=".date('Y')." group by accountid) as a on a.accountid = p.accountid ".($user_id ? "AND p.user_id = $user_id" : '')."
		left join (select accountid,sum(amount) as amount from transaction where type=2 and year(transactiondate)=".date('Y')." group by accountid) as b on b.accountid = p.accountid ".($user_id ? "AND p.user_id = $user_id" : '').
		($user_id ? " WHERE p.user_id = $user_id" : '')."
		group by p.accountid");
		return response($data);
	}

	/**
	 * Show budget list.
	 *
	 * @return object
	 */

	public function budgetlist(){
		$data = DB::table('budget')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'budget.categoryid')
		->join('category', 'subcategory.categoryid', '=', 'category.categoryid')
		->whereMonth('budget.fromdate', '=', date("m"))
		->groupBy('budget.categoryid')
		->get();

		return response($data);
	}

	/**
	 * Show latest 10 income from database
	 *
	 * @return object
	 */
	public function latestincome(){
		$data  = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select('category.name as category', 'subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account');
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$data->where('account.user_id', '=', $user_id);
		}
		$data = $data->where('transaction.type','1')
		->offset(0)->limit(10)
		->orderBy('transactiondate', 'desc')
		->get();

		$res['success'] = 'success';
        $res['data']	= $data;

       	return response( $res );
	}



	/**
	 * Show latest 10 expense from database
	 *
	 * @return object
	 */
	public function latestexpense(){
		$data  = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select('category.name as category', 'subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account')
		->where('transaction.type','2');
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$data->where('account.user_id', '=', $user_id);
		}
		$data = $data->offset(0)->limit(10)
		->orderBy('transactiondate', 'desc')
		->get();

		$res['success'] = 'success';
        $res['data']	= $data;

       	return response( $res );

	}

	public function userbalancereport(Request $request){
		$userAccounts = AccountModel::select(
			'users.name as username',
			'account.name as accountname',
			'account.balance as accountbalance',
// 			DB::raw('COALESCE(SUM(transaction.amount), 0) as totalexpense')
            DB::raw('COALESCE(SUM(CASE WHEN transaction.type = 2 THEN transaction.amount ELSE 0 END), 0) as totalexpense'),
    		DB::raw('COALESCE(SUM(CASE WHEN transaction.type = 1 THEN transaction.amount ELSE 0 END), 0) as totalincome')
		)
		->join('users', 'account.user_id', '=', 'users.userid')
		->leftJoin('transaction', 'account.accountid', '=', 'transaction.accountid');

		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$userAccounts->where('account.user_id', '=', $user_id);
		}

		$userAccounts = $userAccounts->groupBy('account.accountid')
		->get();
		
		$res['success'] = 'success';
        $res['data']	= $userAccounts;

       	return response( $res );
	}
}
