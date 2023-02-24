<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    use HasFactory;
    
    protected $table = 'movie';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'name', 'description', 'idgenre', 'idformat',
                           'price', 'mainimage', 'discs', 'runtime', 'region',
                           'rating', 'date', 'closedcaptioned', 'language', 'subtitles'];
    
    public function genre() {
        return $this->belongsTo('App\Models\Genre', 'idgenre');
    }
    
    public function format() {
        return $this->belongsTo('App\Models\Format', 'idformat');
    }
    
    public function images() {
        return $this->hasMany('App\Models\Image', 'idmovie');
    }
}
