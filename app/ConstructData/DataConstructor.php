<?php

namespace App\ConstructData;

use App\Member;
use App\Policy as EloquentPolicy;
use App\PolicyPosition as EloquentPolicyPosition;

class DataConstructor
{
    public function deletePolicies()
    {
        \DB::statement('delete from policy_positions');
        \DB::statement('delete from policies');
    }

    public function createPolicies()
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        //delete all records before starting
        $this->deletePolicies();

        $members = Member::all();
        foreach ($members as $member) {
            $output->writeln("<info>Currently processing " . $member->name .  " (" . $member->id . ")</info>");

            $facts = $member->getDreamMpFacts();
            $policy_positions = [];

            foreach ($facts as $fact) {
                if (!array_key_exists($fact->getDreamMpNo(), $policy_positions)) {
                    $policy_number = $fact->getDreamMpNo();
                    $policy = EloquentPolicy::where('number', $policy_number)->first();

                    if (is_null($policy)) {
                        $construct_policy = \App::make('App\ConstructData\Policy');
                        $construct_policy->setNumber($policy_number);
                        $policy = \App::make('App\Policy');

                        $policy->number = $policy_number;
                        $policy->text = $construct_policy->getText();
                        $policy->save();
                    }

                    $policy_position = \App::make('App\ConstructData\PolicyPosition');
                    $policy_position->setMember($member);
                    $policy_position->setPolicy($policy);

                    $policy_positions[$fact->getDreamMpNo()] = $policy_position;
                }
                switch ($fact->getDreamMpType()) {
                    case 'distance':
                        $policy_positions[$fact->getDreamMpNo()]->setDistance($fact->value);
                        break;
                    case 'absent':
                        $policy_positions[$fact->getDreamMpNo()]->setAbsent($fact->value);
                        break;
                    case 'both_voted':
                        $policy_positions[$fact->getDreamMpNo()]->setBothVoted($fact->value === '1');
                        break;
                    case 'has_strong_vote':
                        $policy_positions[$fact->getDreamMpNo()]->setHasStrongVote($fact->value === '1');
                        break;
                }
            }

            foreach ($policy_positions as $policy_position) {
                $policy_position->createEloquentModel();
            }
        }
    }
}
