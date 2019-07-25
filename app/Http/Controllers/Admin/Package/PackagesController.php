<?php
namespace App\Http\Controllers\Admin\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Exception;

class PackagesController extends Controller{

	public function index(Request $request){
		//Check User Session
		try{
			if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
				//Get Data of Packages
				$query = DB::table('mk_packages')
							->select('mk_packages.*','mk_package_categories.id as category_id',
							'mk_package_categories.name as category_name')
							->leftjoin('mk_package_categories','package_category_id','=','mk_package_categories.id')
							->orderby('id','desc');
				$result['query'] = $query->paginate(8);
	     		$result['total_records'] = $result['query']->count();
	     		$data = array(
					'title' => 'Packages | Markhor Designs',
					'meta_keywords' => 'All Packages',
					'meta_description' => 'All Packages'
				);
				//Redirect to Packages Page
				return view('admin.package.packages.manage',$result)->with($data);  
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
		catch(Exception $e){
			$notifications = array(
				'message' => 'Error in code',
				'alert-type' => 'error'
			);
			return redirect()->back()->with($notifications);
		}
	}

	public function add(Request $request){
		//Check User Session
		try{
			if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
				//Getting Categories
				$query = DB::table('mk_package_categories')
							->select('*');
				$result['query'] = $query->get();
				$result['total_categories'] = $query->count();
				$data = array(
					'title' => 'Add Package | Markhor Designs',
					'meta_keywords' => 'Add Packages',
					'meta_description' => 'Add Packages'
				);
				return view('admin.package.packages.add',$result)->with($data);
			}
			else{
				//If User Has No Session,Redirect To Login
				return redirect()->route('admin_signin');
			}
		}
		catch(Exception $e){
			$notifications = array(
				'message' => 'Error in code',
				'alert-type' => 'error'
			);
			return redirect()->back()->with($notifications);
		}
	}

