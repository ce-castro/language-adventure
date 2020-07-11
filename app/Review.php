<?php

namespace App;

class Review extends Model
{
    public function tours(){
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
