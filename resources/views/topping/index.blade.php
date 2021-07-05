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
                                <h6>Danh sách topping</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-topping.create')}}"
                                >Thêm topping</a>
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
                                <th>Tên topping</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($topping as $tp)
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td>
                                        {{$tp-> name}}
                                    </td>
                                    <td>{{$tp->price}}</td>
                                    <td>{{$tp->category->name}}</td>
                                    <td style="text-align: center">
                                        @if($tp->status==1)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($tp->status==0)
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td style="display: flex;justify-content: space-around;border-bottom: none;">
                                        <a class="edit hvicon" style="color: green"
                                           href="{{route('admin-topping.edit',$tp->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i>Edit</a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-topping.destroy',$tp->id)}}"
                                           data-target="#modal-delete{{$tp->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i>Delete</a>
                                    </td>

                                </tr>

                                <div class="modal fade" id="modal-delete{{$tp->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-topping.destroy',$tp->id)}}">
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
