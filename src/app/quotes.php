<?php

namespace duncanrmorris\quotes\App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class quotes extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quote_id', 'client_id', 'quote_date', 'quote_due', 'status', 'net_total', 'tax_total', 'grand_total',
    ];
}
