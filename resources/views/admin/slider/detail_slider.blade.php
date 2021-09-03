@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                @foreach ($slides as $slide)
                <section class="panel">
                    <header class="panel-heading">
                       Sửa Slider 
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
                            <form role="form" action="{{URL::to('/manage-slider/'.$slide->slider_id)}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên slide</label>
                                <input type="text" name="slider_name" class="form-control" value="{{$slide->slider_name}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh cũ</label>
                                <br/>
                                <img src="{{URL::to('/public/uploads/slider/'.$slide->slider_image) }}" height="120" width="500">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn hình ảnh mới</label>
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Slide">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả slider</label>
                                <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$slide->slider_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                  <select name="slider_status" class="form-control input-sm m-bot15" value="{{$slide->slider_status}}">
                                    @if($slide->slider_status == 0)
                                    <option selected="selected>" value="0">Ẩn slider</option>
                                    <option value="1">Hiển thị slider</option>
                                    @else
                                    <option value="0">Ẩn slider</option>
                                    <option selected="selected>" value="1">Hiển thị slider</option>
                                    @endif
                                        
                                </select>
                            </div>
                           
                            <button type="submit" name="add_slider" class="btn btn-info">Cập nhật</button>
                            <a href="{{URL::to('/manage-slider')}}" class="btn btn-primary">Danh sách slider</a>
                            </form>
                        </div>

                    </div>
                </section>
                @endforeach
            </div>
@endsection