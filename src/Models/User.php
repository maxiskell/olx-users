<?php

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "users";

    // Supress the use of created_at and updated_at fields.
    public $timestamps = false;

    // Mass-assignment protection.
    protected $fillable = ['name', 'picture', 'address'];

    public static function validationRules()
    {
        return [
            'name'    => ['required', 'trim', 'max_length' => 100],
            'picture' => ['trim', 'max_length' => 200],
            'address' => ['trim']
        ];
    }
}
