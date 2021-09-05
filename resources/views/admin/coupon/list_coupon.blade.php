@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3 m-r-auto">
        <form class="input-group"action="{{URL::to('/list-coupon')}}" method="get">
          <input value="<?php $q = Session::get('q'); if($q) echo $q?>" name="q" type="text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="ml-2 btn btn-sm btn-success" type="submit">Tìm kiếm!</button>
          </span>
        </form>
      </div>
      <a href="{{URL::to('/insert-coupon')}}" class="btn btn-sm btn-info">Thêm mới</a>
    </div>
    <div class="table-responsive">
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

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
          
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
                Giảm theo %
                <?php
                 }else{
                ?>  
                Giảm theo tiền
                <?php
               }
              ?>
            </span>
          </td>
             <td><span class="text-ellipsis">
              <?php
               if($cou->coupon_condition==1){
                ?>
                Giảm {{$cou->coupon_number}} %
                <?php
                 }else{
                ?>  
                Giảm {{number_format($cou->coupon_number, 0, '', ',')}} đ
                <?php
               }
              ?>
            </span></td>
            <td class="middle-vertical">
              <a href="{{URL::to('/list-coupon/'.$cou->coupon_id)}}" class="active styling-edit btn btn-sm btn-info" ui-toggle-class="">
                Sửa
              </a>
            </td>
            <td>
              <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit btn btn-sm btn-danger" ui-toggle-class="">
                Xóa
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row wrap-navigation">
        <div class="col-sm-5 text-left">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị từ <b><?php echo Session::get('start_page') ?> đến <?php echo Session::get('end_page') ?></b> Trên <b><?php echo Session::get('total_record') ?></b> Mã giảm giá / Mỗi trang <b><?php echo Session::get('page_size') ?></b> bản ghi</small>
        </div>
        <div class="col-sm-7 text-center-xs" style="display: flex; justify-content: flex-end">                
          <ul style="display: flex;" class="pagination pagination-sm m-t-none m-b-none">
            <li><a class="<?php if(Session::get('page_index') == 1) {echo 'disable-btn';} ?>" href="{{URL::to('/list-coupon?page='.Session::get('prev_page'))}}"><i class="fa fa-chevron-left"></i></a></li>
              @for ($i = 1; $i <= Session::get('total_page'); $i++)
                <li><a class="<?php if(Session::get('page_index') == $i) {echo 'active-btn';} ?>" href="{{URL::to('/list-coupon?page='.$i)}}">{{$i}}</a></li>
              @endfor
            <li><a class="<?php if(Session::get('page_index') == Session::get('total_page')) {echo 'disable-btn';} ?>" href="{{URL::to('/list-coupon?page='.Session::get('next_page'))}}"><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection