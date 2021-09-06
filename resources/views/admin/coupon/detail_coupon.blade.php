@extends('admin_layout')
@section('admin_content')
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
                            <form role="form" action="{{URL::to('/list-coupon/'.$coupon->coupon_id)}}" method="post">
                                @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input value="{{$coupon->coupon_name}}" type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã giảm giá</label>
                                <input value="{{$coupon->coupon_code}}" type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Số lượng mã</label>
                                <input value="{{$coupon->coupon_time}}" type="text" name="coupon_time" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại mã giảm giá</label>
                                <select value="{{$coupon->coupon_condition}}" name="coupon_condition" class="form-control input-sm m-bot15">
                                    @if ($coupon->coupon_condition == 1)
                                    <option selected="selected" value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                    @else
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option selected="selected" value="2">Giảm theo tiền</option>
                                    @endif
                                    
                                </select>
                            </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                <input value="{{$coupon->coupon_number}}" type="number" name="coupon_number" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Cập nhật</button>
                            <a href="{{URL::to('/list-coupon')}}" class="btn btn-primary">Danh sách mã giảm giá</a>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
@endsection