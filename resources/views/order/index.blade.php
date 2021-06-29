@extends('layouts.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
@endsection
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Danh sách đơn hàng</h6>
                            </div>

{{--                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a--}}
{{--                                    href="{{route('admin-food.create')}}"--}}
{{--                                >Thêm món ăn</a>--}}
{{--                            </button>--}}
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Tên khách hàng</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Thuế</th>
                                <th>Phí giao hàng</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Phương thức thanh toán</th>
                                <th>Ngày</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
{{--                            @foreach($food as $f)--}}
{{--                                {{ $i}}--}}
{{--                                <tr role="row" class="odd">--}}
{{--                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>--}}
{{--                                    <td>--}}
{{--                                        {{$f->name}}--}}
{{--                                    </td>--}}
{{--                                    <td style="text-align: center">--}}
{{--                                        @if (count($f->image) != 0)--}}
{{--                                            <img class=" rounded " style="width:70px" src="{{$f->image[0]->url}}"--}}
{{--                                                 alt="food1">--}}
{{--                                        @else--}}
{{--                                            <img class=" rounded " style="width:70px" src=""--}}
{{--                                                 alt="food1">--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{$f->price}}</td>--}}
{{--                                    <td>{{$f->weight}}</td>--}}
{{--                                    <td>{{$f->ingredients}}</td>--}}
{{--                                    <td>{{$f->note}}</td>--}}
{{--                                    <td>{{$f->category->name}}</td>--}}
{{--                                    <td>{{$f->restaurant->name}}</td>--}}
{{--                                    <td style="text-align: center">--}}
{{--                                        @if($f->status==1)--}}
{{--                                            <span class="badge badge-success">Yes</span>--}}
{{--                                        @elseif($f->status==0)--}}
{{--                                            <span class="badge badge-danger">No</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td style="display: flex;justify-content: space-around;border-bottom: none;">--}}
{{--                                        <a class="view hvicon" style="color: green"--}}
{{--                                           href="{{route('admin-food.edit',$f->id)}}"--}}
{{--                                        ><i--}}
{{--                                                class="material-icons">&#xE254;</i>Edit</a>--}}
{{--                                        <a class="edit hvicon" style="color: green"--}}
{{--                                           href="{{route('admin-food.edit',$f->id)}}"--}}
{{--                                        ><i--}}
{{--                                                class="material-icons">&#xE254;</i>Edit</a>--}}
{{--                                        <a class="delete hvicon" data-toggle="modal"--}}
{{--                                           href="{{route('admin-food.destroy',$f->id)}}"--}}
{{--                                           data-target="#modal-delete{{$f->id}}"--}}
{{--                                           style="color: red"><i--}}
{{--                                                class=" material-icons">&#xE872;</i>Delete</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}

{{--                                <div class="modal fade" id="modal-delete{{$f->id}}" tabindex="-1"--}}
{{--                                     role="dialog" aria-labelledby="modal-delete"--}}
{{--                                     style="display: none;" aria-hidden="true">--}}
{{--                                    <div class="modal-dialog modal-dialog-centered modal-min"--}}
{{--                                         role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-body text-center">--}}
{{--                                                <form method="post"--}}
{{--                                                      action="{{route('admin-food.destroy',$f->id)}}">--}}
{{--                                                    {{ method_field('Delete') }}--}}
{{--                                                    {{ csrf_field() }}--}}
{{--                                                    <button type="button" class="close"--}}
{{--                                                            data-dismiss="modal"--}}
{{--                                                            aria-label="Close"><span--}}
{{--                                                            aria-hidden="true">×</span>--}}
{{--                                                    </button>--}}
{{--                                                    <i class="flaticon-secure-shield d-block"></i>--}}
{{--                                                    <h1>Xóa món ăn</h1>--}}
{{--                                                    <p>Bạn chắc chắn muốn xóa món ăn?</p>--}}
{{--                                                    <button type="submit"--}}
{{--                                                            class="btn btn-secondary btn-lg mr-2 rounded-lg"--}}
{{--                                                            data-dismiss="modal">--}}
{{--                                                        Hủy--}}
{{--                                                    </button>--}}
{{--                                                    <button type="submit"--}}
{{--                                                            class="btn btn-danger btn-lg rounded-lg">--}}
{{--                                                        Xóa--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
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
            src="assets/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
