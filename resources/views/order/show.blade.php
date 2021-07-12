@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Thông tin đơn hàng</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="card-body">
                            <div class="row" style="justify-content: space-evenly">
                                <div class="card col-3" style="background-color: #ebebeb">
                                    <div class="card-title" style="margin-top: .75rem;">Thông tin khách hàng</div>
                                    <div class="row" style="border-top: solid 1px #cecece;padding-top: 10px;">
                                        <label for="id" class="col-5 control-label">ID</label>
                                        <div class="col-7">
                                            <p>#{{$order->id}}</p>
                                        </div>
                                        <label for="order_client" class="col-5 control-label">Họ và tên</label>
                                        <div class="col-7">
                                            <p>{{$order->user[0]->username}}</p>
                                        </div>

                                        <label for="order_client_phone" class="col-5 control-label">Số điện
                                            thoại</label>
                                        <div class="col-7">
                                            <p>+{{$order->user[0]->phone}}}</p>
                                        </div>

                                        <label for="delivery_address" class="col-5 control-label">Địa chỉ giao
                                            hàng</label>
                                        <div class="col-7">
                                            <p>chuwa lafm</p>
                                        </div>

                                        <label for="order_date" class="col-5 control-label">Ngày giao</label>
                                        <div class="col-7 ">
                                            <p>{{$order->date}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-3" style="background-color: #ebebeb">
                                    <div class="card-title" style="margin-top: .75rem;">Thông tin giao hàng</div>
                                    <div class="row" style="border-top: solid 1px #cecece;padding-top: 10px;">
                                        <label for="order_status_id" class="col-5 control-label">Trạng thái giao</label>
                                        <div class="col-7">
                                            <p>{{$order->statusOrder->status}}</p>
                                        </div>

                                        <label for="active" class="col-5 control-label">Phí giao hàng</label>
                                        <div class="col-7">
                                            <p>{{$order->price_delivery}}</p>
                                        </div>

                                        <label for="payment_method" class="col-5 control-label">Phương thức thanh
                                            toán</label>
                                        <div class="col-7">
                                            <p>{{$order->paymentMethod->method}}</p>
                                        </div>

                                        <label for="payment_status" class="col-5 control-label">Trạng thái thanh
                                            toán</label>
                                        <div class="col-7">
                                            <p>{{$order->paymentStatus->status}}</p>
                                        </div>
                                        <label for="order_updated_date" class="col-5 control-label">Ngày giao</label>
                                        <div class="col-7">
                                            <p>{{$order->date}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-3" style="background-color: #ebebeb">
                                    <div class="card-title" style="margin-top: .75rem;">Thông tin quán ăn</div>
                                    <div class="row " style="border-top: solid 1px #cecece;padding-top: 10px;">
                                        <label for="restaurant" class="col-5 control-label">Quán ăn</label>
                                        <div class="col-7">
                                            <p>{{$order->cart->food[0]->restaurant->name}}</p>
                                        </div>

                                        <label for="restaurant_address" class="col-5 control-label">Địa chỉ</label>
                                        <div class="col-7">
                                            <p>Damak Jhapa</p>
                                        </div>

                                        <label for="restaurant_phone" class="col-5 control-label">Số điện thoại</label>
                                        <div class="col-7">
                                            <p>+{{$order->cart->food[0]->restaurant->phone}}</p>
                                        </div>

                                        <label for="driver" class="col-5 control-label">Driver</label>
                                        <div class="col-7">
                                            <p>Not assigned</p>
                                        </div>

                                        <label for="hint" class="col-5 control-label">Hint:</label>
                                        <div class="col-7">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table_id"
                                   class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                                <thead>
                                <tr style="text-align: center">
                                    <th>ID</th>
                                    <th>Món ăn</th>
                                    <th>Size</th>
                                    <th>Topping</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->cart->food as $f)
                                    <tr role="row" class="odd">
                                        <td>
                                            #{{$f->id}}
                                        </td>
                                        <td>
                                            {{$f->name}}
                                        </td>
                                        @if(count($f->sizes)!=0)
                                            <td>
                                                @foreach($f->sizes as $s)
                                                    {{$s->name}}
                                                @endforeach
                                            </td>
                                        @elseif(count($f->sizes)==0)
                                            <td>Không</td>
                                        @endif
                                        @if(count($f->toppings)!=0)
                                            <td>
                                                @foreach($f->toppings as $t)
                                                    {{$t->name}}
                                                @endforeach

                                            </td>
                                        @elseif(count($f->toppings)==0)
                                            <td>Không</td>
                                        @endif
                                        <td>
                                            {{$f->pivot->quantity}}
                                        </td>
                                        <td>
                                            {{$f->pivot->price}}
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <table
                                class="display table w-30 thead-primary table table-striped table-bordered dataTable no-footer"
                                style="width: 32%;margin-right: 0">
                                <tr>
                                    <th class="text-right">Tạm tính</th>
                                    <td><span>đ</span> {{$order->cart->sum_price}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Phí vận chuyển</th>
                                    <td><span>đ</span> {{$order->price_delivery}}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Giảm giá</th>
                                    <td><span>đ</span> chuwa lafm</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Tổng</th>
                                    <td><span>đ</span> {{$order->price}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('li a.active').removeClass('active');
            $('a[href$="/admin-order"]').addClass('active');
        });
    </script>
    {{--    <script>--}}
    {{--        function avatar(elementId, ava) {--}}
    {{--            CKFinder.popup({--}}
    {{--                chooseFiles: true,--}}
    {{--                // type: "Avatar",--}}
    {{--                width: 800,--}}
    {{--                height: 600,--}}
    {{--                onInit: function (finder) {--}}
    {{--                    finder.on("files:choose", function (evt) {--}}
    {{--                        var file = evt.data.files.first();--}}
    {{--                        var output = document.getElementById(elementId);--}}
    {{--                        var out = document.getElementById(ava);--}}
    {{--                        output.value = file.getUrl();--}}
    {{--                        out.src = file.getUrl();--}}
    {{--                    });--}}

    {{--                    finder.on("file:choose:res ", function (--}}
    {{--                        evt--}}
    {{--                    ) {--}}
    {{--                        var output = document.getElementById(elementId);--}}
    {{--                        output.value = evt.data.resizedUrl;--}}
    {{--                    });--}}
    {{--                },--}}
    {{--            });--}}
    {{--        }--}}
    {{--    </script>--}}
    {{--    <script src="{{asset('plugin/ckfinder/ckfinder.js')}}"></script>--}}
@endsection