@extends('layouts.master')
@section('content')
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-body">
                        <div class="ms-auth-form">
                            <form class="needs-validation" novalidate="" method="POST" action="{{route('updatePass',['id'=>$user->id])}}" style=" border: 0.5px solid lightgray;padding: 25px;width: 40%!important;">
                                @csrf
                                <h3>Đổi mật khẩu</h3>
{{--                                @error('mes')--}}
{{--                                <small class="form-text text-danger"><p style="color: red">{{ $message }}</p></small>--}}
{{--                                @enderror--}}
                                @if ($errors->any())
                                    <div class="alert alert-warning" style="display: block !important;">
                                        @foreach ($errors->all() as $error)
                                            {{$error}} <br/>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="mb-4">
                                    <label >Mật khẩu cũ</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="passwordOld" value="">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label >Mật khẩu mới</label>
                                    <div class="input-group">
                                        <input type="password" name="passwordNew" class="form-control" >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label >Xác nhận mật khẩu</label>
                                    <div class="input-group">
                                        <input type="password" name="re_passwordNew" class="form-control" >
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-4 d-block w-100" type="submit">Đồng ý</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
