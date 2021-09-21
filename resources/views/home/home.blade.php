@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 class="db-header-title">Xin chào, {{$user->username}}</h1>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                    {{--                    <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 3.2%</span>--}}
                    <div class="ms-card-body media">
                        <div class="media-body" style="text-align: center">
                            <span class="black-text"><strong>Tổng người dùng</strong></span>
                            <h2>{{$countUser}}</h2>
                        </div>
                    </div>
                    <canvas id="line-chart" style="height: 40px !important;"></canvas>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                    {{--                    <span class="ms-chart-label bg-red"><i class="material-icons">arrow_downward</i> 4.5%</span>--}}
                    <div class="ms-card-body media">
                        <div class="media-body" style="text-align: center">
                            <span class="black-text"><strong>Tổng quán ăn</strong></span>
                            <h2>{{$countRestaurant}}</h2>
                        </div>
                    </div>
                    <canvas id="line-chart-2" style="height: 40px !important;"></canvas>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                    {{--                    <span class="ms-chart-label bg-black"><i class="material-icons">arrow_upward</i> 12.5%</span>--}}
                    <div class="ms-card-body media">
                        <div class="media-body" style="text-align: center">
                            <span class="black-text"><strong>Tổng đơn hàng</strong></span>
                            <h2>{{$countOrder}}</h2>
                        </div>
                    </div>
                    <canvas id="line-chart-3" style="height: 40px !important;"></canvas>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget">
                    {{--                    <span class="ms-chart-label bg-red"><i class="material-icons">arrow_upward</i> 9.5%</span>--}}
                    <div class="ms-card-body media">
                        <div class="media-body" style="text-align: center">
                            <span class="black-text"><strong>Tổng doanh thu</strong></span>
                            <h2>{{$sumPrice}}đ</h2>
                        </div>
                    </div>
                    <canvas id="line-chart-4" style="height: 40px !important;"></canvas>
                </div>
            </div>
            <!-- Recent Orders Requested -->
            <div class="col-xl-6 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center align-left">
                                <h6>Danh sách món ăn bán chạy</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Món ăn</th>
                                    <th scope="col" style="text-align: center">Giá</th>
                                    <th scope="col" style="text-align: center">Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($foodOrder as $fo)
                                    <tr>
                                        <td class="ms-table-f-w"><img src="{{$fo->url}}" alt="people">
                                            {{$fo->name}}
                                        </td>
                                        <td style="text-align: center">
                                            {{$fo->price}}đ
                                        </td>
                                        <td style="text-align: center">
                                            {{$fo->total_food}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="align-self-center align-left">
                                <h6>Doanh thu theo tháng</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Tháng</th>
                                    <th scope="col">Tổng Tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($monthlyRevenue as $mr)
                                    <tr>
                                        <td class="ms-table-f-w">
                                            {{$mr->month}}
                                        </td>
                                        <td>
                                            {{$mr->total}}đ
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Food Orders -->
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <h6>Nhà hàng bán chạy</h6>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            @foreach($restaurantSelling as $rs)
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="ms-card no-margin">
                                        <div class="ms-card-img">
                                            <img src="{{$rs->image}}" alt="card_img">
                                        </div>
                                        <div class="ms-card-body">
                                            <div class="ms-card-heading-title">
                                                <h6>{{$rs->name}}</h6>
                                                <span><strong>{{$rs->rating}}</strong><i class="fas fa-star"
                                                                                         style="color: yellow"></i></span>
                                            </div>

                                            <div class="ms-card-heading-title">
                                                <p>Đơn hàng: <span class="red-text">{{$rs->countOrder}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- END/Food Orders -->
            <!-- client chat -->
        </div>
    </div>
@endsection
