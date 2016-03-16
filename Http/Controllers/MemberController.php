<?php

namespace NineCells\Member\Http\Controllers;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function GET_member($member_id)
    {
        $login_status = session('login_status');
        return view('ncells::auth.pages.member_profile', [
            'login_status' => $login_status,
            'member_id' => $member_id,
        ]);
    }
}
