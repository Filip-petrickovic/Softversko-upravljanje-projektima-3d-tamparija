<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = ['username', 'email', 'password'];

    protected $hidden = ['password'];

    public function getUsernameAttribute($value) {
        return $this->attributes['username'];
    }

    public function getEmailAttribute($value) {
        return $this->attributes['email'];
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'kreator_id');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->attributes['password']);
    }
}