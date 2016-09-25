<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PolicyData;
use App\TheyWorkForYou;

class CollectController extends Controller
{
    protected $policyData;
    protected $theyWorkForYou;

    public function __construct(PolicyData $policy_data, TheyWorkForYou $they_work_for_you)
    {
        $this->policyData = $policy_data;
        $this->theyWorkForYou = $they_work_for_you;
    }

    public function getMps()
    {
        $this->theyWorkForYou->getMps();
    }
}
