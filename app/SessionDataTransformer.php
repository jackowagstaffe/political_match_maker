<?php

namespace App;

use App\Policy;

class SessionDataTransformer
{
    protected $outData;

    public function setData($in_data)
    {
        foreach ($in_data as $key => $value) {
            if (substr($key, 0, strlen('policy_')) === 'policy_') {
                $policy_no = substr($key, strlen('policy_'));
                $policy_id = Policy::where('number', $policy_no)->first()->id;

                $agrees = null;

                if ($value === 'agree') {
                    $agrees = true;
                } else if ($value === 'disagree') {
                    $agrees = false;
                } else {
                    throw new Exception('Invalid session data');
                }

                $this->outData[$policy_id] = $agrees;
            }
        }
    }

    public function getData()
    {
        return $this->outData;
    }
}
