@extends('layout')
@section('content')
    <style>

        /* ----- Sản phẩm ----- */
        .product {
            display: grid;
            grid-template-columns: 0.9fr 1fr;
            margin: auto;
            padding: 2.5em 62px;
            min-width: 600px;
            background-color: white;
            border-radius: 5px;
        }
         h3
         {
             font-size: 28px;
         }
        /* ----- Ảnh ----- */
        .product__photo {
            position: relative;
        }

        .photo-container {
            position: absolute;
            left: -2.5em;
            display: grid;
            grid-template-rows: 1fr;
            width: 100%;
            height: 100%;
            border-radius: 6px;
            box-shadow: 4px 4px 25px -2px rgba(0, 0, 0, 0.2);
        }

        .photo-main {
            height: 500px;
            width: 350px;
        }
        .photo-main img  {
            height: 500px;
            width: 350px;
            padding-bottom: 180px;
            padding-left: 0px;
            padding-top: 50px;
        }
        .controls {
            display: flex;
            justify-content: space-between;
            padding: 0.8em;
            color: #fff;
        }
        .photo-album {
            padding: 0.7em 1em;
            border-radius: 0 0 6px 6px;
            background-color: #fff;
        }

        /* ----- Thông tin sản phẩm ----- */
        .product__info {
            padding-left: 2em;
        }

        .price {
            margin: 0.8em 0;
            color: #ff3f40;
            font-size: 1.2em;
            font-size: 30px;
            font-weight: 900;
        }
        label{
            font-size: 18px;
        }
        .variant {
            overflow: auto;
        }


        .description {
            clear: left;
            margin: 0.2em 0 0.6em;
            font-size: 20px;
        }
        .description h5{
            font-size: 20px;
        }
        
    </style>
    @foreach($product_details as $key => $value)
        <section class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <div class="controls">
                        </div>
                        <img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}"
                             alt="">
                    </div>
                </div>
            </div>
            <form action="{{URL::to('/save-cart')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$value->product_id}}"
                       class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}"
                       class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_image}}"
                       class="cart_product_image_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}"
                       class="cart_product_price_{{$value->product_id}}">
                <div class="product__info">
                    <div class="title">
                        <h3>{{$value->product_name}}</h3>
                        <span>Mã ID: {{$value->product_id}}</span>
                    </div>
                    <div class="price">
                        Giá: <span>{{number_format($value->product_price,0,',','.').'đ'}}</span>
                    </div>
                    <div>
                        <label>Số lượng:</label>
                        <input name="qty" type="number" min="1"
                               class="cart_product_qty_{{$value->product_id}}" value="1"/>
                        <input name="productid_hidden" type="hidden" value="{{$value->product_id}}"/>
                    </div>
                    <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart"
                           data-id_product="{{$value->product_id}}" name="add-to-cart">
                    <div class="description">
                        <h5>Thông Tin</h5>
                        <ul>
                            <li><b>Tình trạng:</b> Còn hàng</li>
                            <li><b>Điều kiện:</b> Mơi 100%</li>
                            <li><b>Thương hiệu:</b> {{$value->brand_name}}</li>
                            <li><b>Danh mục:</b> {{$value->category_name}}</li>
                        </ul>
                    </div>
                    
                </div>
            </form>
        </section>

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>

                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <p>{!!$value->product_desc!!}</p>

                </div>

                <div class="tab-pane fade" id="companyprofile">
                    <p>{!!$value->product_content!!}</p>


                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><i class="fa fa-user"></i> KhachHang</li>
                            <li><i class="fa fa-clock-o"></i> 8:41 AM</a></li>
                            <li><i class="fa fa-calendar-o"></i> 31 tháng 8 năm 2021</li>
                        </ul>
                        <p>Bạn cảm thấy dịch vụ và chất lượng sản phẩm bên mình như nào ?</p>
                        <p><b>Đánh giá của bạn</b></p>

                        <form action="#">
										<span>
											<input id="a1" type="text" placeholder="Tên của bạn"/>
											<input id="a2" type="email" placeholder="Email của bạn"/>
										</span>
                            <textarea name="" id="a3" placeholder="Nội dung"></textarea>
                            <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt=""/>
                            <button type="button" class="btn btn-default pull-right" id="btn_danhgia">
                                Gửi đánh giá
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    @endforeach
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($relate as $key => $lienquan)
                        <div class="col-sm-4">
                            <a class="product-image-wrapper" href="{{URL::to("/chi-tiet/".$lienquan->product_slug)}}">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}"
                                             alt=""/>
                                        <h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
                                        <p>{{$lienquan->product_name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                    </div>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div><!--/recommended_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$relate->links()!!}
    </ul>

    <script>

        document.getElementById("btn_danhgia").addEventListener("click", function(){
            document.getElementById("a1").value = "";
            document.getElementById("a2").value = "";
            document.getElementById("a3").value = "";
                swal("Thành công", "Gửi đánh giá thành công. Xin cảm ơn !", "success");
        });
    </script>
@endsection
