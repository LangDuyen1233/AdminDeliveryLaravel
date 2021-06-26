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

                            <button type="button" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-user.create')}}">Thêm người dùng</a>
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
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số ĐT</th>
                                <th>Địa chỉ</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Nhóm</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($users as $user)
                                {{ $i}}
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        <img src="../../assets/img/costic/customer-3.jpg" --}}
                                             style="width:50px; height:30px;">
                                        {{$user->username}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    {{--                                                    klsedrftgyhjkl--}}
                                    <td>Dia chi</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->dob}}</td>
                                    <td style="text-align: center">
                                        {{--                                                        @if (count($user) != 0)--}}
                                        {{$user->role->name}}
                                        {{--                                                        @else--}}
                                        {{--                                                            Không--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                        @foreach($roles as $role)--}}
                                        {{--                                                            @if($user->role_id==$role->id)--}}
                                        {{--                                                                {{$role->name}}--}}
                                        {{--                                                            @endif--}}
                                        {{--                                                        @endforeach--}}

                                    </td>
                                    <td style="display: flex; justify-content: space-around;border-bottom: none;">
                                        <a class="edit hvicon" style="color: green"
                                           href="{{route('admin-user.edit',$user->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i>Edit</a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-user.destroy',$user->id)}}"
                                           data-target="#modal-delete{{$user->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i>Delete</a>
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
                                                    <i class="flaticon-secure-shield d-block"></i>
                                                    <h1>Delete User</h1>
                                                    <p>Are you sure want delete user?</p>
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
