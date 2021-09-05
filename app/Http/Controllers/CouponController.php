<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
	
	// xóa mã giảm giá
    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
	// danh sách mã giảm giá
    public function list_coupon(Request $request){
		Session::put('dataCoupon', null);
		$search = $request->input('q');
        $page_size = 6;
        $all_coupons = Coupon::orderBy('coupon_id','DESC')->get();
        $total_record = count($all_coupons);
        $total_page = ceil($total_record / $page_size);
        $page_index = $request->input('page');
        if(!isset($page_index)) {
        	$page_index = 1;
        }
        $offset = (($page_index - 1) * $page_size);
        $coupon = Coupon::orderBy('coupon_id','DESC')
            ->offset($offset)
            ->limit($page_size)
            ->get();
        if(isset($search)) {
            Session::put('q',$search);
            $coupon = Coupon::query()
            ->where('coupon_name', 'LIKE', "%{$search}%")
            ->offset($offset)
            ->limit($page_size)
            ->get();
        }

        $start_page = $offset + 1;
        $end_page = $page_size * $page_index;
        if($end_page > $total_record) {
            $end_page = $total_record;
        }
        
        Session::put('prev_page',$page_index - 1);
        Session::put('next_page',$page_index + 1);
        Session::put('page_index',$page_index);
        Session::put('page_size',$page_size);
        Session::put('end_page',$end_page);
        Session::put('start_page',$start_page);
        Session::put('total_page',$total_page);
        Session::put('total_record',$total_record);

        if(!isset($search)) {
            Session::put('q','');
        }

    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
	// chi tiết mã giảm Giá
	public function detail_coupon($coupon_id){
		$coupon = Coupon::find($coupon_id);
		return view('admin.coupon.detail_coupon')->with(compact('coupon'));
	}
	public function update_coupon($coupon_id, Request $request) {
		$this->AuthLogin();
		$coupon = Coupon::find($coupon_id);

		$data = $request->all();

    	$coupon_update =[
			'coupon_condition' => $data['coupon_condition']
		];

		if(!isset($data['coupon_name'])) {
			Session::put('message','Tên mã giảm giá không dược để trống');
			return view('admin.coupon.detail_coupon')->with(compact('coupon'));
		} else {
			$coupon_update['coupon_name'] = $data['coupon_name'];
		}
		if(!isset($data['coupon_time'])) {
			Session::put('message','Số lượng giảm giá không dược để trống');
			return view('admin.coupon.detail_coupon')->with(compact('coupon'));
		} else {
			$coupon_update['coupon_time'] = $data['coupon_time'];
		}

		if(!isset($data['coupon_code'])) {
			Session::put('message','Mã giảm giá không dược để trống');
			return view('admin.coupon.detail_coupon')->with(compact('coupon'));
		} else {
			$coupon_update['coupon_code'] = $data['coupon_code'];
		}

		if(!isset($data['coupon_number'])) {
			Session::put('message','Số tiền giảm giá không dược để trống');
			return view('admin.coupon.detail_coupon')->with(compact('coupon'));
		} else {
			$coupon_update['coupon_number'] = $data['coupon_number'];
		}

		DB::table('tbl_coupon')
            ->where('coupon_id', $coupon_id)
            ->update($coupon_update);

    	Session::put('message','Cập nhật mã giảm giá thành công');
        return Redirect::to('list-coupon');
	}
	// mở form thêm mới
    public function insert_coupon(){
    	return view('admin.coupon.insert_coupon');
    }
	// thêm mới mã giảm giá
    public function insert_coupon_code(Request $request){
    	$data = $request->all();
		Session::put('dataCoupon', $data);
    	$coupon = new Coupon;

    	if(!isset($data['coupon_name'])) {
			Session::put('message','Tên mã giảm giá không dược để trống');
			return view('admin.coupon.insert_coupon')->with(compact('coupon'));
		} else {
			$coupon->coupon_name = $data['coupon_name'];
		}
		
		if(!isset($data['coupon_code'])) {
			Session::put('message','Mã giảm giá không dược để trống');
			return view('admin.coupon.insert_coupon')->with(compact('coupon'));
		} else {
			$coupon->coupon_code = $data['coupon_code'];
		}
		if(!isset($data['coupon_time'])) {
			Session::put('message','Số lượng giảm giá không dược để trống');
			return view('admin.coupon.insert_coupon')->with(compact('coupon'));
		} else {
			$coupon->coupon_time = $data['coupon_time'];
		}


		if(!isset($data['coupon_number'])) {
			Session::put('message','Số tiền giảm giá không dược để trống');
			return view('admin.coupon.insert_coupon')->with(compact('coupon'));
		} else {
			$coupon->coupon_number = $data['coupon_number'];
		}
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();
		Session::put('dataCoupon', null);
    	Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('list-coupon');


    }
}
