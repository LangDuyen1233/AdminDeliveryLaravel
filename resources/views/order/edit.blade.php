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
                                                               value="{{$order->user->username}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
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
                                                                tabindex="-1" aria-hidden="true"
                                                                name="payment_status_id">

                                                            @if($order->payment->status =='Chưa thanh toán')
                                                                <option>
                                                                    Chọn trạng thái
                                                                </option>
                                                                <option selected value="{{$order->payment->status}}">
                                                                    Chưa thanh toán
                                                                </option>
                                                                <option value="Đã thanh toán">
                                                                    Đã thanh toán
                                                                </option>

                                                            @elseif($order->payment->status =='Đã thanh toán')
                                                                <option>
                                                                    Chọn trạng thái
                                                                </option>
                                                                <option value="Chưa thanh toán">
                                                                    Chưa thanh toán
                                                                </option>
                                                                <option selected value="{{$order->payment->status}}">
                                                                    Đã thanh toán
                                                                </option>
                                                            @endif
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
                                                                   placeholder="dd/mm/yyyy" type="text" name="date"
                                                                   value="{{$order->date}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Phương thức thanh toán<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true"
                                                                name="payment_method_id">
                                                            @if($order->payment->method =='Tiền mặt')
                                                                <option>
                                                                    Chọn trạng thái
                                                                </option>
                                                                <option selected value="{{$order->payment->method}}">
                                                                    Tiền mặt
                                                                </option>
                                                                <option value="Zalopay">
                                                                    Zalopay
                                                                </option>

                                                            @elseif($order->payment->method =='Zalopay')
                                                                <option>
                                                                    Chọn trạng thái
                                                                </option>
                                                                <option value="Tiền mặt">
                                                                    Tiền mặt
                                                                </option>
                                                                <option selected value="{{$order->payment->method}}">
                                                                    Zalopay
                                                                </option>
                                                            @endif

                                                        </select>
                                                    </div>
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
