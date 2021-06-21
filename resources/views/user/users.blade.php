@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb pl-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Người dùng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách người dùng</li>
                    </ol>
                </nav>
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
                        <div class="table-responsive">
                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="data-table-4_length"><label>Hiển thị <select
                                                    name="data-table-4_length" aria-controls="data-table-4"
                                                    class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> </label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="data-table-4_filter" class="dataTables_filter"><label><input
                                                    type="search" class="form-control form-control-sm"
                                                    placeholder="Search Data..." aria-controls="data-table-4"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-table-4"
                                               class="table w-100 thead-primary dataTable no-footer table-striped table-bordered"
                                               cellspacing="0" width="100%" align="center"
                                               role="grid" aria-describedby="data-table-4_info">
                                            <thead>
                                            <tr role="row" style="text-align: center">
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Họ tên
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Email
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Số ĐT
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Địa chỉ
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Giới tính
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Ngày sinh
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Nhóm
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="data-table-4"
                                                    rowspan="1" colspan="1">Thao tác
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1" style="text-align: center">{{$user->id}}</td>
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
                                                    <td style="text-align: center">
                                                        <a class="edit hvicon" style="color: green"
                                                           href="{{route('admin-user.edit',$user->id)}}"
                                                        ><i
                                                                class="material-icons">&#xE254;</i></a>
                                                        <a class="delete hvicon" data-toggle="modal"
                                                           href="{{route('admin-user.destroy',$user->id)}}"
                                                           data-target="#modal-delete{{$user->id}}"
                                                           style="color: red"><i
                                                                class=" material-icons">&#xE872;</i></a>
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
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="data-table-4_info" role="status"
                                             aria-live="polite">Hiển thị 1 tới 10 của 36 mục
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="data-table-4_paginate">
                                            <ul class="pagination has-gap">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="data-table-4_previous"><a href="#" aria-controls="data-table-4"
                                                                                  data-dt-idx="0" tabindex="0"
                                                                                  class="page-link">Trước</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                                                                aria-controls="data-table-4"
                                                                                                data-dt-idx="1"
                                                                                                tabindex="0"
                                                                                                class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item "><a href="#"
                                                                                          aria-controls="data-table-4"
                                                                                          data-dt-idx="2" tabindex="0"
                                                                                          class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                                                          aria-controls="data-table-4"
                                                                                          data-dt-idx="3" tabindex="0"
                                                                                          class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                                                          aria-controls="data-table-4"
                                                                                          data-dt-idx="4" tabindex="0"
                                                                                          class="page-link">4</a></li>
                                                <li class="paginate_button page-item next" id="data-table-4_next"><a
                                                        href="#" aria-controls="data-table-4" data-dt-idx="5"
                                                        tabindex="0" class="page-link">Tiếp</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
