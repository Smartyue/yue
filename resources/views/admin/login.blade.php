@extends('layouts.base')
@section('content')
    <div class="middle_div">
        <form  action="" method="POST">
            {{csrf_field()}}




            <!-- 状态码 -->
                @if(session('status')==-1)
                    <div class="alert alert-danger ">
                        账号/密码错误
                    </div>
                @elseif(session('status')==-2)
                    <div class="alert alert-warning">
                        账号已被禁用，请联系网站管理员
                    </div>
                @elseif(session('status')==-3)
                    <div class="alert alert-danger">
                        登录失败：密钥错误
                    </div>
                @endif
            <div class="form-group">
                <label for="username">登录账号</label>
                <input type="text" class="form-control" id="username" value="{{old('username')}}" name="username" required placeholder="*登录账号">
            </div>
            <div class="form-group">
                <label for="password">登录密码</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="*登录密码">
            </div>
            <div class="form-group" style="text-align: center">
                <button class="btn btn-success">立即登录</button>
            </div>
        </form>
    </div>

@endsection