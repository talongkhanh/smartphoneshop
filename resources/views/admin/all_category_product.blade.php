@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:5%" class="text-center">STT
            </th>
            <th style="width: 40%" class="text-left">Tên danh mục</th>
            <th style="width: 20%" >Slug</th>
            <th style="width: 15%" class="text-center">Hiển thị</th>

            <th style="width: 15%" class="text-center">Hành động</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_category_product as $key => $cate_pro)
          <tr>
            <td class="text-center">{{ $loop->index }}</td>
            <td>{{ $cate_pro->category_name }}</td>
            <td>{{ $cate_pro->slug_category_product }}</td>
            <td style="width: 15%" class="text-center"><span class="text-ellipsis">
              <?php
               if($cate_pro->category_status==0){
                ?>
                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}" style="color: red;">False</a>
                <?php
                 }else{
                ?>
                 <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}">True</a>
                <?php
               }
              ?>
            </span></td>

            <td style="width: 15%" class="text-center">
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit m-r-5" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="" style="margin-left: 20px">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{ $all_category_product->links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
