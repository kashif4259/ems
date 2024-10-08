<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TransactionModel;
use App\SubCategoryModel;
use App\Http\Controllers\TraitSettings;
use App\SettingModel;
use App\AccountModel;
use App;
use DB;
use Auth;

class IncomeTransactionController extends Controller
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
		if (Auth::user()->isrole('2')){
			return view( 'transaction.index' )->with('data', $data);
		} else{
			 return redirect('home')->with('data', $data);
		}
	}

	//show default dashboard view
	public function dashboard() {
		$data = $this->globaldata;
		if (Auth::user()->isrole('3')){
			return view('income.index')->with('data', $data);
		} else{
			 return redirect('home')->with('data', $data);
		}
		
	}


	//show default dashboard view
	public function upcomingincome() {
		$data = $this->globaldata;
		if (Auth::user()->isrole('19')){
			return view('income.upcomingincome')->with('data', $data);
		} else{
			 return redirect('home')->with('data', $data);
		}
		
	}


	/**
	 * Show total transaction by year, month,week and day
	 *
	 * @return object
	 */
	public function total() {
		$totalbalance = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalbalance'))
		->where('type', '=', '1');
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$totalbalance->where('userid', '=', $user_id);
		}
		$totalbalance = $totalbalance->get();

		$year   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '1')
		->whereYear('transactiondate', date('Y'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$year->where('userid', '=', $user_id);
		}
		$year = $year->get();

		$month   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->where('type', '=', '1')
		->whereMonth('transactiondate', '=', date('m'))
		->whereYear('transactiondate', date('Y'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$month->where('userid', '=', $user_id);
		}
		$month = $month->get();

		$week 	= DB::table('transaction')
                ->select(DB::raw('sum(amount) as totalweek'))
                ->whereRaw('type = 1')
				->whereRaw('YEARWEEK(curdate()) = YEARWEEK(transactiondate)');
				if(Auth::user()['role'] == 'Staff'){
					$user_id = Auth::user()['userid'];
					$week->where('userid', '=', $user_id);
				}
                $week = $week->get();

		$day   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalday'))
		->where('type', '=', '1')
		->whereDate('transactiondate', date('Y-m-d'));
		if(Auth::user()['role'] == 'Staff'){
			$user_id = Auth::user()['userid'];
			$day->where('userid', '=', $user_id);
		}
		$day = $day->get();

		$res['totalbalance']  = number_format($totalbalance[0]->totalbalance,2);
		$res['year']    = number_format($year[0]->totalyear,2);
		$res['month']    = number_format($month[0]->totalmonth,2);
		$res['week']    = number_format($week[0]->totalweek,2);
		$res['day']    = number_format($day[0]->totalday,2);


		return response($res);
	}



	/**
	 * Show upcomingtotal transaction by year, month,week and day
	 *
	 * @return object
	 */
	public function totalupcoming() {
		$totalbalance = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalbalance'))
		->where('type', '=', '3')
		->get();

		$year   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalyear'))
		->where('type', '=', '3')
		->whereYear('transactiondate', date('Y'))
		->get();

		$month   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->where('type', '=', '3')
		->whereMonth('transactiondate', '=', date('m'))
		->whereYear('transactiondate', date('Y'))
		->get();

		$week 	= DB::table('transaction')
                ->select(DB::raw('sum(amount) as totalweek'))
                ->whereRaw('type = 3')
				->whereRaw('YEARWEEK(curdate()) = YEARWEEK(transactiondate)')
                ->get();

		$day   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalday'))
		->where('type', '=', '3')
		->whereDate('transactiondate', date('Y-m-d'))
		->get();

		$res['totalbalance']  = number_format($totalbalance[0]->totalbalance,2);
		$res['year']    = number_format($year[0]->totalyear,2);
		$res['month']    = number_format($month[0]->totalmonth,2);
		$res['week']    = number_format($week[0]->totalweek,2);
		$res['day']    = number_format($day[0]->totalday,2);


		return response($res);
	}

	/**
	 * filter total transaction by date
	 *
	 * @param date    $date
	 * @return object
	 */
	public function gettotalfilterdate(Request $request) {
		$date   = $request->input('date');

		$monthincome   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->whereMonth('transactiondate', '=', date('m',strtotime($date)))
		->where('type', '=', '1')
		->get();
		$monthexpense   = DB::table('transaction')
		->select(DB::raw('sum(amount) as totalmonth'))
		->whereMonth('transactiondate', '=', date('m',strtotime($date)))
		->where('type', '=', '2')
		->get();

		$balance       = $monthincome[0]->totalmonth - $monthexpense[0]->totalmonth;
		$res['monthname']    = date('F',strtotime($date));
		$res['monthincome']    = number_format($monthincome[0]->totalmonth,2);
		$res['monthexpense']    = number_format($monthexpense[0]->totalmonth,2);
		$res['monthbalance']   = number_format($balance,2);

		return response($res);
	}

	/**
	 * get data by calendar
	 *
	 * @return object
	 */
	public function getdatacalendar(){

		$data = DB::table('transaction')
		->where('transaction.type','1')
		->select('name as title','transactiondate as start','amount')
		->get();

		return response($data);
	}

	/**
	 * get income from database
	 *
	 * @return object
	 */
	public function getdata(){
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->join('account', 'account.accountid', '=', 'transaction.accountid')
		->select('category.name as category','subcategory.name as subcategory', 'transaction.*','users.name as user','account.name as account')
		->where('transaction.type','1')
		->get();
		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);

			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->addColumn('action', function ($accountsingle) {
				$path = 'upload/income/';
				if($accountsingle->file!=''){
					return '<a  href='.$path.$accountsingle->file.' id="btndownload" class="text-warning" download><i data-toggle="tooltip" data-placement="top" title='. trans('lang.receipt').' class="ti-download"></i> </a>&nbsp;&nbsp;
				
				<a  href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="text-danger" data-toggle="modal" data-target="#delete"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i> </a>';
				}else{
					return '<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="text-danger" data-toggle="modal" data-target="#delete"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i></a>';

				}
			})->make(true);
	}


	/**
	 * get upcoming income from database
	 *
	 * @return object
	 */
	public function getdataupcoming(){
		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->join('users', 'users.userid', '=', 'transaction.userid')
		->select('category.name as category','subcategory.name as subcategory', 'transaction.*','users.name as user')
		->where('transaction.type','3')
		->get();
		return Datatables::of($data)
		->addColumn('amount',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return $setting[0]->currency.number_format($single->amount,2);

			})
		->addColumn('transactiondate',function($single){
				$setting = DB::table('settings')->where('settingsid','1')->get();
				return date($setting[0]->dateformat,strtotime($single->transactiondate));
			})
		->addColumn('action', function ($accountsingle) {
				$path = 'upload/income/';

				if($accountsingle->file!=''){
					return '<a href="#" id="btnpay" customdata='.$accountsingle->transactionid.' class="text-warning" data-toggle="modal" data-target="#pay"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.receive_income').' class="ti-wallet"></i></a>
					&nbsp;&nbsp;<a  href='.$path.$accountsingle->file.' id="btndownload" class="text-warning" download><i data-toggle="tooltip" data-placement="top" title='. trans('lang.receipt').' class="ti-download"></i> </a>&nbsp;&nbsp;
				<a  href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="text-blue-sky" data-toggle="modal" data-target="#edit"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.edit').' class="ti-pencil"></i></a>&nbsp;&nbsp;
				<a  href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="text-danger" data-toggle="modal" data-target="#delete"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i> </a>';
				}else{
					return '<a href="#" id="btnpay" customdata='.$accountsingle->transactionid.' class="text-warning" data-toggle="modal" data-target="#pay"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.receive_income').' class="ti-wallet"></i></a>
					&nbsp;&nbsp;<a  href="#" id="btnedit" customdata='.$accountsingle->transactionid.' class="text-blue-sky" data-toggle="modal" data-target="#edit"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.edit').' class="ti-pencil"></i></a>&nbsp;&nbsp;
				<a href="#" id="btndelete" customdata='.$accountsingle->transactionid.' class="text-danger" data-toggle="modal" data-target="#delete"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i></a>';

				}			
			})->make(true);
	}



	/**
	 * insert data Upcoming income to database
	 *
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveupcoming(Request $request){
		$incomename    = $request->input('incomename');
		$incomeamount    = $request->input('incomeamount');
		$incomereference   = $request->input('incomereference');
		$incomeaccount    = '0';
		$incomecategory   = $request->input('incomecategory');
		$incomesubcategory   = $request->input('incomesubcategory');
		$incomenote    = $request->input('incomenote');
		$incomedate    = $request->input('incomedate');
		$incomefile    = $request->file('incomefile');
		$userid = Auth::user()->userid;
		//enabled extension=php_fileinfo.dll for mimes
		$message = ['incomefile.mimes'=>trans('lang.upload_transaction')];

		
		if($request->hasFile('incomefile')) {
			$this->validate($request, [
				'incomefile' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = str_replace(' ', '-', $request->file('incomefile')->getClientOriginalName());
			$request->file('incomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'3',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'3',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been added';
			return response($res);
		}
	}



	/**
	 * insert data income to database
	 *
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveincome(Request $request){
		$incomename    = $request->input('incomename');
		$incomeamount    = $request->input('incomeamount');
		$incomereference   = $request->input('incomereference');
		$incomeaccount    = $request->input('incomeaccount');
		$incomecategory   = $request->input('incomecategory');
		$incomesubcategory   = $request->input('incomesubcategory');
		$incomenote    = $request->input('incomenote');
		$incomedate    = date('Y-m-d'); //$request->input('incomedate');
		$incomefile    = $request->file('incomefile');
		$userid = Auth::user()->userid;
		//enabled extension=php_fileinfo.dll for mimes
		$message = ['incomefile.mimes'=>trans('lang.upload_transaction')];

		
		if($request->hasFile('incomefile')) {
			$this->validate($request, [
				'incomefile' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = str_replace(' ', '-', $request->file('incomefile')->getClientOriginalName());
			$request->file('incomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'1',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')
			->insert(
				[
				'userid'   =>$userid,
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'1',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been added';
			return response($res);
		}
	}


	/**
	 * update data income to database
	 *
	 * @param int     $id
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveedit(Request $request){
		$id      = $request->input('id');
		$incomename    = $request->input('incomename');
		$incomeamount    = $request->input('incomeamount');
		$incomereference   = $request->input('incomereference');
		$incomeaccount    = $request->input('incomeaccount');
		$incomecategory   = $request->input('incomecategory');
		$incomesubcategory   = $request->input('incomesubcategory');
		$incomenote    = $request->input('incomenote');
		$incomedate    = $request->input('incomedate');
		$incomefile    = $request->file('incomefile');

		$message = ['incomefile.mimes'=>trans('lang.upload_transaction')];


		if($request->hasFile('incomefile')) {
			$this->validate($request, [
				'incomefile' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = str_replace(' ', '-', $request->file('incomefile')->getClientOriginalName());
			$request->file('incomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'1',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'1',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been added';
			return response($res);
		}

	}




	/**
	 * update account to database
	 *
	 * @param int     $id
	 * @param string  $incomeaccount
	 * @return object
	 */
	public function dopay(Request $request){
		$id      		  = $request->input('idincome');
		$incomeaccount    = $request->input('account');
		

		
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				
				'accountid'   =>$incomeaccount,
				'type'    =>'1',
				
				]
			);

		

		if($data){
			$res['success'] = true;
			$res['message']= 'Income has been received';
			return response($res);
		}

	}




	/**
	 * update data upcoming income to database
	 *
	 * @param int     $id
	 * @param string  $incomename
	 * @param double  $incomeamount
	 * @param string  $incomereference
	 * @param string  $incomeaccount
	 * @param string  $incomecategory
	 * @param string  $incomesubcategory
	 * @param string  $incomenote
	 * @param date    $incomedate
	 * @param string  $incomefile
	 * @return object
	 */
	public function saveeditupcoming(Request $request){
		$id      = $request->input('id');
		$incomename    = $request->input('editincomename');
		$incomeamount    = $request->input('editincomeamount');
		$incomereference   = $request->input('editincomereference');
		$incomeaccount = '0';
		$incomecategory   = $request->input('editincomecategory');
		$incomesubcategory   = $request->input('editincomesubcategory');
		$incomenote    = $request->input('editincomenote');
		$incomedate    = $request->input('editincomedate');
		$incomefile    = $request->file('editincomefile');

		$message = ['editincomefile.mimes'=>trans('lang.upload_transaction')];


		if($request->hasFile('editincomefile')) {
			$this->validate($request, [
				'editincomefile' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				],$message);

			$incomefilename  = str_replace(' ', '-', $request->file('editincomefile')->getClientOriginalName());
			$request->file('editincomefile')->move(public_path("/upload/income"), $incomefilename);
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'3',
				'description'  =>$incomenote,
				'file'    =>$incomefilename
				]
			);
		} else{
			$data = DB::table('transaction')->where('transactionid',$id)
			->update(
				[
				'categoryid'  =>$incomesubcategory,
				'accountid'   =>$incomeaccount,
				'name'    =>$incomename,
				'amount'   =>$incomeamount,
				'reference'   =>$incomereference,
				'transactiondate' =>$incomedate,
				'type'    =>'3',
				'description'  =>$incomenote
				]
			);

		}

		if($data){
			$res['success'] = true;
			$res['message']= 'Upcoming Income has been added';
			return response($res);
		}

	}



	/**
	 * delete data income from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function delete(Request $request){
		$id = $request->input('iddelete');

		$delete = DB::table('transaction')->where('transactionid',$id)->delete();

		if($delete){
			$res['success'] = true;
			$res['message']= 'Income has been deleted';
			return response($res);
		}
	}

	/**
	 * get single data income from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function getedit(Request $request){
		$id    = $request->input('id');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->select('category.categoryid as categoryid2', 'transaction.*')
		->where('transaction.type','1')
		->where('transaction.transactionid',$id)
		->get();

		if($data){
			$res['success'] = true;
			$res['message']= $data;
			return response($res);
		}
	}


	/**
	 * get single data upcomingincome from database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function geteditupcoming(Request $request){
		$id    = $request->input('id');

		$data = DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->select('category.categoryid as categoryid2', 'transaction.*')
		->where('transaction.type','3')
		->where('transaction.transactionid',$id)
		->get();

		if($data){
			$res['success'] = true;
			$res['message']= $data;
			return response($res);
		}
	}

	/**
	 * import CSV to Income module
	 * @param string
	 * @return objext
	 */
	public function importcsv(Request $request){
		
		$message = ['csvfile.mimes'=>trans('lang.upload_transaction')];
		$userid =  Auth::id();
		$category = SubCategoryModel::pluck('subcategoryid')->toArray();
		$account = AccountModel::pluck('accountid')->toArray();
		if($request->hasFile('csvfile')){
			$this->validate($request, [
				'csvfile' => 'mimes:csv,txt|max:2048'
				],$message);

            $path = $request->file('csvfile')->getRealPath();
            $data = \Excel::load($path)->get();
           
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['userid' => $userid, 'categoryid' => $value->subcategoryid, 
                    		 'accountid' => $value->accountid, 'name' => $value->name
                    		 , 'amount' => $value->amount, 'reference' => $value->reference
                    		 , 'transactiondate' => date("Y-m-d",strtotime($value->transactiondate)), 'type' => '1'
                    		 , 'description' => $value->description];
                
                	//check if category exist
				             if (!in_array($value->subcategoryid, $category)){
				             	return $res['message']= '2';
				             	exit;
				             }
                   	//check if account exist
                   			if (!in_array($value->accountid, $account)){
				             	return $res['message']= '3';
				             	exit;
				             }
                   	 		

                }
                if(!empty($arr)){
                	//dd($arr);
                    DB::table('transaction')->insert($arr);
					$res['message']= '1';
					
                }
            }
        }else{
        		$res['message']= '0';
    	}

    	return response($res);
	}

	public function downloadcsv(){
		$type='csv';
		$result =  DB::table('transaction')
		->join('subcategory', 'subcategory.subcategoryid', '=', 'transaction.categoryid')
		->join('category', 'category.categoryid', '=', 'subcategory.categoryid')
		->select('category.categoryid as categoryid2', 'transaction.*')
		->where('transaction.type','1')
		->get();
		$array = json_decode(json_encode($result), true);
        return \Excel::create('expertphp_demo', function($excel) use ($array) {
            $excel->sheet('sheet name', function($sheet) use ($array)
            {
                $sheet->fromArray($array);
            });
        })->download($type);
	}

}
