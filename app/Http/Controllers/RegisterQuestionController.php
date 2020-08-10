<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class RegisterQuestionController extends Controller
{
    public function index() {
        return view('register_question');
    }

    public function upload() {
        request()->validate([
            'question_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'solution_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $question_name = str_replace(' ', '', $_POST['source_of_question']).'_'.$_POST['question_number'];
        $question_image = $question_name.'.'.request()->question_image->getClientOriginalExtension();
        $solution_image = $question_name.'_sol.'.request()->solution_image->getClientOriginalExtension();

        $new_question = new Question;
        $new_question->question_image_name = $question_image;
        $new_question->correct_answer = $_POST['correct_answer'];
        $new_question->solution_image_name = $solution_image;
        $new_question->subject = $_POST['subject'];
        $new_question->source_of_question = $_POST['source_of_question'];
        $new_question->question_number = $_POST['question_number'];
        $new_question->score = $_POST['score'];
        $new_question->type = 0;        // 단순 암기문제인지 계산문제인지
        $new_question->save();

        request()->question_image->move(public_path('questions'), $question_image);
        request()->solution_image->move(public_path('questions'), $solution_image);

        return back()
            ->with('success', '문제등록 완료')
            ->with('image', $question_image);
    }
}
