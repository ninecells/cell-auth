@extends('ncells::jumbotron.app')

@section('content')
<?php
$member = \App\User::find($member_id);
?>
<div class="row">
    <div class="col-lg-12">
        <div>
            @include('ncells::auth.parts.member_tab', ['member_id' => $member->id, 'tabitem_key' => 'profile'])
            <div class="tab-content">
                <br/>
                <div role="tabpanel" class="tab-pane active">
                    <p>이름: {{ $member->name }}</p>
                    <p>Github: <a href="http://github.com/{{ $member->name }}">http://github.com/{{ $member->name }}</a>
                    </p>
                    @if ( Auth::check() && Auth::user()->id == $member_id )
                    <br/><br/><br/><br/>
                    <p>
                    <form method="post" action="/auth/logout">
                        {{ csrf_field() }}
                        <button id="btn-logout" class="btn btn-danger">로그아웃</button>
                    </form>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
