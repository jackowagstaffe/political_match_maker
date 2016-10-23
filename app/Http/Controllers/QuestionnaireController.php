<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionnaireController extends Controller
{
    public function page($page_id)
    {
        if (!is_numeric($page_id)) {
    		throw new \Exception('Not a valid page id');
    	}
    	$view_data = ['page_id' => $page_id];

        return view('pages/page_' . $page_id, $view_data);
    }

    public function submit($page_id, Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            //if starts policy_
            if (substr($key, 0, strlen('policy_')) === 'policy_') {
                $policy_no = substr($key, strlen('policy_'));
                session([$key => $value]);
            }
        }
        
        return redirect('page', ['page_id' => $page_id + 1]);
    }
}
