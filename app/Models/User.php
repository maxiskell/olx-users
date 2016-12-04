<?php

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "users";

    // Mass-assignment protection.
    protected $fillable = ['name', 'picture', 'address'];
}
