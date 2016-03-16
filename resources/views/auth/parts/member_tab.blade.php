@inject('tab', 'NineCells\Member\MemberTab')
<?php
$member = \App\User::find($member_id);
$tab_items = $tab->getTabItems();
?>
<h2>{{ $member->name }}</h2><br/>
<ul class="nav nav-tabs" role="tablist">
    @foreach ( $tab_items as $item )
    <li role="presentation"{!! ($tabitem_key == $item->getKey() ? ' class="active"' : '') !!}>
        <a href="{{ $item->getUrl($member->id) }}" aria-controls="{{ $item->getKey() }}" role="tab" data-toggle="tab">{{ $item->getTitle() }}</a>
    </li>
    @endforeach
</ul>
