@extends('app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($login_status === 'status_success')
        <div class="alert alert-success" role="alert">로그인에 성공했습니다.</div>
        @elseif($login_status === 'status_fail')
        <div class="alert alert-danger" role="alert">로그인에 실패했습니다.</div>
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
    $(function() {
        $('#btn-login').click(function(e) {
            $(this).text('Github 로그인 중...');
            $(this).attr('disabled', true);
            return true;
        });

        $('#btn-logout').click(function(e) {
            $(this).attr('disabled', true);
            $(this).parents('form').submit();
        });
    });
</script>
@endsection