<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trial extends Model
{
    use SoftDeletes;
    protected $table = 'trials';
    protected $fillable = [
        'question_id',
        'user_id',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'time_taken',
        'choice',
        'is_correct',
        'nth_trial',      // 이 문제를 몇번째 풀어보는건지
        'test_mode',        // 어떤 모드로 시험을 친건지
        'remember'
    ];

    public function question() {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
