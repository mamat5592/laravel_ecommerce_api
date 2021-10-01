<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'reply',
        'user_id',
        'three_d_model_id'
    ];

    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function three_d_model(){
        return $this->belongsTo(\App\Models\ThreeDModel::class);
    }
}
