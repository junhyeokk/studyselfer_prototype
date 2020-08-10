<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $table = 'questions';
    protected $fillable = [
        'id',
        'question_image_name',
        'correct_answer',
        'solution_image_name',
        'subject',      // 과목
//        'test_year',
//        'test_month',
        'source_of_question',
        'question_number',
        // 단원과 관련된 데이터 필요
        'score',
        'type',         // 단순 암기문제인지 계산문제인지
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function trials() {
        return $this->hasMany('App\Trial', 'question_id');
    }
}
