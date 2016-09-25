<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PolicyData;

class QuestionnaireController extends Controller
{
    protected $policyData;

    public function __construct(PolicyData $policy_data)
    {
        $this->policyData = $policy_data;
    }

    public function page($page_id)
    {
        if (!is_numeric($page_id)) {
    		throw new \Exception('Not a valid page id');
    	}
    	$view_data = ['page_id' => $page_id];

        return view('pages/page_' . $page_id, $view_data);
    }
}
