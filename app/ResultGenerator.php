<?php

namespace App;

use App\Member;
use App\PolicyPosition;

class ResultGenerator
{
    protected $data;
    protected $memberScores = [];
    protected $members = [];
    protected $match = null;

    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     *  Calculate the best member for the user based on the data in $this->data
     */
    public function run()
    {
        if (!is_null($this->data)) {
            $this->members = Member::all();

            //set scores
            foreach ($this->data as $policy_id => $agrees) {
                foreach ($this->members as $member) {
                    $position = PolicyPosition::where('member_id', $member->id)
                        ->where('policy_id', $policy_id)
                        ->first();

                    if (!is_null($position)) {
                        if ($agrees) {
                            $score = 1 - $position->distance;
                        } else {
                            $score = $position->distance;
                        }

                        if (array_key_exists($member->id, $this->memberScores)) {
                            $this->memberScores[$member->id] += $score;
                        } else {
                            $this->memberScores[$member->id] = $score;
                        }
                    }
                }
            }

            //find highest score
            $highest_score = 0;
            $match_id = null;

            foreach ($this->memberScores as $member_id => $score) {
                if ($score > $highest_score) {
                    $highest_score = $score;
                    $match_id = $member_id;
                }
            }

            $this->match = Member::find($match_id);
        }
    }

    /**
     * Return the member that has been selected
     */
    public function getMember()
    {
        return $this->match;
    }
}
