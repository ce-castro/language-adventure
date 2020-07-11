<?php

namespace App;

class TourSchedule extends Model
{
    public function tour(){
        return $this->belongsTo(Tour::class);
    }
}
