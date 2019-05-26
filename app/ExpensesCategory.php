<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array expenses_categories
     */
    protected $fillable = [
        'title','user_id',
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
