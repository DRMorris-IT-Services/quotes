<?php

namespace duncanrmorris\quotes\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class clients extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
    ];
}
