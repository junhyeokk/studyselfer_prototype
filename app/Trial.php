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
        'test_mode',        // 시간 제한이 있는 상태로 풀었는지 없는 상태로 풀었는지
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function question() {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