	public function insert(Request $request){
		//Check User Session
		try{
			if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
		        //Check if image is available
		        if(!empty($request->file('package_image') || $request->file('package_images'))){
		        	//Upload Image
		        	$image = rand().'.'.$request->file('package_image')->guessExtension();
			        $image_path = $request->file('package_image')->move(public_path().'/assets/admin/images/packages/package/', $image);
			        //Check if name is duplicate
			        $query = DB::table('mk_packages')
			        			->select('name')
			        			->get();
			        if(!empty($query->count()) > 0){
				        foreach ($query as $row) {
				        	if(!empty($request->input('title') == $row->name)){
				        		$name = $request->input('title').' '.'Copy';
				        	}
				        }
			    	}
			    	else{
			    		$name = $request->input('title');
			    	}
			        
			        //Set Data For Insert
			        $data = array(
			        	'name' => $name,
			        	'slug' => strtolower(str_replace(' ', '-', $name)),
			        	'featured_image' => $image,
			        	'package_offers' => implode(',',$request->input('package_offer')),
			        	'package_price' => $request->input('price'),
			        	'package_description' => $request->input('details'),
			        	'package_category_id' => $request->input('category_id'),
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
			        	'name' => $name,
			        	'slug' => strtolower(str_replace(' ', '-', $name)),
			        	'package_offers' => implode($request->input('package_offer')),
			        	'package_price' => $request->input('price'),
			        	'package_description' => $request->input('details'),
			        	'package_category_id' => $request->input('category_id'),
			        	'status' => 0,
			        	'added_by' =>$request->session()->has('id'),
			        	'meta_keywords' => $request->input('meta_keywords'),
			        	'meta_description' => $request->input('meta_description'),
			        	'created_date_time' => date('Y-m-d H:i:s'),
			        	'updated_date_time' => date('Y-m-d H:i:s')
			        );
		        }
		        	//Query for insert data
			        $insert_data = DB::table('mk_packages')
			        				->insertGetId($data);
			        
			        //Gallery Images data
		        foreach($request->file('package_images') as $img){
		        	//Upload Gallery Images
			        $images = uniqid().'.'.$img->guessExtension();
			        $image_path = $img->move(public_path().'/assets/admin/images/packages/package/', $images);
	        		//Set Data for insert
			        $data = array(
			        	'image' => $images,
			        	'package_id' => $insert_data,
			        	'created_date_time' => date('Y-m-d H:i:s')
			        );
			        
			        //Query For Inserting Data
			    	$query = DB::table('mk_package_images')
			    	             ->insertGetId($data);	 
		        }       
			        
			        if(!empty($insert_data) || $insert_images_data){
			        $notifications = array(
			        	'message' => 'Package Added Successfully',
			        	'alert-type' => 'success'
			        	);
			        	return redirect()->route('packages_add')->with($notifications);
			   		 }
			   		else{
			   			$notifications = array(
			        	'message' => 'Something Went Wrong',
			        	'alert-type' => 'danger'
			        	);
			        	return redirect()->route('packages_add')->with($notifications);
			   		 }
				}
			else{
				return redirect()->route('admin_signin');
			}
		}
		catch(Exception $e){
			$notifications = array(
				'message' => 'Error in code',
				'alert-type' => 'error'
			);
			return redirect()->back()->with($notifications);
		}
	}

	public function edit(Request $request, $id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Get Package Data
			$data = DB::table('mk_packages')
							->select('*')
							->where('id',$id);
			//Get Package Categories
			$query = DB::table('mk_package_categories')
						->select('*');
			//Get Package Gallery Images
			$images = DB::table('mk_package_images')
						->select('*')
						->where('package_id',$id);
			//Get Package Offers
			$offers = DB::table('mk_packages')
						->select('package_offers')
						->where('id',$id)
						->first();
			$offer_array = explode(',',$offers->package_offers);
			$result['offer_array'] = $offer_array;
			$result['data'] = $data->first();
			$result['query'] = $query->get();
			$result['images'] = $images->get();
			$result['total_images'] = $images->count();			
			$result['total_categories'] = $query->count();
			$data = array(
					'title' => 'Edit Package | Markhor Designs',
					'meta_keywords' => 'Edit Package',
					'meta_description' => 'Edit Package'
				);
			return view('admin.package.packages.edit',$result)->with($data);
		}
		else{
			//Redirect to Login
			return redirect()->route('admin_signin');
		}

	}

	public function update(Request $request,$id){

		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
	        //Check if image is available
	        if(!empty($request->file('package_image'))){
	        	//Upload Image
	        	$image = rand().'.'.$request->file('package_image')->guessExtension();
		        $image_path = $request->file('package_image')->move(public_path().'/assets/admin/images/packages/package/', $image);
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('title'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('title'))),
		        	'featured_image' => $image,
		        	'package_offers' => implode(',',$request->input('package_offer')),
		        	'package_price' => $request->input('price'),
		        	'package_description' => $request->input('details'),
		        	'package_category_id' => $request->input('category_id'),
		        	'status' => $request->input('status'),
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_description' => $request->input('meta_description'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        else{
	        	//Set Data For Insert
		        $data = array(
		        	'name' => $request->input('title'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('title'))),
		        	'package_offers' => implode(',',$request->input('package_offer')),
		        	'package_price' => $request->input('price'),
		        	'package_description' => $request->input('details'),
		        	'package_category_id' => $request->input('category_id'),
		        	'status' => $request->input('status'),
		        	'added_by' =>$request->session()->has('id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_description' => $request->input('meta_description'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for update data
		        $insert_data = DB::table('mk_packages')
		        				->where('id',$id)
		        				->update($data);
		      if(!empty($request->file('package_images'))){
		      	//Delete old images from directory
		      	$check_images = DB::table('mk_package_images')
	        					->select('image')
	        					->where('package_id',$id)
	        					->get();
	        	if(!empty($check_images->count()) > 0){
		        	foreach ($check_images as $row_images){
			        	$image_path = public_path().'/assets/admin/images/packages/package/'.$row_images->image;
			        	unlink($image_path);
		        	}
	        	}
	        	//Delete old images from db
		      	$delete_images_query = DB::table('mk_package_images')
	        							->where('package_id',$id)
	        							->delete(); 
	        	// print_r($image_path);die;
	        	    //Gallery Images data
		        foreach($request->file('package_images') as $img){
		        	//Upload Gallery Images
			        $images = uniqid().'.'.$img->guessExtension();
			        $image_path = $img->move(public_path().'/assets/admin/images/packages/package/', $images);
	        		//Set Data for insert
			        $data = array(
			        	'image' => $images,
			        	'package_id' => $id,
			        	'created_date_time' => date('Y-m-d H:i:s')
			        );
			        
			        //Query For Inserting Data
			    	$query = DB::table('mk_package_images')
			    	             ->insertGetId($data);	 
	        	} 
	        }
		        
	        if(!empty($insert_data) || $insert_images_data){
	        $notifications = array(
	        	'message' => 'Package Updated Successfully',
	        	'alert-type' => 'success'
	        	);
	        	return redirect()->route('packages')->with($notifications);
	   		 }
	   		else{
	   			$notifications = array(
	        	'message' => 'Something Went Wrong',
	        	'alert-type' => 'danger'
	        	);
	        	return redirect()->route('packages_edit',$id)->with($notifications);
	   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}

	}

	public function delete(Request $request,$id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Query for deleting Data
			$query = DB::table('mk_packages')
						->where('id',$id)
						->delete();
			//Checking if query is correct
			if(!empty($query)){
				$notifications = array(
					'message' => 'Package Deleted Successfully',
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
	public function filter_packages(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$query = DB::table('mk_packages')
						->select('mk_packages.*','mk_package_categories.id as category_id',
						'mk_package_categories.name as category_name')
						->leftjoin('mk_package_categories','package_category_id','=','mk_package_categories.id')
						->orderby('id','desc');
						if(!empty($request->input('name'))){
						$query->where('mk_packages.name','Like','%'.$request->input('name').'%');
						}
						if(!empty($request->input('price'))){
						$query->where('mk_packages.package_price','Like','%'.$request->input('price').'%');
						}
						if(!empty($request->input('category'))){
						$query->where('mk_package_categories.name','Like','%'.$request->input('category').'%');
						}
						if(!empty($request->input('status'))){
						$query->where('mk_packages.status',$request->input('status'));
						}
                     	$query->orderBy('mk_packages.id', 'DESC');
			$result['query'] = $query->paginate(12);
			$result['total_records'] = $result['query']->count();
			return view('admin.package.packages.manage',$result);
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
			$query = DB::table('mk_packages')
						->where('id',$id)
						->update($data);
			if(!empty($query)){
			$notifications=array(
				'message' => 'Status Updated Successfully',
				'alert-type' => 'success'
			);
			return redirect()->route('packages')->with($notifications);
			}
			else{
				$notifications=array(
				'message' => 'Something went wrong',
				'alert-type' => 'error'
			);
			return redirect()->route('packages')->with($notifications);
			}
	}
	else{
		return redirect()->route('admin_signin');
	}


	}

	// public function check_name(Request $request){
	// 	if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
	// 		$query = DB::table('mk_packages')
	// 					->select('name')
	// 					->where('name','like','%'.$request->input('title').'%');
	// 		$result = $query->first();
	// 		if(!empty($request->input('title') == $result->name)){
	// 			$html = 'name already in database';
	// 			$ajax_response_data = array(
	// 				'DATA' => $html
	// 			);
	// 			echo json_encode($ajax_response_data);
	// 		}
	// 		else{
	// 			$html = 'verified name';
	// 			$ajax_response_data = array(
	// 				'DATA' => $html
	// 			);
	// 			echo json_encode($ajax_response_data);
	// 		}
			
	// 	}
	// 	else{
	// 		echo '<script>alert("request failed")</script>';
	// 	}
	// }
}