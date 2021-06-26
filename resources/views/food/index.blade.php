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
                                <h6>Danh sách quán ăn</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    {{--                                    href="{{route('admin-category.create')}}"--}}
                                >Thêm danh mục</a>
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <table id="table_id"
                               class="display table w-100 thead-primary table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <tr style="text-align: center">
                                <th>#</th>
                                <th>Tên món ăn</th>
                                <th>Số ĐT</th>
                                <th>Đơn giá</th>
                                <th>Thành phần</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Row 1 Data 2</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td>Row 1 Data 1</td>
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a class="edit hvicon" style="color: green"
                                        {{--                                       href="{{route('admin-category.edit',$ca->id)}}"--}}
                                    ><i
                                            class="material-icons">&#xE254;</i></a>
                                    <a class="delete hvicon" data-toggle="modal"
                                       {{--                                       href="{{route('admin-category.destroy',$ca->id)}}"--}}
                                       data-target="#modal-delete"
                                       style="color: red"><i
                                            class=" material-icons">&#xE872;</i></a>
                                </td>
                            </tr>


                            <div class="modal fade" id="modal-delete" tabindex="-1"
                                 role="dialog" aria-labelledby="modal-delete"
                                 style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-min"
                                     role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <form method="post"
                                                {{--                                                  action="{{route('admin-category.destroy',$ca->id)}}"--}}
                                            >
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
