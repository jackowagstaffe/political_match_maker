<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PolicyData;
use App\Member;
use App\Match;
use App\Http\Requests;
use App\ResultGenerator;
use App\SessionDataTransformer;
use App\Jobs\GenerateResult;

class QuestionnaireController extends Controller
{
    protected $pages = 8;
    protected $page_data = [
        'welfare',
        'social',
        'foreignpolicy',
        'taxation',
        'business',
        'health',
        'education',
        'environment',
    ];

    public function page($page_id, PolicyData $policy_data)
    {
        if (!is_numeric($page_id) || $page_id < 1 || $page_id > $this->pages) {
            throw new \Exception('Not a valid page id');
        }
        $view_data = [
            'page_id' => $page_id,
            'sets' => $policy_data->getSetsObjects(),
            'page_data' => $this->page_data[$page_id - 1],
        ];

        return view('pages/page', $view_data);
    }

    public function submit($page_id, Request $request)
    {
        //Save the questionnaire data
        $data = $request->all();
        foreach ($data as $key => $value) {
            //if starts policy_
            if (substr($key, 0, strlen('policy_')) === 'policy_') {
                //only allow agree/disagree/dont_know - no funny business
                if (in_array($value, ['agree', 'disagree', 'dont_know'])) {
                    session([$key => $value]);
                }
            }
        }

        //redirect to the appropriate place
        if ($request->get('back', 'false') === 'true') {
            if ($page_id > 1) {
                return redirect()->route('page', ['page_id' => $page_id - 1]);
            } else {
                throw new \Exception("Cannot go back");
            }
        } else {
            if ($page_id < $this->pages) {
                return redirect()->route('page', ['page_id' => $page_id + 1]);
            } else {
                return redirect()->route('result');
            }
        }
    }

    public function awaitResult(SessionDataTransformer $transformer)
    {
        $transformer->setData(session()->all());

        $match = Match::where('hash', $transformer->getHash())->first();

        if (is_null($match)) {
            $this->dispatch(
                new GenerateResult(
                    $transformer->getData(),
                    $transformer->getHash()
                )
            );
        }

        return view('awaiting_result', ['hash' => $transformer->getHash()]); //view with results
    }

    public function pollResult(Request $request)
    {
        $hash = $request->input('hash');
        $match = Match::where('hash', $hash)->first();
        if (!is_null($match)) {
            $mp = Member::find($match->member_id);

            $positions = $mp->getPolicies();
            $policies = [];
            foreach ($positions as $position) {
                $policies[] = [
                    'policy' => $position->getPolicy()->text,
                    'position' => $position->getPositonText(),
                    'disagreement_width' => (50 - $position->getDisagreement())*2,
                    'agreement_width' => $position->getAgreement(),
                ];
            }

            return response()->json([
                'waiting' => false,
                'mp' => [
                    'id' => $mp->id,
                    'name' => $mp->name,
                    'party' => $mp->party,
                    'consituency' => $mp->constituency,
                    'policies' => $policies,
                ],
            ]);
        }

        return response()->json([
            'waiting' => true,
        ]);
    }
}
