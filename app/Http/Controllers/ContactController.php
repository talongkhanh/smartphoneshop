<?php
/**
 * Created by PhpStorm.
 * User: PHAN CHINH
 * Date: 01/09/2021
 * Time: 15:03
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Mail;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo
        $meta_desc = "Liên hệ";
        $meta_keywords = "Liên hệ";
        $meta_title = "Liên hệ";
        $url_canonical = $request->url();
        //--seo

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6);

        return view('pages.contact.contact')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider); //1
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }

}