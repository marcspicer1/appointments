<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAppointment extends Model
{
    protected $table = 'user_appointment';
    public function appointment() {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
