<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Policy;

class PolicyPosition extends Model
{
    public function getPolicy()
    {
        return Policy::where('id', $this->policy_id)->first();
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
