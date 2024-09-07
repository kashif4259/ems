<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Illuminate\Support\Facades\Auth;
use DB;


class LoginController  extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	public function logout() {
	  Auth::logout();
	  return redirect('/login');
	}
	
	 public function authenticate(Request $request)
    {
		$email = $request->input('email');
		$password = $request->input('password');
		$this->validate($request,[
				'email'=>'required',
				'password' => 'required'
		]);
        $user = Auth::attempt(['email' => $email, 'password' => $password, 'status' => 'Active']) ;
        if ($user){
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        } 
            return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => \Lang::get('auth.failed'),
            ]);
        
    }
	

	/**
	 * get application settings
	 *
	 * @return object
	 */
	public function getapplication() {
		$data = DB::table('settings')->where('settingsid', '1')->get();
		if ($data) {

			$res['success'] = true;
			$res['data']  = $data;
			$res['message'] = 'list data';
			return response($res);
		}
	}
	
	public function showLoginForm()
   {
       return view('auth.login');
   }
   

}
