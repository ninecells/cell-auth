<?php

namespace NineCells\Auth;

class MemberTab
{
    private $tabItems = [];

    public function addMemberTabItemInfo($key, $title, $urlGenerator)
    {
        $item = new MemberTabItem(['key' => $key, 'title' => $title, 'url-gen' => $urlGenerator]);
        array_push($this->tabItems, $item);
    }

    public function getTabItems()
    {
        return $this->tabItems;
    }
}

class MemberTabItem
{
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getKey()
    {
        return $this->data['key'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getUrl($member_id)
    {
        $func = $this->data['url-gen'];
        return $func($member_id);
    }
}