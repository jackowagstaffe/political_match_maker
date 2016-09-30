<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MemberFact;
use App\Policy;
use App\PolicyPosition;
use \App;

class Member extends Model
{
    protected $memberFacts = null;

    public function getMemberFacts()
    {
        if (is_null($this->memberFacts)) {
            $this->memberFacts = MemberFact::where('member_id', $this->id)->get();
        }

        return $this->memberFacts;
    }

    public function getPolicies()
    {
        $facts = MemberFact::where('member_id', $this->id)->where('key', 'LIKE', '%public_whip_dreammp%')->get();
        $policies = [];

        foreach ($facts as $fact) {
            if (!array_key_exists($fact->getDreamMpNo(), $policies)) {
                $policy = App::make('App\Policy');
                $policy->setNumber($fact->getDreamMpNo());

                $policy_position = App::make('App\PolicyPosition');
                $policy_position->setPolicy($policy);

                $policies[$fact->getDreamMpNo()] = $policy_position;
            }
            switch ($fact->getDreamMpType()) {
                case 'distance':
                    $policies[$fact->getDreamMpNo()]->setDistance($fact->value);
                    break;
                case 'absent':
                    $policies[$fact->getDreamMpNo()]->setAbsent($fact->value);
                    break;
                case 'both_voted':
                    $policies[$fact->getDreamMpNo()]->setBothVoted($fact->value === '1');
                    break;
                case 'has_strong_vote':
                    $policies[$fact->getDreamMpNo()]->setHasStrongVote($fact->value === '1');
                    break;
            }
        }

        return $policies;
    }
}
