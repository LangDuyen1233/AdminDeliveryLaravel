@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thêm người dùng mới</h6>
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
                                        <form method="post" action="{{route('admin-user.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Họ tên <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="username" value="{{ old('username') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mật khẩu<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="password" name="password" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Xác nhận mật khẩu<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="password" name="re_password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Số điện thoại<span
                                                                class="text-danger">*</span> </label>
                                                        <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ngày sinh</label>
                                                        <div class="cal-icon input-group date"
                                                             data-date-format="dd/mm/yyyy">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   placeholder="dd/mm/yyyy" type="text" name="dob" value="{{ old('dob') }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Giới tính</label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="gender">
                                                            <option {{old('gender')=="1"? 'selected':''}} value="1">
                                                                Nam
                                                            </option>
                                                            <option {{old('gender')=="2"? 'selected':''}} value="2">Nữ
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tiểu sử </label>
                                                        <input class="form-control" type="text" name="bio"value="{{ old('bio') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phân quyền<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="role_id">
                                                            <option {{old('role_id')=="1"? 'selected':''}} value="1">
                                                                User
                                                            </option>
                                                            <option {{old('role_id')=="2"? 'selected':''}} value="2">
                                                                Admin
                                                            </option>
                                                            <option {{old('role_id')=="3"? 'selected':''}} value="3">
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
                                                           id="employee_inactive"
                                                           value="0" {{ (old('active' )==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="employee_inactive">
                                                        Không kích hoạt
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="employee_active"
                                                           value="1" checked=""
                                                        {{ (old('active' )==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Tạo người dùng
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
