@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thêm khuyến mãi mới</h6>
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
                                        <form method="post" action="{{route('admin-discount.store')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên khuyến mãi <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mã khuyến mãi <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="code" value="{{ old('code') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Giảm giá <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="number" step="0.1" min="0"
                                                                   max="100" name="percent">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ngày bắt đầu<span class="text-danger">*</span></label>
                                                        <div class="cal-icon input-group date"
                                                             data-date-format="yyyy-mm-dd">
                                                            <input id="startdate" class="form-control datepicker"
                                                                   placeholder="yyyy-mm-dd" type="text"
                                                                   name="start_date" value="{{ old('start_date') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ngày kết thúc<span class="text-danger">*</span></label>
                                                        <div class="cal-icon input-group date"
                                                             data-date-format="yyyy-mm-dd">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   placeholder="yyyy-mm-dd" type="text" name="end_date"
                                                                   value="{{ old('end_date') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Loại khuyến mãi<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true"
                                                                name="type_discount_id">
                                                            <option value="">
                                                                Chọn khuyến mãi
                                                            </option>
                                                            @foreach($type_discount as $td)
                                                                <option
                                                                    {{old('type_discount_id')=="1"? 'selected':''}} value="{{$td->id}}">
                                                                    {{$td->type}}
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
                                                            <option value="">
                                                                Chọn quán ăn
                                                            </option>
                                                            @foreach($restaurant as $r)
                                                                <option
                                                                    {{old('restaurant_id')=="1"? 'selected':''}} value="{{$r->id}}">
                                                                    {{$r->name}}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Trạng thái</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="employee_inactive"
                                                           value="0" {{ (old('status' )==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="employee_inactive">
                                                        Không kích hoạt
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="employee_active"
                                                           value="1" checked=""
                                                        {{ (old('status' )==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Tạo khuyến mãi
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
    <script type="text/javascript">
        $('#startdate').datepicker({
            format: 'mm-dd-yyyy'
        });
    </script>
@endsection

