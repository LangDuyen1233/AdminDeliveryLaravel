@extends('layouts.master')
@section('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <style>
        .dropdown {
            margin-top: -15px;
        }

        .bootstrap-select .dropdown-toggle:focus, .bootstrap-select > select.mobile-device:focus  .dropdown-toggle {
            outline: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thêm món ăn mới</h6>
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
                                        <form method="post" action="{{route('admin-food.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên món ăn <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name"
                                                               value="{{ old('name') }}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Size </label>
                                                        <input class="form-control" type="text" name="size"
                                                               value="{{ old('size') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Giá <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="number" step="10.000"
                                                                   min="0" name="price" value="{{ old('price') }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">VND</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Khối lượng</label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="number" name="weight"
                                                                   value="{{ old('weight') }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Thành phần<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="ingredients"
                                                               value="{{ old('ingredients') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ghi chú</label>
                                                        <input class="form-control" type="text" name="note"
                                                               value="{{ old('note') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Danh mục<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="category_id">
                                                            <option>
                                                                Chọn danh mục
                                                            </option>
                                                            @foreach($category as $c)
                                                                <option
                                                                    {{old('category_id')=="1"? 'selected':''}} value="{{$c->id}}">
                                                                    {{$c->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Quán ăn<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="restaurant_id">
                                                            <option>
                                                                Chọn quán ăn
                                                            </option>
                                                            @foreach($restaurant as $r)
                                                                <option
                                                                    {{old('category_id')=="1"? 'selected':''}} value="{{$r->id}}">
                                                                    {{$r->name}}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mx-auto avt-wrapper ">
                                                        <img id='avt_img' name="image" style="width:70px"
                                                             {{--                                                             src="https://thaoduoc3mien.com/wp-content/uploads/2017/07/food-2-1.jpg"--}}
                                                             alt="Thêm hình ảnh" class=" z-depth-1 mb-3 mx-auto"/>
                                                    </div>
                                                    <div>
                                                        <label>Hình ảnh <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">

                                                            <input aria-describedby="basic-addon2" class="form-control"
                                                                   type="text" size="48" name="image"
                                                                   id="image"/>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button"
                                                                        onclick="avatar('image','avt_img')"> Select file
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Topping</label>
                                                        <select class="selectpicker w-100"
                                                            tabindex="-1" aria-hidden="true" name="topping_id[]"
                                                            multiple="multiple" title="Chọn topping">
                                                            @foreach($topping as $t)
                                                                <option
                                                                    {{old('topping_id')=="1"? 'selected':''}} value="{{$t->id}}">
                                                                    {{$t->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Tạo món ăn
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endsection
