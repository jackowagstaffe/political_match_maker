<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PolicyData;
use App\Http\Requests;
use App\ResultGenerator;
use App\SessionDataTransformer;

class QuestionnaireController extends Controller
{
    protected $pages = 8;

    public function page($page_id, PolicyData $policy_data)
    {
        if (!is_numeric($page_id)) {
    		throw new \Exception('Not a valid page id');
    	}
    	$view_data = [
            'page_id' => $page_id,
            'sets' => $policy_data->getSetsObjects(),
        ];

        return view('pages/page_' . $page_id, $view_data);
    }

    public function submit($page_id, Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            //if starts policy_
            if (substr($key, 0, strlen('policy_')) === 'policy_') {
                session([$key => $value]);
            }
        }

        if ($page_id < $this->pages) {
            return redirect()->route('page', ['page_id' => $page_id +1]);
        } else {
            return redirect()->route('result');
        }
    }

    public function result(ResultGenerator $gen, SessionDataTransformer $transformer)
    {
        $transformer->setData(session()->all());

        $gen->setData($transformer->getData());

        $gen->run();
        $mp = $gen->getMember();

        return view('result', ['mp' => $mp]); //view with results
    }
}
