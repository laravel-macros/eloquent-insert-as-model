<?php

namespace LaravelMacros\Eloquent\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
    protected $casts = [
        'options'  => 'json',
        'shelf'    => 'collection',
        'username' => 'string',
    ];

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = Str::slug($value);
    }
}
