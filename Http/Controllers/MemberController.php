<?php

namespace NineCells\Member\Http\Controllers;

class MemberController extends Controller
{
    public function GET_member($member_id)
    {
        return view('ncells::member.pages.member_profile', [
            'member_id' => $member_id,
        ]);
    }
}
