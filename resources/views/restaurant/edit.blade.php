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
    {{--    {{ $arr = $restaurant->category}}--}}
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Sửa thông tin quán ăn</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        @if ($errors->any())
                                            <div class="alert alert-warning" style="display: block !important;">
                                                @foreach ($errors->all() as $error)
                                                    {{$error}} <br/>
                                                @endforeach
                                            </div>
                                        @endif
                                        <form method="post"
                                              action="{{route('admin-restaurant.update',$restaurant->id)}}">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên quán ăn <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name"
                                                               value="{{$restaurant->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Số điện thoại<span
                                                                class="text-danger">*</span> </label>
                                                        <input class="form-control" type="number" name="phone"
                                                               value="{{$restaurant->phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control" name="address"
                                                               value="{{$restaurant->address}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Xếp hạng</label>
                                                        <input class="form-control" type="number" step=0.5 min="0"
                                                               max="5" name="rating" value="{{$restaurant->rating}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mô tả </label>
                                                        <input class="form-control" type="text" name="description"
                                                               value="{{$restaurant->description}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Chủ quán ăn<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="user_id">
                                                            <option>
                                                                Chọn chủ quán ăn
                                                            </option>
                                                            @foreach($user as $u)
                                                                <option
                                                                    {{($restaurant->user_id) == $u->id ? 'selected' : '' }} value="{{$u->id}}">
                                                                    {{$u->username}}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mx-auto avt-wrapper ">
                                                        <img id='avt_img' name="image"
                                                             src="{{$restaurant->image}}"
                                                             alt="Photo" class="z-depth-1 mb-3 mx-auto"/>
                                                    </div>
                                                    <div>
                                                        <label>Hình ảnh <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">

                                                            <input aria-describedby="basic-addon2" class="form-control"
                                                                   type="text" size="48" name="image"
                                                                   id="image" value="{{$restaurant->image}}"/>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button"
                                                                        onclick="avatar('image','avt_img')">Select
                                                                    file
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Thể loại<span class="text-danger">*</span></label>
                                                        <select class="selectpicker w-100"
                                                            tabindex="-1" aria-hidden="true" name="category_id[]"
                                                            multiple="multiple" title="">
                                                            @foreach($category as $c)
                                                                <option
                                                                    @if(in_array($c->id, $restaurant->category->pluck('id')->toArray())) selected
                                                                    @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Trạng thái</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="active"
                                                           id="{{$restaurant->id}}employee_inactive"
                                                           value="0" {{ ($restaurant->active==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$restaurant->id}}employee_inactive">
                                                        Khóa
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="active"
                                                           id="{{$restaurant->id}}employee_active"
                                                           value="1" {{ ($restaurant->active==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$restaurant->id}}employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit"
                                                        class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Sửa quán ăn
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="{{asset('plugin/ckfinder/ckfinder.js')}}"></script>
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
@endsection
