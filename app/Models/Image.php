<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    use HasFactory;
    
    protected $table = 'image';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'name', 'idmovie'];
    
    public function movie() {
        return $this->belongsTo('App\Models\Movie', 'idmovie');
    }
}
