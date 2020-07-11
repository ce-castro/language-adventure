<?php

namespace App;

class Category extends Model{
    public function tours(){
        return $this->belongsToMany(Tour::class);
    }
}
