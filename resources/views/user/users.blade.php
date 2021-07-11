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
                                <h6>Danh sách người dùng</h6>
                            </div>
                            <div class="right" style="display: flex">
                                <a id="import" style="display: inline;cursor: pointer;padding: 0 10px;margin-top: 8px;"
                                   data-toggle="modal"
                                   data-target="#modal_import" class="float-right item-tool"><i
                                        class="fas fa-file-import" style="font-size: 18px;"></i>
                                </a>
                                <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                        href="{{route('admin-user.create')}}">Thêm người dùng</a>
                                </button>
                            </div>
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
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số ĐT</th>
                                <th>Địa chỉ</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Nhóm</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        <img src="../../assets/img/costic/customer-3.jpg" --}}
                                             style="width:50px; height:30px;">
                                        {{$user->username}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    {{--                                                    klsedrftgyhjkl--}}
                                    <td>
                                        @foreach($user->address as $ua)
                                            @if($ua->status ==1)
                                                {{$ua->address}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->dob}}</td>
                                    <td style="text-align: center">
                                        {{$user->role->name}}
                                    </td>
                                    <td style="text-align: center">
                                        @if($user->active==1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @elseif($user->active==0)
                                            <span class="badge badge-danger">Khóa</span>
                                        @endif
                                    </td>
                                    <td style="display: flex; justify-content: space-around;border-bottom: none;">
                                        <a class="edit hvicon" style="color: green"
                                           href="{{route('admin-user.edit',$user->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i>Edit</a>
                                        @if($user->active==1)
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-user.destroy',$user->id)}}"
                                               data-target="#modal-delete{{$user->id}}"
                                               style="color: red"><i
                                                    class=" material-icons">&#xe897;</i></a>
                                        @else
                                            <a class="delete hvicon" data-toggle="modal"
                                               href="{{route('admin-user.destroy',$user->id)}}"
                                               data-target="#modal-delete{{$user->id}}"
                                               style="color: red"><i
                                                    class=" material-icons">&#xe898;</i></a>
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-delete{{$user->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-user.destroy',$user->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    @if($user->active == 1)
                                                        <i class="flaticon-secure-shield d-block"></i>
                                                        <h1>Khóa người dùng.</h1>
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
                                                        <h1>Mở khóa người dùng.</h1>
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
                        <div id="modal_import" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <form
                                        action="{{route('admin-user.import')}}"
                                        class="form-horizontal" role="form"
                                        method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h4 class="modal-title">NHẬP DANH SÁCH NGƯỜI DÙNG</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table width="100%" align="center">
                                                <tr>
                                                    <td width="20%">Chọn file</td>
                                                    <td width="80%" class="vclasses view align-left-10 ">
                                                        <input type="file" class="form-control" value="" name="data"
                                                               required>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-danger" value="Thêm và Đóng">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
