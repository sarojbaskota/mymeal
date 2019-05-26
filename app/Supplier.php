<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_name','user_id',
    ];
    
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setRestaurantNameAttribute($value)
    {
        $this->attributes['supplier_name'] = ucwords($value);
    }
    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeuserId($query)
    {
        return $query->where('user_id', \Auth::user()->id);
    }
}
