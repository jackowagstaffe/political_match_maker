<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    public function getTextNoHtml()
    {
        return strip_tags($this->text);
    }
}
