<?php

namespace App;

use \GuzzleHttp\Client as GuzzleClient;
use \App\Member;
use \App\MemberFact;

class TheyWorkForYou
{
    protected $guzzle = null;

    public function __construct(GuzzleClient $client)
    {
        $this->guzzle = $client;
    }

    public function getMps()
    {
        $data = $this->get('getMPs');

        foreach($data as $mp_data) {
            $mp = new Member();
            $mp->name = $mp_data->name;
            $mp->party = $mp_data->party;
            $mp->constituency = $mp_data->constituency;
            $mp->member_id = $mp_data->member_id;
            $mp->person_id = $mp_data->person_id;
            $mp->save();
        }
    }

    public function getMpInfo($command = null)
    {
        $mps = Member::all();
        foreach ($mps as $mp) {
            if (!is_null($command)) {
                $command->info('MP: ' . $mp->id);
            }
            try {
                $data = $this->get('getMPsInfo', ['id' => $mp->person_id]);
                foreach ($data as $object) {
                    foreach ($object as $key => $value) {
                        if (!is_object($value)) {
                            $fact = new MemberFact();
                            $fact->member_id = $mp->id;
                            $fact->key = $key;
                            $fact->value = $value;
                            $fact->save();
                        }
                    }
                }
                $command->info(' --info saved');
            } catch (\Exception $e) {
                $command->error($e->getMessage());
            }
        }
    }

    public function get($api_route, $params = [])
    {
        $url = config('app.they_work_for_you.url') . $api_route;

        $key_param = [
            'key' => env('THEY_WORK_FOR_YOU_API_KEY', null),
        ];
        $all_params = array_merge($params, $key_param);

        $response = $this->guzzle->request('GET', $url, ['query' => $all_params]);
        $data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $response->getBody()->getContents());
        $data = json_decode($data);

        return $data;
    }
}
