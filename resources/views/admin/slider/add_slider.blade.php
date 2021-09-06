@extends('admin_layout')
@section('admin_content')
<?php $dataSlide = Session::get('dataSlide'); ?>
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm Slider
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
                                <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slide</label>
                                    <input value="<?php if($dataSlide != null && $dataSlide['slider_name'] != null ) {echo $dataSlide['slider_name'];} ?>" type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên slide">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả"><?php if($dataSlide != null && $dataSlide['slider_desc'] != null ) {echo $dataSlide['slider_desc'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    
                                      <select name="slider_status" class="form-control input-sm m-bot15">
                                        @if($dataSlide != null && $dataSlide['slider_status'] != null &&  (int)$dataSlide['slider_status'] == 1)
                                        <option value="1">Hiển thị slider</option>
                                        <option value="0">Ẩn slider</option>
                                        @else
                                        <option value="0">Ẩn slider</option>
                                        <option value="1">Hiển thị slider</option>
                                        @endif
                                            
                                            
                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                                <a href="{{URL::to('/manage-slider')}}" class="btn btn-primary">Danh sách slider</a>
                                </form>
                            </div>

                        </div>
                    </section>
            </div>
@endsection