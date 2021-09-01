@extends('layout')
@section('content')

	<section id="form" style="margin: 0 auto"><!--form-->
		<div class="container">
			<div class="row">
				<div id="login">
					<div class="col-sm-12">
						<div class="login-form"><!--login form-->
							<h2>Đăng nhập tài khoản</h2>
							<form action="{{URL::to('/login-customer')}}" method="POST">
								{{csrf_field()}}
								<input type="text" name="email_account" placeholder="Tài khoản" />
								<input type="password" name="password_account" placeholder="Password" />
								<span>
								<input type="checkbox" class="checkbox">
								Ghi nhớ đăng nhập
							</span>
								<button type="submit" class="btn btn-default">Đăng nhập</button>

							</form>
						</div><!--/login form-->
					</div>
				</div>
				<div id="register" style="display: none">
					<div class="col-sm-12">
						<div class="signup-form"><!--sign up form-->
							<h2>Đăng ký</h2>
							<form action="{{URL::to('/add-customer')}}" method="POST">
								{{ csrf_field() }}
								<input type="text" name="customer_name" placeholder="Họ và tên"/>
								<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
								<input type="password" name="customer_password" placeholder="Mật khẩu"/>
								<input type="text" name="customer_phone" placeholder="Phone"/>
								<button type="submit" class="btn btn-default">Đăng ký</button>
							</form>
						</div><!--/sign up form-->
					</div>
				</div>
				<br/>
				<button id="btn1" style="display: none;margin: 16px;width: 116px;" class="btn btn-success">Đăng Nhập</button>
				<button id="btn2" class="btn btn-success" style="margin: 16px;width: 116px;">Đăng Ký</button>

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