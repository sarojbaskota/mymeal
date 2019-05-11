<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meal_id', 'with_meal', 'restaurant_id', 'date', 'price', 'payment','remarks'
    ];
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getRemarksAttribute($value)
    {
        return ucwords($value);
    }
}
