@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thêm danh mục mới</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2" style="padding-bottom: 20px">
                                        @if ($errors->any())
                                            <div class="alert alert-warning" style="display: block !important;">
                                                @foreach ($errors->all() as $error)
                                                    {{$error}} <br/>
                                                @endforeach
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('admin-category.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mx-auto avt-wrapper ">
                                                        <img id='avt_img'
                                                             {{--                                                             src="https://thaoduoc3mien.com/wp-content/uploads/2017/07/food-2-1.jpg"--}}
                                                             alt="" class="z-depth-1 mb-3 mx-auto"/>
                                                    </div>
                                                    <div>
                                                        <label>Hình ảnh <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">

                                                            <input aria-describedby="basic-addon2" class="form-control"
                                                                   type="text" size="48" name="image"
                                                                   id="image"/>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button"
                                                                        onclick="avatar('image','avt_img')">Chọn ảnh
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mô tả </label>
                                                        <textarea class="form-control" type="text" name="description"
                                                                  value="{{ old('description') }}"
                                                                  rows="4" cols="20" placeholder="Nhập văn bản..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên danh mục <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name"
                                                               value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Tạo danh mục
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function avatar(elementId, ava) {
            CKFinder.popup({
                chooseFiles: true,
                // type: "Avatar",
                width: 800,
                height: 600,
                onInit: function (finder) {
                    finder.on("files:choose", function (evt) {
                        var file = evt.data.files.first();
                        var output = document.getElementById(elementId);
                        var out = document.getElementById(ava);
                        output.value = file.getUrl();
                        out.src = file.getUrl();
                    });

                    finder.on("file:choose:res ", function (
                        evt
                    ) {
                        var output = document.getElementById(elementId);
                        output.value = evt.data.resizedUrl;
                    });
                },
            });
        }

    </script>
    <script src="{{asset('plugin/ckfinder/ckfinder.js')}}"></script>
@endsection
