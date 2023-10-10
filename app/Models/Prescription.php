<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    const QUOTATION_CREATE =[
        'QUOTATION_CREATE' => 1,
        'QUOTATION_NOT_CREATE' => 0,
    ];
    const QUOTATION_ACCEPT =[
        'QUOTATION_ACCEPT' => 1,
        'QUOTATION_NOT_ACCEOT' => 2,
    ];
    const QUOTATION_MAIL =[
        'QUOTATION_SEND' => 1,
        'QUOTATION_NOT_SEND' => 0,
    ];

    protected $fillable = [
        'user_id',
        'delivery_address',
        'delivery_time',
        'note',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'status',
        'quotation_create',
        'quotation_accept',
        'quotation_mail'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
