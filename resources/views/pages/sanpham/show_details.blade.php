@extends('layout')
@section('content')
    <style>

        body {
            display: grid;
            grid-template-rows: 1fr;
            font-family: "Raleway", sans-serif;
        }

        h3 {
            letter-spacing: 1.2px;
            color: #a6a6a6;
        }

        img {
            max-width: 100%;
            filter: drop-shadow(1px 1px 3px #a6a6a6);
        }

        /* ----- Product Section ----- */
        .product {
            display: grid;
            grid-template-columns: 0.9fr 1fr;
            margin: auto;
            padding: 2.5em 62px;
            min-width: 600px;
            background-color: white;
            border-radius: 5px;
        }

        /* ----- Photo Section ----- */
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
            box-shadow: 4px 4px 25px -2px rgba(0, 0, 0, 0.3);
        }

        .photo-main {
            border-radius: 6px 6px 0 0;
            background-color: #ffffff;
            background: radial-gradient(#e5f89e, #96e001);

        .controls {
            display: flex;
            justify-content: space-between;
            padding: 0.8em;
            color: #fff;

        i {
            cursor: pointer;
        }

        }

        img {
            position: absolute;
            left: -3.5em;
            top: 2em;
            max-width: 110%;
            filter: saturate(150%) contrast(120%) hue-rotate(10deg) drop-shadow(1px 20px 10px rgba(0, 0, 0, 0.3));
        }

        .photo-album {
            padding: 0.7em 1em;
            border-radius: 0 0 6px 6px;
            background-color: #fff;

        ul {
            display: flex;
            justify-content: space-around;
        }

        li {
            float: left;
            width: 55px;
            height: 55px;
            padding: 7px;
            border: 1px solid #a6a6a6;
            border-radius: 3px;
        }

        }

        /* ----- Informations Section ----- */
        .product__info {
            padding: 0.8em 0;
        }

        .title {

        h1 {
            margin-bottom: 0.1em;
            color: #4c4c4c;
            font-size: 1.5em;
            font-weight: 900;
        }

        span {
            font-size: 0.7em;
            color: #a6a6a6;
        }

        .price {
            margin: 1.5em 0;
            color: #ff3f40;
            font-size: 1.2em;
        }

        span {
            padding-left: 0.15em;
            font-size: 2.9em;
        }

        }

        .variant {
            overflow: auto;

        h3 {
            margin-bottom: 1.1em;
        }

        li {
            float: left;
            width: 35px;
            height: 35px;
            padding: 3px;
            border: 1px solid transparent;
            border-radius: 3px;
            cursor: pointer;

        :first-child,
        :hover {
            border: 1px solid #a6a6a6;
        }

        li:not(:first-child) {
            margin-left: 0.1em;
        }

        .description {
            clear: left;
            margin: 2em 0;

        h3 {
            margin-bottom: 1em;
        }

        ul {
            font-size: 0.8em;
            list-style: disc;
            margin-left: 1em;
        }

        li {
            text-indent: -0.6em;
            margin-bottom: 0.5em;
        }

        .buy--btn {
            padding: 1.5em 3.1em;
            border: none;
            border-radius: 7px;
            font-size: 0.8em;
            font-weight: 700;
            letter-spacing: 1.3px;
            color: #fff;
            background-color: #ff3f40;
            box-shadow: 2px 2px 25px -7px #4c4c4c;
            cursor: pointer;
        }

        :active {
            transform: scale(0.97);
        }

        /* ----- Footer Section ----- */
        footer {
            padding: 1em;
            text-align: center;
            color: #ffffff;
        }

        a {
            color: #4c4c4c;
        }

        :hover {
            color: #ff3f40;
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
                        <h1>{{$value->product_name}}</h1>
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
                    <div class="variant">
                        <h5>Chọn màu sản phẩm</h5>
                        <ul style="display: flex">
                            <li>
                                <button type="checkbox" style="background: blue; color: blue; padding: 10px"></button>
                            </li>
                            <li style="padding: 0px 10px">
                                <button type="checkbox" style="background: red; color: blue; padding: 10px"></button>
                            </li>
                            <li>
                                <button type="checkbox" style="background: yellow; color: blue; padding: 10px"></button>
                            </li>
                            <li style="padding: 0px 10px">
                                <button type="checkbox" style="background: purple; color: blue; padding: 10px"></button>
                            </li>
                        </ul>
                    </div>
                    <div class="description">
                        <h5>Thông Tin</h5>
                        <ul>
                            <li><b>Tình trạng:</b> Còn hàng</li>
                            <li><b>Điều kiện:</b> Mơi 100%</li>
                            <li><b>Thương hiệu:</b> {{$value->brand_name}}</li>
                            <li><b>Danh mục:</b> {{$value->category_name}}</li>
                        </ul>
                    </div>
                    <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart"
                           data-id_product="{{$value->product_id}}" name="add-to-cart">
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
											<input type="text" placeholder="Tên của bạn"/>
											<input type="email" placeholder="Email của bạn"/>
										</span>
                            <textarea name="" placeholder="Nội dung"></textarea>
                            <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt=""/>
                            <button type="button" class="btn btn-default pull-right">
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
                            <div class="product-image-wrapper">
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
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>

        </div>
    </div><!--/recommended_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$relate->links()!!}
    </ul>

@endsection