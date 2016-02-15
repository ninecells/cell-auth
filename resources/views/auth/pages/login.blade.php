@extends('app')

@section('content')
<div class="alert alert-info" role="alert">신규 스킨 적용 예정</div>

<div class="row">
    <div class="col-lg-12">
        <p>
            알 수 없는 이메일 주소로 로그인이 안되시는 분들은 <br/>
            Github 설정 > Personal settings > Profile > Public profile > Public email > Don’t show my email address<br/>
            위처럼 되어있기 때문인데 노출 가능한 E-mail 을 선택해주시면 로그인이 됩니다.<br/>
            다른 로그인 방법을 추가하도록 노력하겠습니다.<br/>
            <span style="color: red;">탈퇴 기능이 아직 제공되지 않으므로 신중히 가입해주십쇼.</span>
        </p>
        @if($login_status === 'login_status_success')
        <div class="alert alert-success" role="alert">로그인에 성공했습니다.</div>
        @elseif($login_status === 'login_status_fail_email')
        <div class="alert alert-danger" role="alert">로그인에 실패했습니다. (알 수 없는 이메일 주소)</div>
        @elseif($login_status === 'login_status_fail_login')
        <div class="alert alert-danger" role="alert">로그인에 실패했습니다. (알 수 없는 이름)</div>
        @elseif($login_status === 'login_status_fail')
        <div class="alert alert-danger" role="alert">로그인에 실패했습니다. (필수 정보 누락)</div>
        @endif
        @unless(Auth::check())
        <a id="btn-login" class="btn btn-default" href="/auth/github">Github 로그인</a>
        @else
        <form method="post" action="/auth/logout">
            {{ csrf_field() }}
            <button id="btn-logout" class="btn btn-danger">로그아웃</button>
        </form>
        @endunless
    </div>
</div>
@endsection

@section('script')
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

        $('#btn-logout').click(function (e) {
            $(this).attr('disabled', true);
            $(this).parents('form').submit();
        });
    });
</script>
@endsection