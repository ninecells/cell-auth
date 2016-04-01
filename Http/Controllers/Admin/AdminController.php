<?php

namespace NineCells\Member\Http\Controllers\Admin;

use App\User;
use NineCells\Admin\PackageList;
use NineCells\Member\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct(PackageList $packageInfo)
    {
        $this->authorize('admin');

        $packageInfo->setCurrentMenu('member', [
            [
                'title' => '사용자 관리',
                'url' => 'admin/members'
            ],
        ]);
    }

    public function GET_admin_index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('ncells::member.pages.admin.index', ['users' => $users]);
    }
}
