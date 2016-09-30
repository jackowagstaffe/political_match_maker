<?php

namespace App;

use App\PolicyData;

class Policy
{
    protected $number = null;
    protected $text = null;

    protected $policyData = null;

    public function __construct(PolicyData $policy_data)
    {
        $this->policyData = $policy_data;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getText()
    {
        if (is_null($this->text) && !is_null($this->number)) {
            $this->text = $this->policyData->getTextFromNumber($this->number);
        }

        return $this->text;
    }

    public function getTextNoHtml()
    {
        return strip_tags($this->text);
    }
}
