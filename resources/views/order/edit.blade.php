@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Sửa thông tin đơn hàng</h6>
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
                                        <form method="post" action="{{route('admin-order.update',$order->id)}}">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên khách hàng</label>
                                                        <input class="form-control" type="text" name="name"
                                                               disabled="disabled"
                                                               value="{{$order->user[0]->username}}">
                                                    </div>
                                                </div><div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Địa chỉ giao hàng<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="address_delivery"
                                                               value="{{$order->address_delivery}}">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Trạng thái đơn hàng<span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="order_status_id">
                                                            <option>
                                                                Chọn trạng thái
                                                            </option>
                                                            {{--                                                            {{$order->statusOrder->status}}--}}
                                                            @foreach($statusOrder as $os)
                                                                <option
                                                                    {{($order->statusOrder->id) == $os->id ? 'selected' : '' }} value="{{$os->id}}">
                                                                    {{$os->status}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Thuế </label>
                                                        <input class="form-control" type="text" name="tax"
                                                               value="{{$order->tax}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phí giao hàng<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="price_delivery"
                                                               value="{{$order->price_delivery}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Trạng thái thanh toán<span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="payment_status_id">
                                                            <option>
                                                                Chọn trạng thái
                                                            </option>
                                                            @foreach($paymentStatus as $ps)
                                                                <option
                                                                    {{($order->paymentStatus->id) == $ps->id ? 'selected' : '' }} value="{{$ps->id}}">
                                                                    {{$ps->status}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ngày<span
                                                                class="text-danger">*</span></label>
                                                        <div class="cal-icon input-group date"
                                                             data-date-format="dd/mm/yyyy">
                                                            <input id="datePicker" class="form-control datepicker"
                                                                   placeholder="dd/mm/yyyy" type="text" name="date" value="{{$order->date}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phương thức thanh toán<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="payment_method_id">
                                                            <option>
                                                                Chọn trạng thái
                                                            </option>
                                                            @foreach($paymentMethod as $pm)
                                                                <option
                                                                    {{($order->paymentMethod->id) == $pm->id ? 'selected' : '' }} value="{{$pm->id}}">
                                                                    {{$pm->method}}
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
                                                           id="{{$order->id}}employee_inactive"
                                                           value="0" {{ ($order->active==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label"
                                                           for="{{$order->id}}employee_inactive">
                                                        Không kích hoạt
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$order->id}}employee_active"
                                                           value="1" checked=""
                                                        {{ ($order->active==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$order->id}}employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Sửa đơn hàng
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
