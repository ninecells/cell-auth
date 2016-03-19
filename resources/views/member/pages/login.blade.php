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
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Github 로그인</div>
            <div class="panel-body">

                <p>
                    알 수 없는 이메일 주소로 로그인이 안되시는 분들은 <br/>
                    Github 설정 > Personal settings > Profile > Public profile > Public email > Don’t show my email address<br/>
                    위처럼 되어있기 때문인데 노출 가능한 E-mail 을 선택해주시면 로그인이 됩니다.<br/>
                    다른 로그인 방법을 추가하도록 노력하겠습니다.<br/>
                    <span style="color: red;">탈퇴 기능이 아직 제공되지 않으므로 신중히 가입해주십쇼.</span>
                </p>
                <a id="btn-login" class="btn btn-default" href="/auth/github">Github 로그인</a>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    $(function () {
        $('#btn-login').click(function (e) {
            if ($(this).attr('disabled')) {
                return false;
            }
            $(this).text('Github 로그인 중...');
            $(this).attr('disabled', true);
            return true;
        });
    });
</script>
@endsection