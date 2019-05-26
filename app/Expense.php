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
        'expenses_category_id', 'user_id','supplier_id', 'date', 'amount', 'payment','remarks'
    ];
    protected $dates = ['date'];
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
