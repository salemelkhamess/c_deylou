<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_id',
        'voter_hash',
        'ip_address'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    /**
     * Génère un hash unique pour identifier le votant
     */
    public static function generateVoterHash()
    {
        $ip = request()->ip();
        $userAgent = request()->userAgent();
        $random = microtime() . rand(1000, 9999);

        return Hash::make($ip . $userAgent . $random);
    }

    /**
     * Vérifie si un votant a déjà voté pour une question
     */
    public static function hasVoted($questionId, $voterHash = null)
    {
        if (!$voterHash && request()->hasCookie('voter_hash')) {
            $voterHash = request()->cookie('voter_hash');
        }

        if (!$voterHash) {
            return false;
        }

        return static::where('question_id', $questionId)
            ->where('voter_hash', $voterHash)
            ->exists();
    }
}
