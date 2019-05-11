<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_name',
    ];
     /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    // public function getRestaurantNameAttribute($value)
    // {
    //     return ucwords($value);
    // }
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setRestaurantNameAttribute($value)
    {
        $this->attributes['restaurant_name'] = ucwords($value);
    }
}
