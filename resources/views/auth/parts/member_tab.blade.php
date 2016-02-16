@inject('tab', 'NineCells\Auth\MemberTab')
<?php
$tab_items = $tab->getTabItems();
?>
<h2>{{ $member->name }}</h2><br/>
<ul class="nav nav-tabs" role="tablist">
    @foreach ( $tab_items as $item )
    <li role="presentation"{!! ($tabitem_key == $item->getKey() ? ' class="active"' : '') !!}>
        <a href="{{ $item->getUrl($member_id) }}" aria-controls="{{ $item->getKey() }}" role="tab" data-toggle="tab">{{ $item->getTitle() }}</a>
    </li>
    @endforeach
</ul>
