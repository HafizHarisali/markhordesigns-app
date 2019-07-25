<?php
namespace App\Http\Controllers\Admin\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;

class PortfolioController extends Controller{

	//Manage portfolio
	public function index(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Get all data
			$query = DB::table('mk_portfolio')
						->select('mk_portfolio.*','mk_portfolio_categories.name as category_name')
						->leftjoin('mk_portfolio_categories','mk_portfolio_categories.id','=','mk_portfolio.portfolio_category_id')
						->orderby('id','desc');
			$result['query'] = $query->paginate(15);
			$result['total_records'] = $query->count();
			$data = array(
					'title' => 'Portfolio | Markhor Designs',
					'meta_keywords' => 'All Portfolio Items',
					'meta_description' => 'All Portfolio Items'
				);
			//return view
			return view('admin.portfolio.portfolios.manage',$result)->with($data);
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	//Add portfolio
	public function add(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role') == 0)){
			//Get Categories
			$query = DB::table('mk_portfolio_categories')
						->select('*');
			$result['query'] = $query->get();
			$result['total_categories'] = $query->count();
			$data = array(
					'title' => 'Add Portfolio Item | Markhor Designs',
					'meta_keywords' => 'Add Portfolio Item',
					'meta_description' => 'Add Portfolio Item'
				);
			//return view
			return view('admin.portfolio.portfolios.add',$result)->with($data);
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function insert(Request $request){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
	        //Check if image is available
	        if(!empty($request->file('item_image') || $request->file('item_images'))){
	        	//Upload Image
	        	$image = rand().'.'.$request->file('item_image')->guessExtension();
		        $image_path = $request->file('item_image')->move(public_path().'/assets/admin/images/portfolio/portfolios/', $image);
		        //Check if name is duplicate
		        $query = DB::table('mk_portfolio')
		        			->select('name')
		        			->get();
		        if(!empty($query->count()) > 0){
			        foreach ($query as $row) {
			        	if(!empty($request->input('title') == $row->name)){
			        		$name = $request->input('title').' '.'Copy';
			        	}
			        	else{
			        		$name = $request->input('title');
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
		        	'item_description' => $request->input('item_description'),
		        	'web_url' => $request->input('web_url'),
		        	'portfolio_category_id' => $request->input('portfolio_category_id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_description'),
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        else{
	        	//Set Data For Insert
		        $data = array(
		        	'name' => $name,
		        	'slug' => strtolower(str_replace(' ', '-', $name)),
		        	'item_description' => $request->input('item_description'),
		        	'web_url' => $request->input('web_url'),
		        	'portfolio_category_id' => $request->input('portfolio_category_id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_description'),
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for insert data
		        $insert_data = DB::table('mk_portfolio')
		        				->insertGetId($data);
		        
		        //Gallery Images data
	        foreach($request->file('item_images') as $img){
	        	//Upload Gallery Images
		        $images = uniqid().'.'.$img->guessExtension();
		        $image_path = $img->move(public_path().'/assets/admin/images/portfolio/portfolios/', $images);
        		//Set Data for insert
		        $data = array(
		        	'image' => $images,
		        	'portfolio_id' => $insert_data,
		        	'created_date_time' => date('Y-m-d H:i:s')
		        );
		        
		        //Query For Inserting Data
		    	$query = DB::table('mk_portfolio_images')
		    	             ->insertGetId($data);	 
	        }       
		        
		        if(!empty($insert_data) || $insert_images_data){
		        $notifications = array(
		        	'message' => 'Item Added Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('portfolio_add')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('portfolio_add')->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function edit(Request $request,$id){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			//Get item data
			$query = DB::table('mk_portfolio_categories')
						->select('*');
			$data = DB::table('mk_portfolio')
						->select()
						->where('id',$id);
			$images = DB::table('mk_portfolio_images')
						->select('*')
						->where('portfolio_id',$id);
			//Getting all data
			$result['query'] = $query->get();
			$result['data'] = $data->first();
			$result['images'] = $images->get();
			$result['total_images'] = $images->count();			
			$result['total_categories'] = $query->count();
			$data = array(
					'title' => 'Edit Portfolio Item | Markhor Designs',
					'meta_keywords' => 'Edit Portfolio item',
					'meta_description' => 'Edit Portfolio Item'
				);
			//return view
			return view('admin.portfolio.portfolios.edit',$result)->with($data);
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function update(Request $request,$id){
		//Check User Session
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
	        //Check if image is available
	        if(!empty($request->file('item_image') || $request->file('item_images'))){
	        	//Upload Image
	        	$image = rand().'.'.$request->file('item_image')->guessExtension();
		        $image_path = $request->file('item_image')->move(public_path().'/assets/admin/images/portfolio/portfolios/', $image);
		        
		        //Set Data For Insert
		        $data = array(
		        	'name' => $request->input('title'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('title'))),
		        	'featured_image' => $image,
		        	'item_description' => $request->input('item_description'),
		        	'web_url' => $request->input('web_url'),
		        	'portfolio_category_id' => $request->input('portfolio_category_id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_description'),
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        else{
	        	//Set Data For Insert
		        $data = array(
		        	'name' => $request->input('title'),
		        	'slug' => strtolower(str_replace(' ', '-', $request->input('title'))),
		        	'item_description' => $request->input('item_description'),
		        	'web_url' => $request->input('web_url'),
		        	'portfolio_category_id' => $request->input('portfolio_category_id'),
		        	'meta_keywords' => $request->input('meta_keywords'),
		        	'meta_decription' => $request->input('meta_description'),
		        	'status' => 0,
		        	'added_by' =>$request->session()->has('id'),
		        	'created_date_time' => date('Y-m-d H:i:s'),
		        	'updated_date_time' => date('Y-m-d H:i:s')
		        );
	        }
	        	//Query for insert data
		        $insert_data = DB::table('mk_portfolio')
		        				->where('id',$id)
		        				->update($data);
			    if(!empty($request->file('item_images'))){
			      	//Delete old images from directory
			      	$check_images = DB::table('mk_portfolio_images')
		        					->select('image')
		        					->where('portfolio_id',$id)
		        					->get();
		        	if(!empty($check_images->count()) > 0){
			        	foreach ($check_images as $row_images){
				        	$image_path = public_path().'/assets/admin/images/portfolio/portfolios/'.$row_images->image;
				        	unlink($image_path);
			        }
		        }
	        	//Delete old images from db
		      	$delete_images_query = DB::table('mk_portfolio_images')
	        							->where('portfolio_id',$id)
	        							->delete(); 
	        	// print_r($image_path);die;
	        	    //Gallery Images data
		        foreach($request->file('item_images') as $img){
		        	//Upload Gallery Images
			        $images = uniqid().'.'.$img->guessExtension();
			        $image_path = $img->move(public_path().'/assets/admin/images/portfolio/portfolios/', $images);
	        		//Set Data for insert
			        $data = array(
			        	'image' => $images,
			        	'portfolio_id' => $id,
			        	'created_date_time' => date('Y-m-d H:i:s')
			        );
			        
			        //Query For Inserting Data
			    	$query = DB::table('mk_portfolio_images')
			    	             ->insertGetId($data);	 
	        	} 
	        }
		        
		        if(!empty($insert_data) || $query){
		        $notifications = array(
		        	'message' => 'Item Updated Successfully',
		        	'alert-type' => 'success'
		        	);
		        	return redirect()->route('portfolio')->with($notifications);
		   		 }
		   		else{
		   			$notifications = array(
		        	'message' => 'Something Went Wrong',
		        	'alert-type' => 'danger'
		        	);
		        	return redirect()->route('portfolio')->with($notifications);
		   		 }

		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function delete(Request $request,$id){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0 && $id)){
			//Query for deleting Data
			$query = DB::table('mk_portfolio')
						->where('id',$id)
						->delete();
			//Checking if query is correct
			if(!empty($query)){
				$notifications = array(
					'message' => 'Portfolio Item Deleted Successfully',
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

	//Filter for portfolio
	public function filter_portfolio(Request $request){
		if(!empty($request->session()->has('id') && $request->session()->get('role')==0)){
			$query = DB::table('mk_portfolio')
						->select('mk_portfolio.*','mk_portfolio_categories.id as category_id',
						'mk_portfolio_categories.name as category_name')
						->leftjoin('mk_portfolio_categories','portfolio_category_id','=','mk_portfolio_categories.id')
						->orderby('id','desc');
						if(!empty($request->input('name'))){
						$query->where('mk_portfolio.name','Like','%'.$request->input('name').'%');
						}
						if(!empty($request->input('category'))){
						$query->where('mk_portfolio_categories.name','Like','%'.$request->input('category').'%');
						}
						if(!empty($request->input('status'))){
						$query->where('mk_portfolio.status',$request->input('status'));
						}
                     	$query->orderBy('mk_portfolio.id', 'DESC');
			$result['query'] = $query->paginate(12);
			$result['total_records'] = $result['query']->count();
			return view('admin.portfolio.portfolios.manage',$result);
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

	public function update_portfolio_status(Request $request,$id){
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
			$query = DB::table('mk_portfolio')
						->where('id',$id)
						->update($data);
			if(!empty($query)){
			$notifications=array(
				'message' => 'Status Updated Successfully',
				'alert-type' => 'success'
			);
			return redirect()->route('portfolio')->with($notifications);
			}
			else{
				$notifications=array(
				'message' => 'Something went wrong',
				'alert-type' => 'error'
			);
			return redirect()->route('portfolio')->with($notifications);
			}
		}
		else{
			return redirect()->route('admin_signin');
		}
	}

}