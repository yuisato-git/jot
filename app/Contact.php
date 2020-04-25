<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use Searchable;

    //Disable mass assignment protection
    protected $guarded = [];

    //A property should be an instance of Date class
     protected $dates = ['birthday'];

    public function path()
    {
        return '/contacts/'.$this->id;
    }

    public function scopeBirthdays($query)
    {
        return $query->whereMonth('birthday', now()->format('m'));
    }

    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
