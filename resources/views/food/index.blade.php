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
                                <h6>Danh sách món ăn</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-food.create')}}"
                                >Thêm món ăn</a>
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Tên món ăn</th>
                                <th>Size</th>
                                <th>Hình ảnh</th>
                                <th>Đơn giá</th>
                                <th>Khối lượng</th>
                                <th>Thành phần</th>
                                <th>Thể loại</th>
                                <th>Quán ăn</th>
                                <th>Topping</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($food as $f)
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$f->name}}
                                    </td>
                                    <td>
                                        {{$f->size}}
                                    </td>
                                    <td style="text-align: center">
                                        @if (count($f->image) != 0)
                                            <img class=" rounded " style="width:70px" src="{{$f->image[0]->url}}"
                                                 alt="food1">
                                        @else
                                            <img class=" rounded " style="width:70px" src=""
                                                 alt="food1">
                                        @endif
                                    </td>
                                    <td>{{$f->price}} VND</td>
                                    <td>{{$f->weight}} g</td>
                                    <td>{{$f->ingredients}}</td>
                                    <td>{{$f->category->name}}</td>
                                    <td>{{$f->restaurant->name}}</td>
                                    <td>
                                        @foreach($f->toppings as $r)
                                            <li style="list-style-type: none">{{$r->name}}</li>
                                        @endforeach
                                    </td>
                                    <td style="text-align: center">
                                        @if($f->status==1)
                                            <span class="badge badge-success">Họat động</span>
                                        @elseif($f->status==0)
                                            <span class="badge badge-danger">Khóa</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a class="edit hvicon" style="color: green;padding: 10px"
                                           href="{{route('admin-food.edit',$f->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i></a>
                                        @if($f->status==1)
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-food.destroy',$f->id)}}"
                                               data-target="#modal-delete{{$f->id}}"
                                               style="color: red"><i
                                                    class=" material-icons">&#xe897;</i></a>
                                        @else
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-food.destroy',$f->id)}}"
                                               data-target="#modal-delete{{$f->id}}"
                                               style="color: red"><i
                                                    class=" material-icons">&#xe898;</i></a>
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete{{$f->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-food.destroy',$f->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    @if($f->status == 1)
                                                        <i class="flaticon-secure-shield d-block"></i>
                                                        <h1>Khóa món ăn.</h1>
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
                                                        <h1>Mở khóa món ăn.</h1>
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
    <script type="text/javascript" charset="utf8"
            src="assets/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
