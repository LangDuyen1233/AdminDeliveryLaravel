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
