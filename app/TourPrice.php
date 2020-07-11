<?php

namespace App;

class TourPrice extends Model
{
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
