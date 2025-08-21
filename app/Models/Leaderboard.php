<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leaderboard extends Model
{

    protected $table = 'leaderboard'; 
     protected $fillable = [
        'user_id', 'word_number', 'score', 'time_taken', 'bonus_used', 'answer_status'
    ];
}
