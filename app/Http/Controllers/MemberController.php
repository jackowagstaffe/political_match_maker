<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Member;
use App\PolicyData;

class MemberController extends Controller
{
    public function view(Member $mp, PolicyData $policy_data)
    {
        return view('view_mp', [
            'mp' => $mp,
            'policy_data' => $policy_data,
        ]);
    }
}
