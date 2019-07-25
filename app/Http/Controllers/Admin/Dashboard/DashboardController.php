<?php
namespace App\Http\Controllers\Admin\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class DashboardController extends Controller{
	//function for redirecting to dashboard if user has current session 
	public function index(Request $request)
    {
       if(!empty($request->session()->has('id') && $request->get('role')==0)){
	       $data = array(
					'title' => 'Dashboard | Markhor Designs',
					'meta_keywords' => 'Admin Dashboard',
					'meta_description' => 'Admin Dashboard'
				); 
            return view('admin.dashboard.index',$data);
        }else{
            $data = array(
				'title' => 'Admin Login | Markhor Designs',
				'meta_keywords' => 'Admin Login',
				'meta_description' => 'Admin Login'
			);
			return redirect()->route('admin_signin')->with($data);
        }
    }

}