<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    function isAdmin() {
        return $this->type == 'admin';
    }

    function isUser() {
        return $this->type == 'user' || $this->type == 'admin';
    }
    
    function deleteUser() {
        $result = false;
        try {
            $this->delete();
            $result = true;
        } catch(\Exception $e) {
        }
        return $result;
    }

    function storeUser() {
        try {
            $this->save();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    function updateUser() {
        try {
            $this->update();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}
