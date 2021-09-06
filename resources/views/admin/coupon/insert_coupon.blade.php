@extends('admin_layout')
@section('admin_content')
<?php $dataCoupon = Session::get('dataCoupon');?>
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm mã giảm giá
                    </header>
                    <?php
                        $message = Session::get('message');
                        if($message){
                        ?>
                        <div id="snackbar"><?php echo $message; ?></div>
                        <script>
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                        </script>
                        <?php
                            Session::put('message',null);
                        }
                    ?>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input value="<?php if($dataCoupon != null && $dataCoupon['coupon_name'] ) {echo $dataCoupon['coupon_name'];} ?>" type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input value="<?php if($dataCoupon != null && $dataCoupon['coupon_code'] ) {echo $dataCoupon['coupon_code'];} ?>" type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng mã</label>
                                    <input value="<?php if($dataCoupon != null && $dataCoupon['coupon_time'] ) {echo $dataCoupon['coupon_time'];} ?>" type="number" name="coupon_time" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại mã giảm giá</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        @if($dataCoupon != null && (int)$dataCoupon['coupon_condition'] == 2)
                                        <option value="2">Giảm theo tiền</option>
                                        <option value="1">Giảm theo phần trăm</option>
                                        @else
                                        <option value="1">Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo tiền</option>
                                        @endif
                                        
                                </select>
                            </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                <input nput value="<?php if($dataCoupon != null && $dataCoupon['coupon_number'] ) {echo $dataCoupon['coupon_number'];} ?>" type="number" name="coupon_number" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                            <a href="{{URL::to('/list-coupon')}}" class="btn btn-primary">Danh sách mã giảm giá</a>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
@endsection