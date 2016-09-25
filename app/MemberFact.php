<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberFact extends Model
{
    public function keyStarts($query)
    {
        return substr($this->key, 0, strlen($query)) === $query;
    }

    public function isDreamMp()
    {
        return $this->keyStarts('public_whip_dreammp');
    }

    public function getDreamMpType()
    {
        $type_full = substr($this->key, strlen('public_whip_dreammp'));
        $type = explode('_', $type_full);
        $type = substr($type_full, strlen($type[0]) + 1);

        return $type;
    }

    public function getDreamMpNo()
    {
        $no = substr($this->key, strlen('public_whip_dreammp'));
        $no = explode('_', $no);
        $no = $no[0];

        return $no;
    }
}
