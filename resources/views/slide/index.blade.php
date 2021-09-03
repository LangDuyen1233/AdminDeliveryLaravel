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
                                <h6>Danh sách banner</h6>
                            </div>

                            <button type="submit" class="btn btn-outline-primary ms-graph-metrics" name="button"><a
                                    href="{{route('admin-slides.create')}}"
                                >Thêm banner</a>
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
                                <th style="width: 100px">ID</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả</th>
                                <th style="width: 80px">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($slider as $s)
                                <tr role="row" class="odd">
                                    <td class="sorting_1" style="text-align: center">{{$i++}}</td>
                                    <td style="text-align: center">
                                        <img class=" rounded " style="width:70px" src="{{$s->url}}"
                                             alt="food1">
                                    </td>
                                    <td>
                                        {{$s->description}}
                                    </td>

                                    <td style="text-align: center">
                                        <a class="edit hvicon" style="color: green; padding-right: 8px"
                                           href="{{route('admin-slides.edit',$s->id)}}"
                                        ><i
                                                class="material-icons">&#xE254;</i></a>
                                        <a class="delete hvicon" data-toggle="modal"
                                           href="{{route('admin-slides.destroy',$s->id)}}"
                                           data-target="#modal-delete{{$s->id}}"
                                           style="color: red"><i
                                                class=" material-icons">&#xE872;</i></a>
                                    </td>

                                </tr>

                                <div class="modal fade" id="modal-delete{{$s->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="modal-delete"
                                     style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-min"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form method="post"
                                                      action="{{route('admin-slides.destroy',$s->id)}}">
                                                    {{ method_field('Delete') }}
                                                    {{ csrf_field() }}
                                                    <button type="button" class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close"><span
                                                            aria-hidden="true">×</span>
                                                    </button>
                                                    <i class="flaticon-secure-shield d-block"></i>
                                                    <h1>Xóa banner</h1>
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
