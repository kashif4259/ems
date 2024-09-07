<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TransactionModel;
use App\Http\Controllers\TraitSettings;
use App\SettingModel;
use App;
use DB;
use Auth;
class CalendarController extends Controller
{	

    use TraitSettings;
    public $globaldata;


    public function __construct()
    {
        $data = $this->getapplications();
        $lang = $data[0]->languages;
        App::setLocale($lang);
        $this->globaldata = $data;
        $this->middleware('auth');
    }


    //show default data
    public function index(){
        $data = $this->globaldata;
        if (Auth::user()->isrole('8')){
            return view('calendar.index')->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
    	
    }
	
	
	
}
