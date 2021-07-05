@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Sửa thông tin đánh giá</h6>
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
                                        <form method="post" action="{{route('admin-review.update',$review->id)}}">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên người dùng <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="user_id"
                                                               disabled="disabled"
                                                               value="{{$review->user->username}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Đánh giá</label>
                                                        <input class="form-control" type="text" name="review"
                                                               value="{{$review->review}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Xếp hạng</label>

                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="number" step=0.5 min="0"
                                                                   max="5" name="rate" value="{{$review->rate}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fas fa-star"
                                                                                                  style="color: orange"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Quán ăn<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="restaurant_id"
                                                               disabled="disabled"
                                                               value="{{$review->restaurant->name}}">
                                                        {{--                                                        <select class="custom-select select select2-hidden-accessible"--}}
                                                        {{--                                                                tabindex="-1" aria-hidden="true" name="restaurant_id">--}}
                                                        {{--                                                            @foreach($restaurant as $r)--}}
                                                        {{--                                                                <option--}}
                                                        {{--                                                                    {{($review->restaurant->id) == $r->id ? 'selected' : '' }} value="{{$r->id}}">--}}
                                                        {{--                                                                    {{$r->name}}--}}
                                                        {{--                                                                </option>--}}
                                                        {{--                                                            @endforeach--}}

                                                        {{--                                                        </select>--}}
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mx-auto avt-wrapper ">
                                                        <img id='avt_img' name="image" style="width:70px"
                                                             @if(count($review->image) <= 0)
                                                             {{$review->image}}
                                                             src=""
                                                             @elseif(count($review->image) > 0)
                                                             src="{{$review->image[0]->url}}"
                                                             @endif
                                                             alt="User Photo" class=" z-depth-1 mb-3 mx-auto"/>
                                                    </div>
                                                    <div>
                                                        <label>Hình ảnh </label>
                                                        <div class="input-group mb-3">

                                                            <input aria-describedby="basic-addon2"
                                                                   class="form-control"
                                                                   type="text" size="48" name="image"
                                                                   id="image"
                                                                   @if(count($review->image) <= 0)
                                                                   {{$review->image}}
                                                                   value=""
                                                                   @elseif(count($review->image) > 0)
                                                                   value="{{$review->image[0]->url}}"
                                                                @endif
                                                            />
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary"
                                                                        type="button"
                                                                        onclick="avatar('image','avt_img')">Select
                                                                    file
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Trạng thái</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$review->id}}employee_inactive"
                                                           value="0" {{ ($review->active==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label"
                                                           for="{{$review->id}}employee_inactive">
                                                        Không kích hoạt
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$review->id}}employee_active"
                                                           value="1" checked=""
                                                        {{ ($review->active==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label"
                                                           for="{{$review->id}}employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Sửa món ăn
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
