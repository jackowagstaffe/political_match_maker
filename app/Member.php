<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MemberFact;

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
        $facts = $this->getMemberFacts();
        $policies = [];

        foreach ($facts as $fact) {
            if ($fact->isDreamMp()) {
                if (!array_key_exists($fact->getDreamMpNo(), $policies)) {
                    $policies[$fact->getDreamMpNo()] = [];
                }
                $policies[$fact->getDreamMpNo()][] = $fact;
            }
        }

        return $policies;
    }
}
