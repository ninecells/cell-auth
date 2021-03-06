@extends('ncells::app')

@section('content')
<?php
$member = \App\User::find($member_id);
?>
<div class="row">
    <div class="col-lg-12">
        <div>
            @include('ncells::member.parts.member_tab', ['member_id' => $member_id, 'tabitem_key' => 'profile'])
            <div class="tab-content">
                <br/>
                <div role="tabpanel" class="tab-pane active">
                    <p>이름: {{ $member->name }}</p>
                    @if ( Auth::check() && Auth::user()->id == $member_id )
                    <br/><br/><br/><br/>
                    <a href="#" data-href="/auth/logout" class="logout btn btn-danger">로그아웃</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
    $(function () {
        $('.btn.logout').click(function () {
            var href = $(this).data('href');

            $.ajax({
                url: href,
                type: "POST",
                success: function (data, textStatus, jqXHR) {
                    window.location.href = data.redirect;
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            });

            return false;
        });
    });
</script>
@endsection
