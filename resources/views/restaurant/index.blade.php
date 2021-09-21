@extends('layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.dataTables.css')}}">
@endsection
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Danh sách quán ăn</h6>
                            </div>

                            <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-restaurant.create')}}"
                                >Thêm quán ăn</a>
                            </button>
                        </div>
                    </div>
                    @error('mes')
                    <small class="form-text text-danger"><p style="color: green">{{ $message }}</p></small>
                    @enderror
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Tên quán ăn</th>
                                <th>Hình ảnh</th>
                                <th>Chủ quán</th>
                                <th>Địa chỉ</th>
                                <th>Số ĐT</th>
                                <th>Xếp hạng</th>
                                {{--                                <th>Mô tả</th>--}}
                                {{--                                <th>Danh mục</th>--}}
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($restaurant as $res)
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$res->name}}
                                    </td>
                                    <td style="text-align: center">
                                        @if ($res->image != null)
                                            <img class=" rounded " style="width:70px" src="{{$res->image}}"
                                                 alt="">
                                        @else
                                            <img class=" rounded " style="width:70px" src=""
                                                 alt="">
                                        @endif
                                    </td>

                                    <td>
                                        {{$res->user->username}}
                                    </td>
                                    <td>{{$res->address}}</td>
                                    <td>{{$res->phone}}</td>
                                    <td style="text-align: center">
                                        {{--                                        <div class="container" style="width: 85%;height: 25px">--}}
                                        <div class="rating-container rating-xs rating-animate">
                                            <div class="rating-stars">
                                                                    <span class="empty-stars">
                                                                        <span class="star"><i
                                                                                class="fas fa-star empty-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star empty-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star empty-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star empty-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star empty-star"></i></span>
                                                                    </span>
                                                <span class="filled-stars"
                                                      style="width: {{$numberRating = $res-> rating*20 }}%">
                                                                        <span
                                                                            class="star"><i
                                                                                class="fas fa-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star"></i></span>
                                                                        <span class="star"><i
                                                                                class="fas fa-star"></i></span>
                                                                    </span>
                                                <input
                                                    id="input-1" name="input-1"
                                                    class="rating rating-loading rating-input"
                                                    data-min="0" data-max="5" data-step="0.5"
                                                    value="{{$res->rating}}"></div>
                                            <div class="caption"><span
                                                    class="label label-danger">{{$res-> rating}}</span>
                                            </div>
                                        </div>
                                        {{--                                        </div>--}}
                                    </td>
                                    <td style="text-align: center">
                                        @if($res->active==1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @elseif($res->active==0)
                                            <span class="badge badge-danger">Khóa</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a class="edit hvicon" style="color: green;padding-right: 8px;"
                                           href="{{route('admin-restaurant.edit',$res->id)}}">
                                            <i class="material-icons">&#xE254;</i></a>
                                        @if($res->active==1)
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-restaurant.destroy',$res->id)}}"
                                               data-target="#modal-delete{{$res->id}}"
                                               style="color: red"><i class=" material-icons">&#xe898;</i></a>
                                        @else
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-restaurant.destroy',$res->id)}}"
                                               data-target="#modal-delete{{$res->id}}"
                                               style="color: red"><i class=" material-icons">&#xe897;</i></a>
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete{{$res->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-restaurant.destroy',$res->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    @if($res->active == 1)
                                                        <i class="flaticon-secure-shield d-block"></i>
                                                        <h1>Khóa quán ăn.</h1>
                                                        <p>Bạn có chắc chắn muốn khóa không?</p>
                                                        <button type="submit"
                                                                class="btn btn-secondary btn-lg mr-2 rounded-lg"
                                                                data-dismiss="modal">
                                                            Hủy
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-danger btn-lg rounded-lg">
                                                            Khóa
                                                        </button>
                                                    @else
                                                        <i class="flaticon-secure-shield d-block"></i>
                                                        <h1>Mở khóa quán ăn.</h1>
                                                        <p>Bạn có chắc chắn muốn mở khóa không?</p>
                                                        <button type="submit"
                                                                class="btn btn-secondary btn-lg mr-2 rounded-lg"
                                                                data-dismiss="modal">
                                                            Hủy
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-danger btn-lg rounded-lg">
                                                            Mở khóa
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="ms-content-wrapper">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <nav aria-label="breadcrumb">--}}
    {{--                    <ol class="breadcrumb pl-0">--}}
    {{--                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Trang chủ</a>--}}
    {{--                        </li>--}}
    {{--                        <li class="breadcrumb-item"><a href="#">Người dùng</a>--}}
    {{--                        </li>--}}
    {{--                        <li class="breadcrumb-item active" aria-current="page">Danh sách người dùng</li>--}}
    {{--                    </ol>--}}
    {{--                </nav>--}}
    {{--                <div class="ms-panel">--}}
    {{--                    <div class="ms-panel-header">--}}
    {{--                        <div class="d-flex justify-content-between">--}}
    {{--                            <div class="ms-header-text">--}}
    {{--                                <h6>Danh sách quán ăn</h6>--}}
    {{--                            </div>--}}

    {{--                            <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a--}}
    {{--                                    href="{{route('admin-restaurant.create')}}"--}}
    {{--                                >Thêm quán ăn</a>--}}
    {{--                            </button>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    @error('mes')--}}
    {{--                    <small class="form-text text-danger"><p style="color: green">{{ $message }}</p></small>--}}
    {{--                    @enderror--}}
    {{--                    <div class="ms-panel-body">--}}
    {{--                        <div class="table-responsive">--}}
    {{--                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">--}}
    {{--                                <div class="row">--}}
    {{--                                    <div class="col-sm-12 col-md-6">--}}
    {{--                                        <div class="dataTables_length" id="data-table-4_length"><label>Hiển thị <select--}}
    {{--                                                    name="data-table-4_length" aria-controls="data-table-4"--}}
    {{--                                                    class="custom-select custom-select-sm form-control form-control-sm">--}}
    {{--                                                    <option value="10">10</option>--}}
    {{--                                                    <option value="25">25</option>--}}
    {{--                                                    <option value="50">50</option>--}}
    {{--                                                    <option value="100">100</option>--}}
    {{--                                                </select> </label></div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="col-sm-12 col-md-6">--}}
    {{--                                        <div id="data-table-4_filter" class="dataTables_filter"><label><input--}}
    {{--                                                    type="search" class="form-control form-control-sm"--}}
    {{--                                                    placeholder="Search Data..." aria-controls="data-table-4"></label>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="row">--}}
    {{--                                    <div class="col-sm-12">--}}
    {{--                                        <table id="data-table-4"--}}
    {{--                                               class="table w-100 thead-primary dataTable no-footer table-striped table-bordered"--}}
    {{--                                               cellspacing="0" width="100%" align="center"--}}
    {{--                                               role="grid" aria-describedby="data-table-4_info">--}}
    {{--                                            <thead>--}}
    {{--                                            <tr role="row" style="text-align: center">--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">ID--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Tên quán ăn--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Địa chỉ--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Số ĐT--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Xếp hạng--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Longtitude--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Lattitude--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Mô tả--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Thao tác--}}
    {{--                                                </th>--}}
    {{--                                            </tr>--}}
    {{--                                            </thead>--}}
    {{--                                            <tbody>--}}
    {{--                                            @foreach($restaurant as $res)--}}
    {{--                                                --}}{{--                                                {{$numberRating = $res-> rating*20}}--}}
    {{--                                                <tr role="row" class="odd">--}}
    {{--                                                    <td class="sorting_1" style="text-align: center">{{$res->id}}</td>--}}
    {{--                                                    <td>--}}
    {{--                                                        {{$res->name}}--}}
    {{--                                                    </td>--}}
    {{--                                                    <td>{{$res->address}}</td>--}}
    {{--                                                    <td>{{$res->phone}}</td>--}}
    {{--                                                    <td style="display: flex;justify-content: center">--}}
    {{--                                                        <div class="container" style="width: 85%;height: 25px">--}}
    {{--                                                            <div class="rating-container rating-xs rating-animate">--}}
    {{--                                                                <div class="rating-stars">--}}
    {{--                                                                    <span class="empty-stars">--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star empty-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star empty-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star empty-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star empty-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star empty-star"></i></span>--}}
    {{--                                                                    </span>--}}
    {{--                                                                    <span class="filled-stars"--}}
    {{--                                                                          style="width: {{$numberRating = $res-> rating*20 }}%">--}}
    {{--                                                                        <span--}}
    {{--                                                                            class="star"><i--}}
    {{--                                                                                class="fas fa-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star"></i></span>--}}
    {{--                                                                        <span class="star"><i--}}
    {{--                                                                                class="fas fa-star"></i></span>--}}
    {{--                                                                    </span>--}}
    {{--                                                                    <input--}}
    {{--                                                                        id="input-1" name="input-1"--}}
    {{--                                                                        class="rating rating-loading rating-input"--}}
    {{--                                                                        data-min="0" data-max="5" data-step="0.5"--}}
    {{--                                                                        value="{{$res->rating}}"></div>--}}
    {{--                                                                <div class="caption"><span--}}
    {{--                                                                        class="label label-danger">{{$res-> rating}}</span>--}}
    {{--                                                                </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </div>--}}
    {{--                                                    </td>--}}
    {{--                                                    <td>{{$res->longtitude}}</td>--}}
    {{--                                                    <td>{{$res->lattitude}}</td>--}}
    {{--                                                    <td>{{$res->description}}</td>--}}
    {{--                                                    <td style="text-align: center">--}}
    {{--                                                        <a class="edit hvicon" style="color: green"--}}
    {{--                                                           href="{{route('admin-restaurant.edit',$res->id)}}"--}}
    {{--                                                        ><i--}}
    {{--                                                                class="material-icons">&#xE254;</i></a>--}}
    {{--                                                        <a class="delete hvicon" data-toggle="modal"--}}
    {{--                                                           href="{{route('admin-restaurant.destroy',$res->id)}}"--}}
    {{--                                                           data-target="#modal-delete{{$res->id}}"--}}
    {{--                                                           style="color: red"><i--}}
    {{--                                                                class=" material-icons">&#xE872;</i></a>--}}
    {{--                                                    </td>--}}
    {{--                                                </tr>--}}

    {{--                                                <div class="modal fade" id="modal-delete{{$res->id}}" tabindex="-1"--}}
    {{--                                                     role="dialog" aria-labelledby="modal-delete"--}}
    {{--                                                     style="display: none;" aria-hidden="true">--}}
    {{--                                                    <div class="modal-dialog modal-dialog-centered modal-min"--}}
    {{--                                                         role="document">--}}
    {{--                                                        <div class="modal-content">--}}
    {{--                                                            <div class="modal-body text-center">--}}
    {{--                                                                <form method="post"--}}
    {{--                                                                      action="{{route('admin-restaurant.destroy',$res->id)}}">--}}
    {{--                                                                    {{ method_field('Delete') }}--}}
    {{--                                                                    {{ csrf_field() }}--}}
    {{--                                                                    <button type="button" class="close"--}}
    {{--                                                                            data-dismiss="modal"--}}
    {{--                                                                            aria-label="Close"><span--}}
    {{--                                                                            aria-hidden="true">×</span>--}}
    {{--                                                                    </button>--}}
    {{--                                                                    <i class="flaticon-secure-shield d-block"></i>--}}
    {{--                                                                    <h1>Delete User</h1>--}}
    {{--                                                                    <p>Are you sure want delete restaurant?</p>--}}
    {{--                                                                    <button type="submit"--}}
    {{--                                                                            class="btn btn-secondary btn-lg mr-2 rounded-lg"--}}
    {{--                                                                            data-dismiss="modal">--}}
    {{--                                                                        Cancel--}}
    {{--                                                                    </button>--}}
    {{--                                                                    <button type="submit"--}}
    {{--                                                                            class="btn btn-danger btn-lg rounded-lg">--}}
    {{--                                                                        Delete--}}
    {{--                                                                    </button>--}}
    {{--                                                                </form>--}}
    {{--                                                            </div>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            @endforeach--}}
    {{--                                            </tbody>--}}
    {{--                                        </table>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="row">--}}
    {{--                                    <div class="col-sm-12 col-md-5">--}}
    {{--                                        <div class="dataTables_info" id="data-table-4_info" role="status"--}}
    {{--                                             aria-live="polite">Hiển thị 1 tới 10 của 36 mục--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="col-sm-12 col-md-7">--}}
    {{--                                        <div class="dataTables_paginate paging_simple_numbers"--}}
    {{--                                             id="data-table-4_paginate">--}}
    {{--                                            <ul class="pagination has-gap">--}}
    {{--                                                <li class="paginate_button page-item previous disabled"--}}
    {{--                                                    id="data-table-4_previous"><a href="#" aria-controls="data-table-4"--}}
    {{--                                                                                  data-dt-idx="0" tabindex="0"--}}
    {{--                                                                                  class="page-link">Trước</a></li>--}}
    {{--                                                <li class="paginate_button page-item active"><a href="#"--}}
    {{--                                                                                                aria-controls="data-table-4"--}}
    {{--                                                                                                data-dt-idx="1"--}}
    {{--                                                                                                tabindex="0"--}}
    {{--                                                                                                class="page-link">1</a>--}}
    {{--                                                </li>--}}
    {{--                                                <li class="paginate_button page-item "><a href="#"--}}
    {{--                                                                                          aria-controls="data-table-4"--}}
    {{--                                                                                          data-dt-idx="2" tabindex="0"--}}
    {{--                                                                                          class="page-link">2</a></li>--}}
    {{--                                                <li class="paginate_button page-item "><a href="#"--}}
    {{--                                                                                          aria-controls="data-table-4"--}}
    {{--                                                                                          data-dt-idx="3" tabindex="0"--}}
    {{--                                                                                          class="page-link">3</a></li>--}}
    {{--                                                <li class="paginate_button page-item "><a href="#"--}}
    {{--                                                                                          aria-controls="data-table-4"--}}
    {{--                                                                                          data-dt-idx="4" tabindex="0"--}}
    {{--                                                                                          class="page-link">4</a></li>--}}
    {{--                                                <li class="paginate_button page-item next" id="data-table-4_next"><a--}}
    {{--                                                        href="#" aria-controls="data-table-4" data-dt-idx="5"--}}
    {{--                                                        tabindex="0" class="page-link">Tiếp</a></li>--}}
    {{--                                            </ul>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
@section('script')
    <script src="{{asset('assets/js/rating.js')}}"></script>
    <script type="text/javascript" charset="utf8"
            src="{{asset('assets/js/jquery.dataTables.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
