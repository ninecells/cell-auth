@extends('ncells::jumbotron.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
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
    });
</script>
@endsection