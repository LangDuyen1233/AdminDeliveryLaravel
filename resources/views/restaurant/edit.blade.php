@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Người dùng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm quán ăn</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thêm quán ăn mới</h6>
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
                                                        <label>Longtitude<span
                                                                class="text-danger">*</span> </label>
                                                        <input class="form-control" type="text" name="longtitude"
                                                               value="{{$restaurant->longtitude}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Lattitude<span
                                                                class="text-danger">*</span> </label>
                                                        <input class="form-control" type="text" name="lattitude"
                                                               value="{{$restaurant->lattitude}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mô tả </label>
                                                        <input class="form-control" type="text" name="description"
                                                               value="{{$restaurant->description}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Tạo quán ăn
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
