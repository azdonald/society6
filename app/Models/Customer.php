<?php


namespace App\Models;


class Customer extends \Illuminate\Database\Eloquent\Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'address', 'city', 'state', 'postcode', 'country'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
