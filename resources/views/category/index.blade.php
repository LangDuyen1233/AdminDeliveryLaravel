@extends('layouts.master')
@section('css')
{{--    /*<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">*/--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">--}}
@endsection
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Danh sách người dùng</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-category.create')}}"
                                >Thêm danh mục</a>
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
                                <th>Tên danh mục</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($category as $ca)
                                {{ $i}}
                                <tr role="row" class="odd" style="height: 50px">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$ca->name}}
                                    </td>
                                    <td style="    padding: 3px; text-align: center;">
                                        <img id='avt_img' name="image" style="width: 50px"
                                             src="{{$ca->image}}" class="rounded"/>
                                    </td>

                                    <td>{{$ca->description}}</td>
                                    <td style="display: flex; justify-content: space-evenly;">
                                        <a class="edit hvicon" style="color: green"
                                           href="{{route('admin-category.edit',$ca->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i>Edit</a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-category.destroy',$ca->id)}}"
                                           data-target="#modal-delete{{$ca->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i>Delete</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete{{$ca->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-category.destroy',$ca->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    <i class="flaticon-secure-shield d-block"></i>
                                                    <h1>Delete User</h1>
                                                    <p>Are you sure want delete restaurant?</p>
                                                    <button type="submit"
                                                            class="btn btn-secondary btn-lg mr-2 rounded-lg"
                                                            data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger btn-lg rounded-lg">
                                                        Delete
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
    {{--    <div class="ms-content-wrapper">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-12">--}}
    {{--                <nav aria-label="breadcrumb">--}}
    {{--                    <ol class="breadcrumb pl-0">--}}
    {{--                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Trang chủ</a>--}}
    {{--                        </li>--}}
    {{--                        <li class="breadcrumb-item"><a href="#">Người dùng</a>--}}
    {{--                        </li>--}}
    {{--                        <li class="breadcrumb-item active" aria-current="page">Danh mục</li>--}}
    {{--                    </ol>--}}
    {{--                </nav>--}}
    {{--                <div class="ms-panel">--}}
    {{--                    <div class="ms-panel-header">--}}
    {{--                        <div class="d-flex justify-content-between">--}}
    {{--                            <div class="ms-header-text">--}}
    {{--                                <h6>Danh sách quán ăn</h6>--}}
    {{--                            </div>--}}

    {{--                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a--}}
    {{--                                    href="{{route('admin-category.create')}}"--}}
    {{--                                >Thêm danh mục</a>--}}
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
    {{--                                                    rowspan="1" colspan="1">Tên danh mục--}}
    {{--                                                </th>--}}
    {{--                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"--}}
    {{--                                                    rowspan="1" colspan="1">Hình ảnh--}}
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
    {{--                                            @php--}}
    {{--                                                $i = 1;--}}
    {{--                                            @endphp--}}
    {{--                                            @foreach($category as $ca)--}}
    {{--                                                {{ $i}}--}}
    {{--                                                <tr role="row" class="odd">--}}
    {{--                                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>--}}
    {{--                                                    <td>--}}
    {{--                                                        {{$ca->name}}--}}
    {{--                                                    </td>--}}
    {{--                                                    <td style="    padding: 3px; text-align: center;">--}}
    {{--                                                        <img id='avt_img' name="image"--}}
    {{--                                                             src="{{$ca->image}}" class="z-depth-1 mb-3 mx-auto"/>--}}
    {{--                                                    </td>--}}

    {{--                                                    <td>{{$ca->description}}</td>--}}
    {{--                                                    <td style="display: flex; justify-content: space-evenly;">--}}
    {{--                                                        <a class="edit hvicon" style="color: green"--}}
    {{--                                                           href="{{route('admin-category.edit',$ca->id)}}"--}}
    {{--                                                        ><i--}}
    {{--                                                                class="material-icons">&#xE254;</i></a>--}}
    {{--                                                        <a class="delete hvicon" data-toggle="modal"--}}
    {{--                                                           href="{{route('admin-category.destroy',$ca->id)}}"--}}
    {{--                                                           data-target="#modal-delete{{$ca->id}}"--}}
    {{--                                                           style="color: red"><i--}}
    {{--                                                                class=" material-icons">&#xE872;</i></a>--}}
    {{--                                                    </td>--}}
    {{--                                                </tr>--}}

    {{--                                                <div class="modal fade" id="modal-delete{{$ca->id}}" tabindex="-1"--}}
    {{--                                                     role="dialog" aria-labelledby="modal-delete"--}}
    {{--                                                     style="display: none;" aria-hidden="true">--}}
    {{--                                                    <div class="modal-dialog modal-dialog-centered modal-min"--}}
    {{--                                                         role="document">--}}
    {{--                                                        <div class="modal-content">--}}
    {{--                                                            <div class="modal-body text-center">--}}
    {{--                                                                <form method="post"--}}
    {{--                                                                      action="{{route('admin-category.destroy',$ca->id)}}">--}}
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
    <script type="text/javascript" charset="utf8"
            src="assets/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>
@endsection
