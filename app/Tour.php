<?php

namespace App;

class Tour extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }

//    public function price(){
//        return $this->hasMany(TourPrice::class);
//    }
//    public function schedulde(){
//        return $this->hasMany(TourSchedule::class);
//    }

    public function pdfconfirmation(){
        return $this->hasMany(PdfConfirmation::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
