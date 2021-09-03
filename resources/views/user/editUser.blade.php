@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Sửa người dùng</h6>
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
                                        @endif{{ method_field('PUT') }}
                                        <form method="post" action="{{route('admin-user.update',$users->id)}}">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Họ tên <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="username"
                                                               value="{{$users->username}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="email" name="email"
                                                               value="{{$users->email}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Số điện thoại<span
                                                                class="text-danger">*</span> </label>
                                                        <input class="form-control" type="text" name="phone"
                                                               value="{{$users->phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="address"
                                                               value="@foreach($users->address as $ua)@if($ua->status ==1){{$ua->address}}@endif @endforeach">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ngày sinh</label>
                                                        <div class="cal-icon input-group date"
                                                             data-date-format="dd/mm/yyyy">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   placeholder="dd/mm/yyyy" type="text" name="dob"
                                                                   value="{{$users->dob}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ cụ thể<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="detail"
                                                               value="@foreach($users->address as $ua)@if($ua->status ==1){{$ua->detail}}@endif @endforeach">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Giới tính</label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="gender"
                                                                id="gender">
                                                            <option
                                                                value="1"{{($users->gender) == 'Nam' ? 'selected' : '' }} >
                                                                Nam
                                                            </option>
                                                            <option
                                                                value="2"{{($users->gender) == 'Nữ' ? 'selected' : '' }} >
                                                                Nữ
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tiểu sử </label>
                                                        <input class="form-control" type="text" name="bio"
                                                               value="{{$users->bio}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phân quyền<span class="text-danger">*</span></label>
                                                        <label for="role">
                                                        </label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="role_id">
                                                            <option
                                                                value="1" {{($users->role->id) == '1' ? 'selected' : '' }} >
                                                                User
                                                            </option>
                                                            <option
                                                                value="2" {{($users->role->id) == '2' ? 'selected' : '' }} >
                                                                Admin
                                                            </option>
                                                            <option
                                                                value="3" {{($users->role->id) == '3' ? 'selected' : '' }}>
                                                                Shipper
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Trạng thái</label>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$users->id}}_inactive"
                                                           value="0" {{ (old('active' )==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$users->id}}_inactive">
                                                        Khóa
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$users->id}}_active"
                                                           value="1" checked=""
                                                        {{ (old('active' )==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$users->id}}_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Sửa người dùng
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
