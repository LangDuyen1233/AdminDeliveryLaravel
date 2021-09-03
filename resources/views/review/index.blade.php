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
                                <h6>Danh sách đánh giá</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-review.create')}}"
                                >Thêm đánh giá</a>
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Hình ảnh</th>
                                <th>Đánh giá</th>
                                <th>Xếp hạng</th>
                                <th>Quán ăn</th>
{{--                                <th>Trạng thái</th>--}}
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($review as $r)
                                {{--                                {{ $i}}--}}
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$r->user->username}}
                                    </td>
                                    <td style="text-align: center">
                                        @if (count($r->image) != 0)
                                            <img class=" rounded " style="width:70px" src="{{$r->image[0]->url}}"
                                                 alt="food1">
                                        @else
                                            {{--                                            <img class="rounded " style="width:70px" src=""--}}
                                            {{--                                                 alt="food1">--}}
                                            <p></p>
                                        @endif
                                    </td>
                                    <td>{{$r->review}}</td>
                                    <td style="">
                                        {{--                                        display: flex;justify-content: center--}}
                                        <div class="container" style="width: 85%; height: 25px">
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
                                                          style="width: {{$numberRating = $r-> rate*20 }}%">
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
                                                        value="{{$r->rate}}"></div>
                                                <div class="caption"><span
                                                        class="label label-danger">{{$r-> rate}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$r->restaurant->name}}</td>
{{--                                    <td style="text-align: center">--}}
{{--                                        @if($r->status==1)--}}
{{--                                            <span class="badge badge-success">Hoạt động</span>--}}
{{--                                        @elseif($r->status==0)--}}
{{--                                            <span class="badge badge-danger">Khóa</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td style="align-content: center">
                                        <a class="edit hvicon" style="color: green; padding-right: 8px"
                                           href="{{route('admin-review.edit',$r->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i></a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-review.destroy',$r->id)}}"
                                           data-target="#modal-delete{{$r->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i></a>
                                    </td>

                                </tr>

                                <div class="modal fade" id="modal-delete{{$r->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-review.destroy',$r->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    <i class="flaticon-secure-shield d-block"></i>
                                                    <h1>Xóa đánh giá</h1>
                                                    <p>Bạn có chắc chắn muốn xóa không?</p>
                                                    <button type="submit"
                                                            class="btn btn-secondary btn-lg mr-2 rounded-lg"
                                                            data-dismiss="modal">
                                                        Hủy
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger btn-lg rounded-lg">
                                                        Xóa
                                                    </button>
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
