<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;


class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'property_id', 'start_date', 'end_date',
        'total', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }

    protected $dates = ['deleted_at'];



    // ------------------------------------
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($booking) {
    //         Notification::create([
    //             'user_id' => $booking->user_id,
    //             'title'   => 'New Booking!',
    //             'message' => "Your booking for property ID {$booking->property_id} has been confirmed.",
    //         ]);
    //     });
    // }
    // ----------------------------------------
}

