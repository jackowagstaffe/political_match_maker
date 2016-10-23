<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MemberFact;
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

    public function getDreamMpFacts()
    {
        return MemberFact::where('member_id', $this->id)->where('key', 'LIKE', '%public_whip_dreammp%')->get();
    }

    public function getPolicies()
    {
        return PolicyPosition::where('member_id', $this->id)->get();
    }
}
