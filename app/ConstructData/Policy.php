<?php

namespace App\ConstructData;

use App\PolicyData;

class Policy
{
    protected $number = null;
    protected $text = null;
    protected $eloquentModel = null;

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

    public function getEloquentModel()
    {
        return $this->eloquentModel;
    }

    public function createEloquentModel()
    {
        if (is_null($this->eloquentModel)) {
            $policy = App::make('App\Policy');
            $policy->number = $this->number;
            $policy->text = $this->text;
            $policy->save();

            $this->eloquentModel = $policy;
        }

        return $this->eloquentModel;
    }
}
