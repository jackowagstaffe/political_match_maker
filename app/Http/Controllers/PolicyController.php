<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\PolicyData;
use App\Http\Requests;

class PolicyController extends Controller
{
    public function index(PolicyData $policy_data)
    {
        $sets = $policy_data->getSetsObjects();

        return view('policy/index', [
            'sets' => $sets,
        ]);
    }
}
