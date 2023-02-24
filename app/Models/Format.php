<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model {
    use HasFactory;
    
    protected $table = 'format';
    
    public $timestamps = false;
    
    protected $fillable = ['id', 'name'];
    
    public function movies() {
        return $this->hasMany('App\Models\Movie', 'idformat');
    }
}
