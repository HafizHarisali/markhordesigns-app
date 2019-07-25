<?php
namespace App\Http\Controllers\Admin\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class CategoriesController extends Controller{

	public function index(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Get Data of Package Category
			$query = DB::table('mk_portfolio_categories')
						->select('*')
						->orderby('id','desc');
			$result['query'] = $query->paginate(8);
     		$result['total_records'] = $result['query']->count();
     		$data = array(
					'title' => 'Portfolio Categories | Markhor Designs',
					'meta_keywords' => 'All Portfolio Categories',
					'meta_description' => 'All Portfolio Categories'
				);
			//Redirect to Package Category Page
			return view('admin.portfolio.categories.manage',$result)->with($data);  
		}
		else{
			//Redirect to Admin Login Page
			return redirect()->route('admin_signin')->with($data);
		}
	}

	public function add(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$data = array(
					'title' => 'Add Portfolio Category | Markhor Designs',
					'meta_keywords' => 'Add Portfolio Category',
					'meta_description' => 'Add Portfolio Category'
				);
			//Redirecting to View
			return view('admin.portfolio.categories.add')->with($data);
		}
		else{
			//If User Has No Session,Redirect To Login
			return redirect()->route('admin_signin');
		}
	}

	public function insert(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Form Validations
			$input_validations = $request->validate([
	            'category_image' => 'nullable|mimes:jpeg,jpg,png|max:2000|', 
	            'name' => 'required|unique:mk_package_categories'
	        ]);
	        //Check if image is available
	        if(!empty($request->file('category_image'))){
	        	//Upload Image
	        	$image = rand().'.'.$request->file('category_image')->guessExtension();
		        $image_path = $request->file('category_image')->move(public_path().'/assets/admin/images/portfolio/', $image);
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'featured_image' => $image,
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_decription'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        else{
	        	//Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_decription'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for insert data
		        $insert_data = DB::table('mk_portfolio_categories')
		        				->insertGetId($data);
		        if(!empty($insert_data)){
		        $notifications = array(
		        	'message' => 'Category Added Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('portfolio_categories_add')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('portfolio_categories_add')->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function edit(Request $request, $id){

		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Redirect to View
			$data = DB::table('mk_portfolio_categories')
							->select('*')
							->where('id',$id);
			$result['data'] = $data->first();
			$data = array(
					'title' => 'Edit Portfolio Category | Markhor Designs',
					'meta_keywords' => 'Edit Portfolio Category',
					'meta_description' => 'Edit Portfolio Category'
				);
			return view('admin.portfolio.categories.edit',$result);
		}
		else{
			//Redirect to Login
			return redirect()->route('admin_signin');
		}

	}

	public function update(Request $request,$id){

		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Form Validations
			$input_validations = $request->validate([
	            'category_image' => 'nullable|mimes:jpeg,jpg,png|max:2000|'
	        ]);
	        //Check if image is available
	        if(!empty($request->file('category_image'))){
	        	//Upload Image
	        	$image = rand().'.'.$request->file('category_image')->guessExtension();
		        $image_path = $request->file('category_image')->move(public_path().'/assets/admin/images/portfolio/', $image);
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'featured_image' => $image,
		        	'status' => $request->input('status'),
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_decription'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        else{
	        	//Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'status' => $request->input('status'),
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_decription'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for Update data
		        $update_data = DB::table('mk_portfolio_categories')
		        				->where('id',$id)
		        				->update($data);
		        if(!empty($update_data)){
		        $notifications = array(
		        	'message' => 'Category Updated Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('portfolio_categories')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('portfolio_categories_edit',$id)->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}

	}

	public function delete(Request $request,$id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Query for deleting Data
			$query = DB::table('mk_portfolio_categories')
						->where('id',$id)
						->delete();
			//Checking if query is correct
			if(!empty($query)){
				$notifications = array(
					'message' => 'Category Deleted Successfully',
					'alert-type' => 'success'
				);
				return redirect()->back()->with($notifications);
			}
			else{
				$notifications = array(
					'message' => 'Something Went Wrong',
					'alert-type' => 'danger'
				);
				return redirect()->back()->with($notifications);
			}
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	//Filter for package categories
	public function filter_portfolio_categories(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$query = DB::table('mk_portfolio_categories')
							->select('*');
							if(!empty($request->input('filter_name'))){
							$query->where('name','Like','%'.$request->input('filter_name').'%');
							}
							if(!empty($request->input('filter_status'))){
							$query->where('status',$request->input('filter_status'));
							}
                         	$query->orderBy('id', 'DESC');
			$result['query'] = $query->paginate(12);
			$result['total_records'] = $result['query']->count();
			return view('admin.portfolio.categories.manage',$result);
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	//Update Status
	public function update_status(Request $request,$id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			if($request->input('status')=="0"){
				$data = array(
				'status' => $request->input('status'),
				'updated_date_time' => date('Y-m-d H:i:s')
			);
			}
			else if($request->input('status')=="1"){
				$data = array(
				'status' => $request->input('status'),
				'updated_date_time' => date('Y-m-d H:i:s')
			);
			}
			$query = DB::table('mk_portfolio_categories')
						->where('id',$id)
						->update($data);
			if(!empty($query)){
			$notifications=array(
				'message' => 'Status Updated Successfully',
				'alert-type' => 'success'
			);
			return redirect()->route('portfolio_categories')->with($notifications);
			}
			else{
				$notifications=array(
				'message' => 'Something went wrong',
				'alert-type' => 'error'
			);
			return redirect()->route('portfolio_categories')->with($notifications);
			}
	}
	else{
		return redirect()->route('admin_signin');
	}


	}
}