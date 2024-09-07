<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\CategoryModel;
use App\SubCategoryModel;
use App\Http\Controllers\TraitSettings;
use DB;
use App;
use Auth;
class ExpenseCategoryController extends Controller
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
	public function expenseindex() {
		$data = $this->globaldata;

		if (Auth::user()->isrole('10')){
            return view( 'category.expense.index' )->with('data', $data);
        } else{
             return redirect('home')->with('data', $data);
        }
		

	}

	

	/**
	 * get category from database
	 *
	 * @return object
	 */
	public function expensegetdata() {
		$expensecategory = CategoryModel::select( ['categoryid', 'color', 'name', 'description'] )->where( 'type', '2' );

		return Datatables::of( $expensecategory )
		->addColumn( 'color', function ( $accountsingle ) {
				return '<span class="label" style= width:70px;background:'.$accountsingle->color.'>&nbsp;&nbsp;&nbsp;&nbsp;<span>';
			} )
		->addColumn( 'action', function ( $accountsingle ) {
				return '<a  href="#" id="btnedit" customdata='.$accountsingle->categoryid.' class="text-blue-sky" data-toggle="modal" data-target="#edit"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.edit').' class="ti-pencil"></i></a>&nbsp;&nbsp;
				<a  href="#" id="btndelete" customdata='.$accountsingle->categoryid.' class="text-danger" data-toggle="modal" data-target="#delete"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i> </a>';

				
			} )
		->rawColumns( ['color', 'action'] )->make( true );
	}

	/**
	 * get subcategory from database
	 *
	 * @return object
	 */
	public function expensesubgetdata() {
		$expensesubcategory = DB::table( 'category' )
		->join( 'subcategory', 'category.categoryid', '=', 'subcategory.categoryid' )
		->select( 'category.name as category', 'subcategory.*' )
		->where( 'category.type', '2' )
		->get();
		return Datatables::of( $expensesubcategory )
		->addColumn( 'action', function ( $accountsingle ) {
				return '<a  href="#" id="btnedit" customdata='.$accountsingle->subcategoryid.' class="text-blue-sky" data-toggle="modal" data-target="#editsub"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.edit').' class="ti-pencil"></i></a>&nbsp;&nbsp;
				<a  href="#" id="btndelete" customdata='.$accountsingle->subcategoryid.' class="text-danger" data-toggle="modal" data-target="#deletesub"><i data-toggle="tooltip" data-placement="top" title='. trans('lang.delete').' class="ti-close"></i> </a>';
			} )->make( true );
	}


	/**
	 * insert data category to database
	 *
	 * @param string  $name
	 * @param string  $description
	 * @param string  $color
	 * @return object
	 */
	public function expensesave( Request $request ) {
		$name    = $request->input( 'name' );
		$description  = $request->input( 'description' );
		$color    = '#'.$request->input( 'color' );
		$data = array( 'name'=>$name, 'color'=>$color, 'description'=>$description, 'type'=>'2' );
		$insert = DB::table( 'category' )->insert( $data );

		if ( $insert ) {
			$res['success'] = true;
			$res['message']= 'Category has been added';
			return response( $res );
		}
	}

	/**
	 * insert data sub category to database
	 *
	 * @param string  $name
	 * @param string  $category
	 * @param string  $description
	 * @return object
	 */
	public function expensesubsave( Request $request ) {
		$category   = $request->input( 'category' );
		$name    = $request->input( 'name' );
		$description  = $request->input( 'description' );

		$data = array( 'name'=>$name, 'categoryid'=>$category, 'description'=>$description, 'type'=>'2' );
		$insert = DB::table( 'subcategory' )->insert( $data );

		if ( $insert ) {
			$res['success'] = true;
			$res['message']= 'Sub Category has been added';
			return response( $res );
		}
	}

	/**
	 * save edit category to database
	 *
	 * @param unknown
	 * @param string  $name
	 * @param integer $id
	 * @param string  $description
	 * @param color   $color
	 * @return object
	 */
	public function expensesaveedit( Request $request ) {
		$id    = $request->input( 'id' );
		$name    = $request->input( 'name' );
		$description  = $request->input( 'description' );
		$color    = "#".$request->input( 'color' );

		$update = DB::table( 'category' )->where( 'categoryid', $id )
		->update(
			[
			'name'   =>$name,
			'description' =>$description,
			'color' =>$color
			]
		);

		if ( $update ) {
			$res['success'] = true;
			$res['message']= 'Category has been updated';
			return response( $res );
		}

	}

	/**
	 * save edit sub category to database
	 *
	 * @param unknown
	 * @param string  $name
	 * @param integer $id
	 * @param string  $description
	 * @return object
	 */
	public function expensesubsaveedit( Request $request ) {
		$id    = $request->input( 'id' );
		$name    = $request->input( 'name' );
		$description  = $request->input( 'description' );
		$category   = $request->input( 'category' );

		$update = DB::table( 'subcategory' )->where( 'subcategoryid', $id )
		->update(
			[
			'name'   =>$name,
			'categoryid' =>$category,
			'description' =>$description
			]
		);

		if ( $update ) {
			$res['success'] = true;
			$res['message']= 'SubCategory has been updated';
			return response( $res );
		}

	}

	/**
	 * delete category to database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function expensedelete( Request $request ) {
		$id = $request->input( 'iddelete' );

		$cektransaction = DB::select("SELECT * from transaction where categoryid in (select subcategoryid from subcategory join category on category.categoryid = subcategory.categoryid where subcategory.categoryid = '$id') and type = 2");
		
		if(count($cektransaction) > 0){
				$res['success'] = 'false';
		}else{
			$delete = DB::table( 'category' )->where( 'categoryid', $id )->delete();
			if ( $delete ) {
				$res['success'] = 'true';
				$res['message']= 'expense Category has been deleted';
				
			}	
		}	
		return response( $res );
	}

	/**
	 * delete sub category to database
	 *
	 * @param integer $id
	 * @return object
	 */
	public function expensesubdelete( Request $request ) {
		$id = $request->input( 'iddelete' );

		$cektransaction = DB::table( 'transaction' )->where( 'categoryid', $id )->first();
		if(!$cektransaction){
			$delete = DB::table( 'subcategory' )->where( 'subcategoryid', $id )->delete();
			if ( $delete ) {
				$res['success'] = 'true';
				$res['message']= 'expense Sub Category has been deleted';
				
			} 
		}else{

				$res['success'] = 'false';
		}
		return response( $res );
	}

	/**
	 * get single data category
	 *
	 * @param integer $id
	 * @return object
	 */
	public function expensegetedit( Request $request ) {
		$id    = $request->input( 'id' );

		$data = DB::table( 'category' )->where( 'categoryid', $id )->get();

		if ( $data ) {
			$res['success'] = true;
			$res['color'] = str_replace( "#", "", $data[0]->color );
			$res['message']= $data;
			return response( $res );
		}
	}

	/**
	 * get single data sub category
	 *
	 * @param integer $id
	 * @return object
	 */
	public function expensesubgetedit( Request $request ) {
		$id    = $request->input( 'id' );

		$data = DB::table( 'subcategory' )->where( 'subcategoryid', $id )->get();

		if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
			return response( $res );
		}
	}

	/**
	 * get single data subcategory by category
	 *
	 * @param integer $id
	 * @return object
	 */
	public function expensesubcategorybycat( Request $request ) {
		$id    = $request->input( 'id' );

		$data = DB::table( 'subcategory' )->where( 'categoryid', $id )->get();

		if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
			return response( $res );
		}
	}
}
