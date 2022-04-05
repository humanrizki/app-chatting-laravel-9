<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Conversation extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];
    public function user_two_instance(){
        return $this->belongsTo(User::class, 'user_two', 'id');
    }
    public function user_one_instance(){
        return $this->belongsTo(User::class, 'user_one', 'id');
    }
    public function toSearchableArray()
{
    return [
        'user_one'=>$this->user_one,
        'user_two'=>$this->user_two,
    ];
}
}
