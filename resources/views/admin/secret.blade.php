@extends('layouts.base')

@section('content')

    <div class="middle_div" style="margin-left:-9%;margin-top: -15%">
        <form action="" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}
            <div class="col-lg-8">
                <div class="input-group" style="margin:0 auto;text-align: center">
                        <p><img src="{{$logo}}" alt="管理员" style="width: 25%;height: 25%;"> </p>
                    <p> <h4> <span class="label label-danger">{{$role_name}} </span></h4></p>
                    <p>{{$nickname}} </p>
                </div>
            <div class="input-group">
                <input type="text"  minlength="6" maxlength="6" max="999999" class="form-control" placeholder="请输入密钥" name="secret" required>
                <span class="input-group-btn">
                <button class="btn btn-info">提交</button>
                </span>
            </div>
            </div>
        </form>
    </div>
    <div style="position:fixed;float: right;">
        @component('quote')
        如果说,以不变应万变,是为君子的德行;那么随机应变就是防小人的手腕。
        @endcomponent
    </div>
    @endsection