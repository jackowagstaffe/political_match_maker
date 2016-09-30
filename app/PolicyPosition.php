<?php

namespace App;

use App\Policy;

class PolicyPosition
{
    protected $policy = null;
    protected $absent = null;
    protected $distance = null;
    protected $bothVoted = null;
    protected $hasStrongVote = null;

    public function setPolicy(Policy $policy)
    {
        $this->policy = $policy;
    }

    public function setAbsent($absent)
    {
        $this->absent = $absent;
    }

    public function setDistance($distance)
    {
        $this->distance = floatval($distance);
    }

    public function setBothVoted($both_voted)
    {
        $this->bothVoted = $both_voted;
    }

    public function setHasStrongVote($has_strong)
    {
        $this->hasStrongVote = $has_strong;
    }

    public function getPolicy()
    {
        return $this->policy;
    }

    public function getPolicyText()
    {
        return $this->policy->getText();
    }

    public function getPolicyTextNoHtml()
    {
        return $this->policy->getTextNoHtml();
    }

    public function getAbsent()
    {
        return $this->absent;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function getBothVoted()
    {
        return $this->bothVoted;
    }

    public function  getHasStrongVote()
    {
        return $this->hasStrongVote;
    }

    public function getPositonText()
    {
        if ($this->distance < 0.4) {
            return 'agrees';
        } else if ($this->distance > 0.6) {
            return 'disagrees';
        }

        return 'mixed';
    }

    /**
     *  Return a number between 0 and 50 of how much the politician agrees with the policy
     */
    public function getAgreement()
    {
        if ($this->distance < 0.5) {
            return (0.5 - $this->distance) * 100;
        }

        return 0;
    }

    /**
     * Return a number between 0 and 50 of how much the politician disagrees with the policy
     */
    public function getDisagreement()
    {
        if ($this->distance > 0.5) {
            return ($this->distance - 0.5) * 100;
        }

        return 0;
    }
}
