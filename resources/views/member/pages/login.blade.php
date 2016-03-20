@extends('ncells::app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {!! $error !!}<br/>
                    @endforeach
                </div>
                @endif

                <p><span style="color: red;">탈퇴 기능이 아직 제공되지 않으므로 신중히 가입해주십쇼.</span></p>
                <a class="btn-login btn btn-default" href="/auth/github">Github 로그인</a>
                <a class="btn-login btn btn-default" href="/auth/slack">Slack 로그인</a>
                <hr/>

                <form method="POST" action="/auth/login" accept-charset="UTF-8" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-mail Address</label>
                        <div class="col-md-6">
                            <input class="form-control" placeholder="E-mail Address" name="email" type="email" id="email" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input class="form-control" placeholder="Password" name="password" type="password" id="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" /> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <input class="btn btn-primary" type="submit" value="Login">
                            &nbsp;&nbsp;&nbsp;<a href="/auth/register">Register</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    $(function () {
        $('.btn-login').click(function (e) {
            if ($('.btn-login').attr('disabled')) {
                return false;
            }
            $(this).text('로그인 중...');
            $('.btn-login').attr('disabled', true);
            return true;
        });
    });
</script>
@endsection