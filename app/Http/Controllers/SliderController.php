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
    // show m??n h??nh th??m slide
    public function add_slider(){
    	return view('admin.slider.add_slider');
    }
        // th??m m???i slide
        public function insert_slider(Request $request){
    	
            $this->AuthLogin();
    
            $data = $request->all();
            Session::put('dataSlide', $data);
            $get_image = request('slider_image');
            $slider = new Slider();
            if(isset($data['slider_name'])) {
                $slider->slider_name = $data['slider_name'];
            } else {
                Session::put('message','T??n slide kh??ng ???????c ????? tr???ng!');
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
                Session::put('message','Th??m slider th??nh c??ng');
                Session::put('dataSlide', null);
                return Redirect::to('manage-slider');
            }else{
                Session::put('message','H??y ch???n h??nh ???nh cho slide!');
                return Redirect::to('add-slider');
            }
               
        }
    // show m??n h??nh chi ti???t slide
    public function detail_slider($slide_id){
        $this->AuthLogin();
        $slide = DB::table('tbl_slider')->where('slider_id',$slide_id)->get();
        return view('admin.slider.detail_slider', ['slides' => $slide]);
    }
    // s???a l???i slide
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
        Session::put('message','S???a slider th??nh c??ng');
        return Redirect::to('manage-slider');
    }
    // ng???ng kichs ho???t slide
    public function unactive_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('message','Kh??ng k??ch ho???t slider th??nh c??ng !');
        return Redirect::to('manage-slider');

    }
    // k??ch ho???t slide
    public function active_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('message','K??ch ho???t slider th??nh c??ng !');
        return Redirect::to('manage-slider');
    }
    // x??a slide
    public function delete_slide($slide_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slide_id)->delete();
        Session::put('message','X??a slide th??nh c??ng');
        return Redirect::to('manage-slider');

    }

}
