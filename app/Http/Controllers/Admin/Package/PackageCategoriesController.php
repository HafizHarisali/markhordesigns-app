<?php
namespace App\Http\Controllers\Admin\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class PackageCategoriesController extends Controller{

	public function index(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Get Data of Package Category
			$query = DB::table('mk_package_categories')
						->select('*')
						->orderby('id','desc');
			$result['query'] = $query->paginate(8);
     		$result['total_records'] = $result['query']->count();
     		$data = array(
					'title' => 'Package Categories | Markhor Designs',
					'meta_keywords' => 'All Package Categories',
					'meta_description' => 'All Package Categories'
				);
			//Redirect to Package Category Page
			return view('admin.package.categories.manage',$result)->with($data);  
		}
		else{
			//Redirect to Admin Login Page
			$data = array(
				'title' => 'Admin Login | Markhor Designs',
				'meta_keywords' => 'Admin Login',
				'meta_description' => 'Admin Login'
			);
			return redirect()->route('admin_signin')->with($data);
		}
	}

	public function add(Request $request){

		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$data = array(
					'title' => 'Add Package Categories | Markhor Designs',
					'meta_keywords' => 'Add Package Categories',
					'meta_description' => 'Add Package Categories'
				);
			//Redirecting to View
			return view('admin.package.categories.add')->with($data);
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
		        $image_path = $request->file('category_image')->move(public_path().'/assets/admin/images/packages/', $image);
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'featured_image' => $image,
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_description' => $request->input('meta_description'),
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
		        	'meta_description' => $request->input('meta_description'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for insert data
		        $insert_data = DB::table('mk_package_categories')
		        				->insertGetId($data);
		        if(!empty($insert_data)){
		        $notifications = array(
		        	'message' => 'Category Added Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('package_categories_add')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('package_categories_add')->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function edit(Request $request, $id){

		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Redirect to View
			$data = DB::table('mk_package_categories')
							->select('*')
							->where('id',$id);
			$result['data'] = $data->first();
			$data = array(
					'title' => 'Edit Package Category | Markhor Designs',
					'meta_keywords' => 'Edit Package Category',
					'meta_description' => 'Edit Package Category'
				);
			return view('admin.package.categories.edit',$result)->with($data);
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
		        $image_path = $request->file('category_image')->move(public_path().'/assets/admin/images/packages/', $image);
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('name'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('name'))),
		        	'featured_image' => $image,
		        	'status' => $request->input('status'),
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_description' => $request->input('meta_description'),
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
		        	'meta_description' => $request->input('meta_description'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for Update data
		        $update_data = DB::table('mk_package_categories')
		        				->where('id',$id)
		        				->update($data);
		        if(!empty($update_data)){
		        $notifications = array(
		        	'message' => 'Category Updated Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('package_categories')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('package_categories_edit',$id)->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}

	}

	public function delete(Request $request,$id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Query for deleting Data
			$query = DB::table('mk_package_categories')
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
	public function filter_package_categories(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$query = DB::table('mk_package_categories')
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
			return view('admin.package.categories.manage',$result);
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
			$query = DB::table('mk_package_categories')
						->where('id',$id)
						->update($data);
			if(!empty($query)){
			$notifications=array(
				'message' => 'Status Updated Successfully',
				'alert-type' => 'success'
			);
			return redirect()->route('package_categories')->with($notifications);
			}
			else{
				$notifications=array(
				'message' => 'Something went wrong',
				'alert-type' => 'error'
			);
			return redirect()->route('package_categories')->with($notifications);
			}
	}
	else{
		return redirect()->route('admin_signin');
	}


	}
}