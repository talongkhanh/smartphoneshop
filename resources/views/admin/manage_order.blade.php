@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách đơn hàng
    </div>
    <div class="row w3-res-tb">
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
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
            @php 
            $i++;
            @endphp
          <tr>
            <td class="middle-vertical"><i>{{$i}}</i></label></td>
            <td class="middle-vertical">{{ $ord->order_code }}</td>
            <td class="middle-vertical">{{ $ord->created_at }}</td>
            <td class="middle-vertical">@if($ord->order_status==1)
                    Đơn hàng mới
                @else 
                    Đã xử lý
                @endif
            </td>
            <td class="d-flex">
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active p-r-3 styling-edit btn btn-sm btn-info" ui-toggle-class="">
                Xem
              </a>
            </td>
            <td class="middle-vertical">
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active btn-sm styling-edit btn btn-danger" ui-toggle-class="">
                Xóa
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>
{{-- phân trang --}}
<footer class="panel-footer">
      <div class="row wrap-navigation">
        <div class="col-sm-5 text-left">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị từ <b><?php echo Session::get('start_page') ?> đến <?php echo Session::get('end_page') ?></b> Trên <b><?php echo Session::get('total_record') ?></b> Đơn hàng / Mỗi trang <b><?php echo Session::get('page_size') ?></b> bản ghi</small>
        </div>
        <div class="col-sm-7" style="display: flex; justify-content: flex-end">                
          <ul style="display: flex;" class="pagination pagination-sm m-t-none m-b-none">
            <li><a class="<?php if(Session::get('page_index') == 1) {echo 'disable-btn';} ?>" href="{{URL::to('/manage-order?page='.Session::get('prev_page'))}}"><i class="fa fa-chevron-left"></i></a></li>
              @for ($i = 1; $i <= Session::get('total_page'); $i++)
                <li><a class="<?php if(Session::get('page_index') == $i) {echo 'active-btn';} ?>" href="{{URL::to('/manage-order?page='.$i)}}">{{$i}}</a></li>
              @endfor
            <li><a class="<?php if(Session::get('page_index') == Session::get('total_page')) {echo 'disable-btn';} ?>" href="{{URL::to('/manage-order?page='.Session::get('next_page'))}}"><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>

@endsection