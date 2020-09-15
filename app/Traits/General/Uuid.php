<?php

namespace App\Traits\General;

use Illuminate\Support\Str;

trait Uuid{

    public function setUuid(){
        return (string)Str::uuid();
    }
}