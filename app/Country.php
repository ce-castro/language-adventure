<?php

namespace App;

class Country extends Model
{
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
