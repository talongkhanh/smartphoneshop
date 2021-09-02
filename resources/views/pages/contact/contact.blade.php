@extends('layout')
@section('content')
    <style>
h3{
    text-align: center;
    padding-bottom: 20px;
    margin-top: 50px;
}
.form {
   text-align: center;
}
#form1 {
   width: 600px;
   background: #fff;
   margin: 0 auto;
}
#form1 input[type=text] {
   width: 100%;
   box-sizing: border-box;
   font-size: 18px;
   color: #555;
   display: block;
   line-height: 1.2;
   background-color: #fff;
   border-radius: 20px;
   margin-bottom: 10px;
   height: 50px;
   padding: 0 20px 0 23px;
   border:1px solid #CC6666;
   box-shadow: 0 5px 20px 0 rgb(0 0 0 / 5%);
   -moz-box-shadow: 0 5px 20px 0 rgba(0,0,0,.05);
   -webkit-box-shadow: 0 5px 20px 0 rgb(0 0 0 / 5%);
   -o-box-shadow: 0 5px 20px 0 rgba(0,0,0,.05);
   -ms-box-shadow: 0 5px 20px 0 rgba(0,0,0,.05);
}
#form1 input[type=text]:focus{
    border: 0;
    outline: none;
    box-shadow: 0 5px 20px 0 rgb(250 66 81 / 10%);
    -moz-box-shadow: 0 5px 20px 0 rgba(250,66,81,.1);
    -webkit-box-shadow: 0 5px 20px 0 rgb(250 66 81 / 10%);
    -o-box-shadow: 0 5px 20px 0 rgba(250,66,81,.1);
    -ms-box-shadow: 0 5px 20px 0 rgba(250,66,81,.1);
}
#form1 #fcontent {
    outline: none;
    min-height: 150px;
}
#form1 input[type=submit] {
    background-color: #CD1818;
    height: 42px;
    padding: 5px 20px;
    border-radius: 21px;
    font-size: 14px;
    color: #fff;
    border: 0;
    box-shadow: 0 10px 30px 0 rgb(189 89 212 / 50%);
    -moz-box-shadow: 0 10px 30px 0 rgba(189,89,212,.5);
    -webkit-box-shadow: 0 10px 30px 0 rgb(189 89 212 / 50%);
    -o-box-shadow: 0 10px 30px 0 rgba(189,89,212,.5);
    -ms-box-shadow: 0 10px 30px 0 rgba(189,89,212,.5);
    margin-bottom: 100px;
}
#form1 input[type="submit"]:hover {
    background:#000000;
}
h5{
 padding:5px 130px;
 font-size: 19px;
 font-weight: 900;
}
h6
{
 padding:5px 130px;
 font-size: 19px;
 font-weight: 400;
}
    </style>
    <section id="form" style="margin: 0 auto"><!--form-->
<h3>LIÊN HỆ VỚI CHÚNG TÔI</h3>
<h5>S-Phone</h5>
<h6>Chuyên cung cấp những loại điện thoại tốt nhất hiện nay</h6>
<h5>Địa chỉ : 295 Minh Khai, Bắc Từ Liêm, Hà Nội</h5>
<h5>Hotline: 0981 110 557</h5>
<h5>Mail : nhom18mnm@company.com</h5>
    <h3>HOẶC GỬI MAIL</h3>
<form action="" id="form1">
<input type="text" id="fname" name="fname" placeholder="Họ tên"><br>
<input type="text" id="femail" name="femail" placeholder="Địa chỉ Email"><br>
<input type="text" id="fcontent" name="fcontent" placeholder="Nội dung yêu cầu"><br>
<input type="submit" value="Gửi mail">
</form>
    </section><!--/form-->

@endsection