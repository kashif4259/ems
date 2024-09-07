<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\GoalModel;
use App\SettingModel;
use App\Http\Controllers\TraitSettings;
use DB;
use Auth;
use App;
use App\AccountModel;

class ReportsController extends Controller
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

	//show default view
	public function incomereports() {
		$data = $this->globaldata;

		if (Auth::user()->isrole('11')){
            return view( 'reports.income' )->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show expense report view
	public function expensereports() {
		$data = $this->globaldata;
		if (Auth::user()->isrole('12')){
            return view('reports.expense')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}
	//show income vs expense report view
	public function incomevsexpensereports() {
		$data = $this->globaldata;
		if (Auth::user()->isrole('13')){
            return view('reports.incomevsexpense')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
	}

	//show account report view
	public function accountreports() {
		$data = $this->globaldata;
		if (Auth::user()->isrole('16')){
           return view('reports.account')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show income month report view
	public function incomemonth(){
		$data = $this->globaldata;
		if (Auth::user()->isrole('14')){
           return view('reports.incomemonth')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show expense month report view
	public function expensemonth(){
		$data = $this->globaldata;
		if (Auth::user()->isrole('15')){
           return view('reports.expensemonth')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show upcoming income  report view
	public function upcomingincomereports(){
		$data = $this->globaldata;
		if (Auth::user()->isrole('19')){
           return view('reports.upcomingincome')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show upcoming expense  report view
	public function upcomingexpensereports(){
		$data = $this->globaldata;
		if (Auth::user()->isrole('20')){
           return view('reports.upcomingexpense')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		
	}

	//show all report report view
	public function allreports(){
		$data = $this->globaldata;
		return view('reports.reports')->with('data', $data);
	}

	/**
	 * get data income/expense from database
	 *
	 * @param string  $type
	 * @return object
	 */
	public function gettransactions(Request $request){
		$type = $request->input('type');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select(['category.name as category', 'category.categoryid as categoryid1', 'subcategory.subcategoryid as subcategoryid2', 'subcategory.name as subcategory', 'transaction.*', 'users.name as user','account.name as account', 'account.balance as account_balance'])
		->where('transaction.type',$type);

		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('account_balance', function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->account_balance,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->filter(function ($query) use ($request) {
				if ($request->filled('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->filled('category')) {
					$query->where('category.categoryid', 'like', "%{$request->get('category')}%");
				}
				if ($request->filled('subcategory')) {
					$query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
				}
				if ($request->filled('fromdate') && $request->filled('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}

			})
		->make(true);


	}


	/**
	 * get data income/expense from database
	 *
	 * @param string  $type
	 * @return object
	 */
	public function gettransactionsupcoming(Request $request){
		$type = $request->input('type');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select(['category.name as category', 'category.categoryid as categoryid1', 'subcategory.subcategoryid as subcategoryid2', 'subcategory.name as subcategory', 'transaction.*', 'users.name as user'])
		->where('transaction.type',$type);


		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->filter(function ($query) use ($request) {
				if ($request->filled('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->filled('category')) {
					$query->where('category.categoryid', 'like', "%{$request->get('category')}%");
				}
				if ($request->filled('subcategory')) {
					$query->where('subcategory.subcategoryid', 'like', "%{$request->get('subcategory')}%");
				}
				if ($request->filled('fromdate') && $request->filled('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}

			})
		->make(true);


	}



	/**
	 * get data account transaction from database
	 *
	 * @param string  $account
	 * @param date    $fromdate
	 * @param date    $todate
	 * @return object
	 */
	public function getaccounttransaction(Request $request){
		$data = DB::table('transaction')->select(['transaction.*', 'category.name as category', 'subcategory.name as subcategory',DB::raw("IFNULL(a.amount,'-') as income, IFNULL(b.amount,'-') as expense")])
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=1) as a"),function($join){
				$join->on("a.transactionid","=","transaction.transactionid");
			})
		->leftJoin(DB::raw("(select transactionid,amount from transaction where type=2) as b"),function($join){
				$join->on("b.transactionid","=","transaction.transactionid");
			})
		->leftJoin('subcategory','subcategory.subcategoryid','=','transaction.categoryid')
		->leftJoin('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->leftJoin('account', 'account.accountid', '=', 'transaction.accountid');

		return Datatables::of($data)
		->addColumn('income',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				$return = '';
				if($single->income =='-'){
					$return = '-';
				}else {

					$return = '<p class="text-green netincome"><b>'.$setting[0]->currency.number_format($single->income,2).'</b></p>';	
				}
				return $return;
			})
		->addColumn('expense',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				$return = '';
				if($single->expense =='-'){
					$return = '-';
				}else {

					$return = '<p class="text-red netincome"><b>'.$setting[0]->currency.number_format($single->expense,2).'</b></p>';	
				}
				return $return;
			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->filter(function ($query) use ($request) {
				if ($request->filled('names')) {
					$query->where('transaction.name', 'like', "%{$request->get('names')}%");
				}
				if ($request->filled('account')) {
					$query->where('transaction.accountid', 'like', "%{$request->get('account')}%");
				}
				if ($request->filled('fromdate') && $request->filled('todate')) {
					$query->whereBetween('transaction.transactiondate', [$request->get('fromdate'), $request->get('todate')]);
				}


			})
		->rawColumns(['expense', 'income'])
		->make(true);
	}


	/**
	 * get remaining balance from database
	 *
	 * @return object
	 */
	public function getbalance(){

		$yearincome   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '1')
		->whereYear('transactiondate',date('Y'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$yearincome->where('userid', '=', $user_id);
		}
		$yearincome = $yearincome->get();

		$yearexpense   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '2')
		->whereYear('transactiondate',date('Y'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$yearexpense->where('userid', '=', $user_id);
		}
		$yearexpense = $yearexpense->get();


		$monthincome   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->where('type', '=', '1')
		->whereMonth('transactiondate',date('m'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$monthincome->where('userid', '=', $user_id);
		}
		$monthincome = $monthincome->get();

		$monthexpense   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->where('type', '=', '2')
		->whereMonth('transactiondate',date('m'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$monthexpense->where('userid', '=', $user_id);
		}
		$monthexpense = $monthexpense->get();

		$yearbalance   = $yearincome[0]->totalyear - $yearexpense[0]->totalyear;
		$monthbalance   = $monthincome[0]->totalmonth - $monthexpense[0]->totalmonth;

		$res['year']  = number_format($yearbalance,2);
		$res['month']  = number_format($monthbalance,2);

		return response($res);

	}

	/**
	 * get monthly income reports
	 *
	 * @return object
	 */
	public function getincomemonthly(){
		$data = DB::select("SELECT  category.name AS category, transaction.type AS type,
							SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
							COUNT( IF( MONTH(transactiondate) = 1, amount, NULL) ) AS trx_1,
							SUM( IF( MONTH(transactiondate) = 2, amount, 0) ) AS ifeb,
							COUNT( IF( MONTH(transactiondate) = 2, amount, NULL) ) AS trx_2,
							SUM( IF( MONTH(transactiondate) = 3, amount, 0) ) AS imar,
							COUNT( IF( MONTH(transactiondate) = 3, amount, NULL) ) AS trx_3,
							SUM( IF( MONTH(transactiondate) = 4, amount, 0) ) AS iapr,
							COUNT( IF( MONTH(transactiondate) = 4, amount, NULL) ) AS trx_4,
							SUM( IF( MONTH(transactiondate) = 5, amount, 0) ) AS imay,
							COUNT( IF( MONTH(transactiondate) = 5, amount, NULL) ) AS trx_5,
							SUM( IF( MONTH(transactiondate) = 6, amount, 0) ) AS ijun,
							COUNT( IF( MONTH(transactiondate) = 6, amount, NULL) ) AS trx_6,
							SUM( IF( MONTH(transactiondate) = 7, amount, 0) ) AS ijul,
							COUNT( IF( MONTH(transactiondate) = 7, amount, NULL) ) AS trx_7,
							SUM( IF( MONTH(transactiondate) = 8, amount, 0) ) AS iags,
							COUNT( IF( MONTH(transactiondate) = 8, amount, NULL) ) AS trx_8,
							SUM( IF( MONTH(transactiondate) = 9, amount, 0) ) AS isep,
							COUNT( IF( MONTH(transactiondate) = 9, amount, NULL) ) AS trx_9,
							SUM( IF( MONTH(transactiondate) = 10, amount, 0) ) AS iokt,
							COUNT( IF( MONTH(transactiondate) = 10, amount, NULL) ) AS trx_10,
							SUM( IF( MONTH(transactiondate) = 11, amount, 0) ) AS inov,
							COUNT( IF( MONTH(transactiondate) = 11, amount, NULL) ) AS trx_11,
							SUM( IF( MONTH(transactiondate) = 12, amount, 0) ) AS idec,
							COUNT( IF( MONTH(transactiondate) = 12, amount, NULL) ) AS trx_12,
							COUNT(transactionid) AS jml_trx,
							SUM( amount ) AS total
							FROM transaction left join subcategory on transaction.categoryid = subcategory.subcategoryid
										left join category on category.categoryid = subcategory.categoryid where transaction.type = 1 and year(transaction.transactiondate) =".date('Y')."
							GROUP BY transaction.type, category.name
							ORDER BY SUM( amount ) DESC, transaction.type");

		return Datatables::of($data)
		->addColumn('category',function($single){

			return '<p class=" mb-0 netincome"><strong>'. $single->category.'</strong></p>';
			})

		->addColumn('ijan',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijan,2);
			})
		->addColumn('ifeb',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ifeb,2);
			})
		->addColumn('imar',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imar,2);
			})
		->addColumn('iapr',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iapr,2);
			})
		->addColumn('imay',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imay,2);
			})
		->addColumn('ijun',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijun,2);
			})
		->addColumn('ijul',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijul,2);
			})
		->addColumn('iags',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iags,2);
			})
		->addColumn('isep',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->isep,2);
			})
		->addColumn('iokt',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iokt,2);
			})
		->addColumn('inov',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->inov,2);
			})
		->addColumn('idec',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->idec,2);
			})
		->addColumn('total',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				if($single->total>0){
					return '<p class=" mb-0 netincome text-green"><b>'.$setting[0]->currency.number_format($single->total,2).'</b></p>';
				}else{
					return '<p class=" mb-0 netincome text-red"><b>'.$setting[0]->currency.number_format($single->total,2).'</b></p>';
				}
			})
		->rawColumns(['category','total'])
		->make(true);
	}

	/**
	 * get monthly expense reports
	 *
	 * @return object
	 */
	public function getexpensemonthly(){
		$data = DB::select("SELECT  category.name AS category, transaction.type AS type,
							SUM( IF( MONTH(transactiondate) = 1, amount, 0) ) AS ijan,
							COUNT( IF( MONTH(transactiondate) = 1, amount, NULL) ) AS trx_1,
							SUM( IF( MONTH(transactiondate) = 2, amount, 0) ) AS ifeb,
							COUNT( IF( MONTH(transactiondate) = 2, amount, NULL) ) AS trx_2,
							SUM( IF( MONTH(transactiondate) = 3, amount, 0) ) AS imar,
							COUNT( IF( MONTH(transactiondate) = 3, amount, NULL) ) AS trx_3,
							SUM( IF( MONTH(transactiondate) = 4, amount, 0) ) AS iapr,
							COUNT( IF( MONTH(transactiondate) = 4, amount, NULL) ) AS trx_4,
							SUM( IF( MONTH(transactiondate) = 5, amount, 0) ) AS imay,
							COUNT( IF( MONTH(transactiondate) = 5, amount, NULL) ) AS trx_5,
							SUM( IF( MONTH(transactiondate) = 6, amount, 0) ) AS ijun,
							COUNT( IF( MONTH(transactiondate) = 6, amount, NULL) ) AS trx_6,
							SUM( IF( MONTH(transactiondate) = 7, amount, 0) ) AS ijul,
							COUNT( IF( MONTH(transactiondate) = 7, amount, NULL) ) AS trx_7,
							SUM( IF( MONTH(transactiondate) = 8, amount, 0) ) AS iags,
							COUNT( IF( MONTH(transactiondate) = 8, amount, NULL) ) AS trx_8,
							SUM( IF( MONTH(transactiondate) = 9, amount, 0) ) AS isep,
							COUNT( IF( MONTH(transactiondate) = 9, amount, NULL) ) AS trx_9,
							SUM( IF( MONTH(transactiondate) = 10, amount, 0) ) AS iokt,
							COUNT( IF( MONTH(transactiondate) = 10, amount, NULL) ) AS trx_10,
							SUM( IF( MONTH(transactiondate) = 11, amount, 0) ) AS inov,
							COUNT( IF( MONTH(transactiondate) = 11, amount, NULL) ) AS trx_11,
							SUM( IF( MONTH(transactiondate) = 12, amount, 0) ) AS idec,
							COUNT( IF( MONTH(transactiondate) = 12, amount, NULL) ) AS trx_12,
							COUNT(transactionid) AS jml_trx,
							SUM( amount ) AS total
							FROM transaction left join subcategory on transaction.categoryid = subcategory.subcategoryid
										left join category on category.categoryid = subcategory.categoryid where transaction.type = 2 and year(transaction.transactiondate) =".date('Y')."
							GROUP BY transaction.type, category.name
							ORDER BY SUM( amount ) DESC, transaction.type");

		return Datatables::of($data)
		->addColumn('category',function($single){

			return '<p class=" mb-0 netincome"><strong>'. $single->category.'</strong></p>';
			})

		->addColumn('ijan',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijan,2);
			})
		->addColumn('ifeb',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ifeb,2);
			})
		->addColumn('imar',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imar,2);
			})
		->addColumn('iapr',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iapr,2);
			})
		->addColumn('imay',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->imay,2);
			})
		->addColumn('ijun',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijun,2);
			})
		->addColumn('ijul',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->ijul,2);
			})
		->addColumn('iags',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iags,2);
			})
		->addColumn('isep',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->isep,2);
			})
		->addColumn('iokt',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->iokt,2);
			})
		->addColumn('inov',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->inov,2);
			})
		->addColumn('idec',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->idec,2);
			})
		->addColumn('total',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				if($single->total>0){
					return '<p class=" mb-0 netincome text-red"><b>'.$setting[0]->currency.number_format($single->total,2).'</b></p>';
				}else{
					return '<p class=" mb-0 netincome text-green"><b>'.$setting[0]->currency.number_format($single->total,2).'</b></p>';
				}
			})
		->rawColumns(['category','total'])

		->make(true);
	}

	public function userbalance()
	{
		$data = $this->globaldata;
		$users = App\User::where('status', 'Active')->get(['userid', 'name']);
		
		if (Auth::user()->isrole('12')){
            return view('reports.userbalance')->with([
				'data' => $data,
				'users' => $users
			]);
        } else{
             return redirect('home')->with('data', $data);
        }
	}

	public function getuserbalancereportdata(Request $request)
	{
		// \DB::enableQueryLog(); // Enable query log

		$userAccounts = AccountModel::select(
			'users.name as username',
			'account.name as accountname',
			'account.balance as accountbalance',
// 			DB::raw('COALESCE(SUM(transaction.amount), 0) as totalexpense')
            DB::raw('COALESCE(SUM(CASE WHEN transaction.type = 2 THEN transaction.amount ELSE 0 END), 0) as totalexpense'),
    		DB::raw('COALESCE(SUM(CASE WHEN transaction.type = 1 THEN transaction.amount ELSE 0 END), 0) as totalincome')
		)
		->join('users', 'account.user_id', '=', 'users.userid')
		->join('transaction', 'account.accountid', '=', 'transaction.accountid');
		
		if ($request->filled('userid')) {
			$userAccounts->where('account.user_id', $request->get('userid'));
		}

		$userAccounts = $userAccounts->groupBy('account.accountid')
		->get();
		// dd(\DB::getQueryLog()); // Show results of log

		return Datatables::of($userAccounts)
		
		->addColumn('accountbalance', function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->accountbalance,2);
			})
		->addColumn('totalexpense', function($single){
			$setting = DB::table('settings')->where('settingsid','1')->get();
			return $setting[0]->currency.number_format($single->totalexpense,2);
		})
		->addColumn('remainingbalance', function($single){
		
		    if($single->totalincome > 0.00){
		        $total = $single->accountbalance + ($single->totalincome - $single->totalexpense);
		    }else{
		        $total = $single->accountbalance  - $single->totalexpense;
		    }
			$setting = DB::table('settings')->where('settingsid','1')->get();
			$remainingBalance = $total;
			return $setting[0]->currency.number_format($remainingBalance,2);
		})
		->make(true);

	}
	
	public function categoriesreport()
	{
		$data = $this->globaldata;
		$users = App\User::where('status', 'Active')->get(['userid', 'name']);
		
		if (Auth::user()->isrole('12')){
            return view('reports.categories')->with([
				'data' => $data,
				'users' => $users
			]);
        } else{
             return redirect('home')->with('data', $data);
        }
	}

	public function getcategoriesreportdata(Request $request)
	{
		// \DB::enableQueryLog(); // Enable query log
		$totalExpenses = App\TransactionModel::select('category.name as categoryname','subcategory.name as subcategoryname', DB::raw('SUM(transaction.amount) as totalexpense'))
		->join('subcategory', 'transaction.categoryid', '=', 'subcategory.subcategoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->where('transaction.type', '2')
		->groupBy('transaction.categoryid')
		->get();

		return Datatables::of($totalExpenses)
		
		->addColumn('totalexpense', function($single){
			$setting = DB::table('settings')->where('settingsid','1')->get();
			return $setting[0]->currency.number_format($single->totalexpense,2);
		})
		->make(true);

	}
}
