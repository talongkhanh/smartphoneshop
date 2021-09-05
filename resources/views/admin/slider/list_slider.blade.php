@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách slider trang web
    </div>
    <div class="row w3-res-tb">
      {{-- <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div> --}}
      <div class="col-sm-3 m-r-auto">
        <form class="input-group" action="{{URL::to('/manage-slider')}}" method="get">
          <input value="<?php $q = Session::get('q'); if($q) echo $q?>" name="q" type="text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="ml-2 btn btn-sm btn-success" type="submit">Tìm kiếm!</button>
          </span>
        </form>
      </div>
      <a href="{{URL::to('/add-slider')}}" class="btn btn-sm btn-info">Thêm mới</a>
    </div>
    @if(count($all_slide) <= 0) 
      <div class="empty-state">
        <h2>Không có slider nào!</h2>
      </div>
    @else 
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên slide</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slide as $key => $slide)
          <tr>
            <td class="middle-vertical"><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td class="middle-vertical">{{ $slide->slider_name }}</td>
            <td class="middle-vertical"><a href="{{URL::to('/manage-slider/'.$slide->slider_id)}}"><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"></a></td>
            <td class="middle-vertical">{{ $slide->slider_desc }}</td>
            <td class="middle-vertical"><span class="text-ellipsis">
              <?php
               if($slide->slider_status==1){
                ?>
                <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td class="middle-vertical">
              <a href="{{URL::to('/manage-slider/'.$slide->slider_id)}}" class="active styling-edit btn btn-sm btn-info" ui-toggle-class="">
                Sửa
              </a>
            </td>
            <td class="middle-vertical">
              <a onclick="return confirm('Bạn có chắc là muốn xóa slide này ko?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit btn btn-sm btn-danger" ui-toggle-class="">
                Xóa
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    @endif
    
    <footer class="panel-footer">
      <div class="row wrap-navigation">
        <div class="col-sm-5 text-left">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị từ <b><?php echo Session::get('start_page') ?> đến <?php echo Session::get('end_page') ?></b> Trên <b><?php echo Session::get('total_record') ?></b> Slider / Mỗi trang <b><?php echo Session::get('page_size') ?></b> bản ghi</small>
        </div>
        <div class="col-sm-7 text-center-xs" style="display: flex; justify-content: flex-end">                
          <ul style="display: flex;" class="pagination pagination-sm m-t-none m-b-none">
            <li><a class="<?php if(Session::get('page_index') == 1) {echo 'disable-btn';} ?>" href="{{URL::to('/manage-slider?page='.Session::get('prev_page'))}}"><i class="fa fa-chevron-left"></i></a></li>
              @for ($i = 1; $i <= Session::get('total_page'); $i++)
                <li><a class="<?php if(Session::get('page_index') == $i) {echo 'active-btn';} ?>" href="{{URL::to('/manage-slider?page='.$i)}}">{{$i}}</a></li>
              @endfor
            <li><a class="<?php if(Session::get('page_index') == Session::get('total_page')) {echo 'disable-btn';} ?>" href="{{URL::to('/manage-slider?page='.Session::get('next_page'))}}"><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection