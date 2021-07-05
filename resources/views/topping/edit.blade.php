@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <div class="d-flex justify-content-between">
                            <div class="ms-header-text">
                                <h6>Sửa topping</h6>
                            </div>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            <div id="data-table-4_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2" style="padding-bottom: 20px">
                                        @if ($errors->any())
                                            <div class="alert alert-warning" style="display: block !important;">
                                                @foreach ($errors->all() as $error)
                                                    {{$error}} <br/>
                                                @endforeach
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('admin-topping.update',$topping->id)}}">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tên topping <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="name"
                                                               value="{{$topping->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Giá <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input class="form-control" type="number" step="10.000"
                                                                   min="0" name="price" value="{{$topping->price}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">VND</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Danh mục<span class="text-danger">*</span></label>
                                                        <select class="custom-select select select2-hidden-accessible"
                                                                tabindex="-1" aria-hidden="true" name="category_id">
                                                            <option>
                                                                Chọn danh mục
                                                            </option>
                                                            @foreach($category as $c)
                                                                <option
                                                                    {{($topping->category->id) == $c->id ? 'selected' : '' }} value="{{$c->id}}">
                                                                    {{$c->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="display-block">Trạng thái</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$topping->id}}employee_inactive"
                                                           value="0" {{ ($topping->status==0?'checked="checked"':'') }}>
                                                    <label class="form-check-label"
                                                           for="{{$topping->id}}employee_inactive">
                                                        Không kích hoạt
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                           id="{{$topping->id}}employee_active"
                                                           value="1" checked=""
                                                        {{ ($topping->status==1?'checked="checked"':'') }}>
                                                    <label class="form-check-label" for="{{$topping->id}}employee_active">
                                                        Kích hoạt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="m-t-20 text-center">
                                                <button type="submit" class="btn btn-outline-primary ms-graph-metrics"
                                                        name="button">Sửa topping
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
    </div>
@endsection
