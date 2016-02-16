<h2>{{ $member->name }}</h2><br/>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"{!! ($tabitem_key == 'profile' ? ' class="active"' : '') !!}>
        <a href="/members/{{ $member_id }}" aria-controls="home" role="tab" data-toggle="tab">Profile</a>
    </li>
    <li role="presentation"{!! ($tabitem_key == 'qna' ? ' class="active"' : '') !!}>
        <a href="/members/{{ $member_id }}/qna" aria-controls="profile" role="tab" data-toggle="tab">Q&A</a>
    </li>
</ul>
