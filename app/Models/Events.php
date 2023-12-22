<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sessions;

class Events extends Model
{
    protected $table = "events";
    protected $guarded = [];

    public function sessions() {

        return $this->hasMany(Sessions::class, 'event_id');
    }
}
