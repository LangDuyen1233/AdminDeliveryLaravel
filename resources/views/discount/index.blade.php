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
                                <h6>Danh sách khuyến mãi</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-discount.create')}}"
                                >Thêm khuyến mãi</a>
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Tên khuyến mãi</th>
                                <th>Mã khuyến mãi</th>
                                <th>Giảm giá</th>

                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Loại khuyễn mãi</th>
                                <th>Quán ăn</th>
{{--                                <th>Trạng thái</th>--}}
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($discount as $d)
                                {{--                                {{ $i}}--}}
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$d->name}}
                                    </td>
                                    <td>{{$d->code}}</td>
                                    <td>{{$d->percent}}</td>

                                    <td>{{$d->start_date}}</td>
                                    <td>{{$d->end_date}}</td>
                                    <td>{{$d->typeDiscount->type}}</td>
                                    <td>{{$d->restaurant->name}}</td>
                                    <td style="display: flex;justify-content: space-around;border-bottom: none;">
                                        <a class="edit hvicon" style="color: green"
                                           href="{{route('admin-discount.edit',$d->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i></a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-discount.destroy',$d->id)}}"
                                           data-target="#modal-delete{{$d->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete{{$d->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-discount.destroy',$d->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    <i class="flaticon-secure-shield d-block"></i>
                                                    <h1>Xóa khuyến mãi</h1>
                                                    <p>Bạn chắc chắn muốn xóa không?</p>
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
    <script type="text/javascript" charset="utf8"
            src="{{asset('assets/js/jquery.dataTables.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
