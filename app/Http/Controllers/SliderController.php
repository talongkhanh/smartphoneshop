<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
class SliderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(Request $request){
        Session::put('dataSlide', null);
        $search = $request->input('q');
        $page_size = 3;
        $all_sliders = Slider::orderBy('slider_id','DESC')->get();
        $total_record = count($all_sliders);
        $total_page = ceil($total_record / $page_size);
        $page_index = $request->input('page');
        if(!isset($page_index)) {
        $page_index = 1;
        }
        $offset = (($page_index - 1) * $page_size);
        $all_slide = Slider::orderBy('slider_id','DESC')
            ->offset($offset)
            ->limit($page_size)
            ->get();
        if(isset($search)) {
            Session::put('q',$search);
            $all_slide = Slider::query()
            ->where('slider_name', 'LIKE', "%{$search}%")
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
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    // show màn hình thêm slide
    public function add_slider(){
    	return view('admin.slider.add_slider');
    }
        // thêm mới slide
        public function insert_slider(Request $request){
    	
            $this->AuthLogin();
    
            $data = $request->all();
            Session::put('dataSlide', $data);
            $get_image = request('slider_image');
            $slider = new Slider();
            if(isset($data['slider_name'])) {
                $slider->slider_name = $data['slider_name'];
            } else {
                Session::put('message','Tên slide không được để trống!');
                return Redirect::to('add-slider');
            }
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/slider', $new_image);
    
                $slider->slider_image = $new_image;
                $slider->slider_status = $data['slider_status'];
                if(isset($data['slider_desc'])) {
                    $slider->slider_desc = $data['slider_desc'];
                } else {
                    $slider->slider_desc = '';
                }
                $slider->save();
                Session::put('message','Thêm slider thành công');
                Session::put('dataSlide', null);
                return Redirect::to('manage-slider');
            }else{
                Session::put('message','Hãy chọn hình ảnh cho slide!');
                return Redirect::to('add-slider');
            }
               
        }
    // show màn hình chi tiết slide
    public function detail_slider($slide_id){
        $this->AuthLogin();
        $slide = DB::table('tbl_slider')->where('slider_id',$slide_id)->get();
        return view('admin.slider.detail_slider', ['slides' => $slide]);
    }
    // sửa lại slide
    public function update_slider($slide_id,Request $request){
        $this->AuthLogin();

   		$data = $request->all();
       	$get_image = request('slider_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
        }
        $slider = [
            'slider_name' => $data['slider_name'],
            'slider_status' => $data['slider_status'],
        ];
        if(isset($data['slider_desc'])) {
            $slider['slider_desc'] = $data['slider_desc'];
        }
        if(isset($new_image)) {
        $slider['slider_image'] = $new_image;
        }
        DB::table('tbl_slider')
            ->where('slider_id', $slide_id)
            ->update($slider);
        Session::put('message','Sửa slider thành công');
        return Redirect::to('manage-slider');
    }
    // ngừng kichs hoạt slide
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('message','Không kích hoạt slider thành công !');
        return Redirect::to('manage-slider');

    }
    // kích hoạt slide
    public function active_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('message','Kích hoạt slider thành công !');
        return Redirect::to('manage-slider');
    }
    // xóa slide
    public function delete_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->delete();
        Session::put('message','Xóa slide thành công');
        return Redirect::to('manage-slider');

    }

}
