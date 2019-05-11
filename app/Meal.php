<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }
}
