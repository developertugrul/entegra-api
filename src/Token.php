<?php

namespace Developertugrul\EntegraApi;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Token extends Model
{
    protected $fillable = ['token', 'expires_at', 'refresh'];

    public function isExpired()
    {
        return Carbon::createFromTimestamp($this->expires_at)->isPast();
    }
}
