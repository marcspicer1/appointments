<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'user_id'];

    public function users() {
        return $this->belongsToMany(User::class, 'user_appointment', 'appointment_id');
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
