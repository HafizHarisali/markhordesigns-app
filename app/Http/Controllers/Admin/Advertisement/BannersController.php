<?php
namespace App\Http\Controllers\Admin\Advertisement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class BannersController extends Controller{

	public function index(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Get data
			$query = DB::table('mk_banners')
						->select('*');
			$result['query'] = $query->get();
			$result['total_records'] = $query->count();
			$data = array(
					'title' => 'Advertisement Banners | Markhor Designs',
					'meta_keywords' => 'All Advertisement Banners',
					'meta_description' => 'All Advertisement Banners'
				);
			//return view
			return view('admin.advertisement.banners.manage',$result)->with($data);
		}
		else{
			//Redirect to Admin Login Page
			return redirect()->route('admin_signin');
		}
	}

	public function add(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$data = array(
				'title' => 'Advertisement Banners | Markhor Designs',
				'meta_keywords' => 'All Advertisement Banners',
				'meta_description' => 'All Advertisement Banners'
			);
			//return view
			return view('admin.advertisement.banners.add')->with($data);
		}
		else{

		}
	}
}