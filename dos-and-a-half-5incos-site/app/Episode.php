<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public function movies() {
        return $this->belongsToMany("App\Movie");
    }
    public function photo() {
        return $this->belongsTo("App\File", "photo_file_id");
    }
}
