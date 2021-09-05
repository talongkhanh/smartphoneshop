@extends('layout')
@section('content')
	<?php $shipping = Session::get('shipping');?>
	<section id="form" style="margin: 0 auto"><!--Form đăng kí đăng nhập-->
		<div class="container">
			<div class="row">
				<div id="login">
					<div class="col-sm-12">
						<div class="login-form"><!--Form đăng nhập-->
							<h2>Đăng nhập tài khoản</h2>
							<form action="{{URL::to('/login-customer')}}" method="POST">
								{{csrf_field()}}
								<input type="text" name="email_account" placeholder="Tài khoản" />
								<input type="password" name="password_account" placeholder="Password" />
								<button type="submit" class="btn btn-default">Đăng nhập</button>

							</form>
						</div><!--/Form đăng nhập-->
					</div>
				</div>
				<div id="register" style="display: none">
					<div class="col-sm-12">
						<div class="signup-form"><!--Form đăng kí f-->
							<h2>Đăng ký</h2>
							<form action="{{URL::to('/add-customer')}}" method="POST">
								{{ csrf_field() }}
								<input type="text" name="customer_name" placeholder="Họ và tên"/>
								<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
								<input type="password" name="customer_password" placeholder="Mật khẩu"/>
								<input type="text" name="customer_phone" placeholder="Số điện thoại"/>
								<button type="submit" class="btn btn-default">Đăng ký</button>
							</form>
						</div><!--/Form đăng kí-->
					</div>
				</div>
				<br/>
				<button id="btn1" style="display: none;margin: 16px;width: 116px;" class="btn btn-success">Đăng Nhập</button>
				<button id="btn2" class="btn btn-success" style="margin: 16px;width: 116px;margin-top : 40px">Đăng Ký</button>

				<script language="javascript">

                    document.getElementById("btn1").onclick = function () {
                        document.getElementById("login").style.display = 'block';
                        document.getElementById("register").style.display = 'none';
                        document.getElementById("btn1").style.display = 'none';
                        document.getElementById("btn2").style.display = 'block';
                    };

                    document.getElementById("btn2").onclick = function () {
                        document.getElementById("login").style.display = 'none';
                        document.getElementById("btn2").style.display = 'none';
                        document.getElementById("btn1").style.display = 'block';
                        document.getElementById("register").style.display = 'block';
                    };

				</script>

			</div>
		</div>
	</section><!--/form-->

@endsection