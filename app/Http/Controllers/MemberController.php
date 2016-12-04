<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Member;
use App\PolicyData;

class MemberController extends Controller
{
    public function view(Member $mp)
    {
        return view('mp/view', [
            'mp' => $mp,
        ]);
    }

    public function index()
    {
        return view('mp/index', [
            'mps' => Member::paginate(20),
        ]);
    }
}
