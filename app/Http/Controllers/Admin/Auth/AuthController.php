<?php
namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class AuthController extends Controller{

	public function sign_in(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role') == 0)){
			return redirect()->route('admin_dashboard');
		}
		else{
			$data = array(
				'title' => 'Admin Login | Markhor Designs',
				'meta_keywords' => 'Admin Login',
				'meta_description' => 'Admin Login'
			);
			return view('admin.auth.login',$data);
		}
	}

	public function validating_credentials(Request $request){
		if(!empty($request->input('email') && $request->input('password'))){
			//check email and password in database
			$query = DB::table('mk_users')
						->select('*')
						->where('email', $request->input('email'))
						->where('password', sha1($request->input('password')))
						->where('role',0)
						->where('status',0);
			$check = $query->first();
			$check_count = $query->count();
			//check if data is not empty
			if(!empty($check_count > 0 )){

				$data = array(
				'ip_address' => $request->ip(),	
				'user_id' => $check->id,
				'status'  => 0,
				'last_activity' => date('Y-m-d h:i:s')
			);
				$query = DB::table('mk_login_activities')
						->InsertGetId($data);
				//storing user data in session
			$storing_session = session([
				'id' => $check->id,
				'role' => $check->role
			]);
			$notification = array(
				'message' => 'Login Successfully',
				'alert-type' => 'success'
			);
			return redirect()->route('admin_dashboard')->with($notification);
			}
			else{
				$notification = array(
				'message' => 'Invalid Email or Password',
				'alert-type' => 'warning'
			);
			return redirect()->route('admin_signin')->with($notification);
			}
			
			
		}
		else{
			$notification = array(
				'message' => 'All Fields are required',
				'alert-type' => 'warning'
			);
			return redirect()->route('admin_signin')->with($notification);
		}
	}
	


	public function admin_logout(Request $request)
    {	
    	//Change user login_activity status
    	$query = DB::table('mk_login_activities')
    				->select('*')
    				->where('user_id',$request->session()->has('id'))
    				->where('status',0);
    	//Updating login_activity
    	$data = array(
    			'ip_address' => $request->ip(),
				'user_id' => $request->session()->has('id'),
				'status'  => 1,
				'last_activity' => date('Y-m-d h:i:s')
			);
				$query = DB::table('mk_login_activities')
						->InsertGetId($data);
         $request->session()->flush();
         return redirect()->route('admin_signin');
    }









}