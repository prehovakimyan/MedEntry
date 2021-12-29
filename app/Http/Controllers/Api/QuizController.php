<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizTempAnswer;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getQuizeById($id,$user_token = null) {
        $quize = Quiz::find($id);

        if(isset($user_token) && $user_token != '') {
            $QuizTempAnswer = QuizTempAnswer::where('token', '=', $user_token)->where('question_id', '=', $id)->first();

            if($QuizTempAnswer) {
                $response['user_answer'] = $QuizTempAnswer->answer;
            }
        }

        $response = array();
        $response['question_id'] = $quize->id;
        $response['question'] = $quize->question;
        $response['answer'] = $quize->answer;
        $response['percentile'] = "0/10";

        if($id == 1) {
            $response['token'] = $token = sha1(mt_rand(1, 90000) . 'SALT');
            $response['save_answer_url'] = url('/').'/api/v1/quiz/'.($id + 1);
        } else {
            if($id == 10) {
                $response['save_answer_url'] = url('/').'/api/v1/save-quiz/'.$user_token;
            } else {
                $response['save_answer_url'] = url('/').'/api/v1/quiz/'.($id + 1);
            }
            $response['prev_question_url'] = url('/').'/api/v1/quiz/'.($id - 1).'/'.$user_token;
            $response['token'] = $user_token;
        }

        return $response;
    }

    public function setQuizeAnswer(Request $request, $user_token) {
        $id = 10;
        $quize = Quiz::find($id);
        $checkQuizAnswer = QuizTempAnswer::where('token', '=', $user_token)->where('question_id', '=', $id)->first();
        if(!$checkQuizAnswer) {
            $quizTempAnswer = new QuizTempAnswer();
        } else {
            $quizTempAnswer = $checkQuizAnswer;
        }

        $prevAnswer = QuizTempAnswer::where('token', '=', $user_token)->where('question_id', '=', $id -1)->first();

        $prevscore = $prevAnswer ? $prevAnswer->score : 0;
        if($request->answer == $quize->answer){
            $score = $prevscore + 1;
        } else {
            $score = $prevscore;
        }

        $quizTempAnswer->score = $score;
        $quizTempAnswer->answer = $request->answer;
        $quizTempAnswer->question_answer = $quize->answer;
        $quizTempAnswer->token = $request->token;
        $quizTempAnswer->question_id = $id;
        $quizTempAnswer->save();

        $quizAttempt = new QuizAttempt();
        $quizAttempt->score = $score;
        $percentile = $score / 10 * 100;
        $quizAttempt->percentile = $percentile;
        $quizAttempt->save();
        return true;
    }

    public function quizTempAnswer(Request $request, $id){
        $quize = Quiz::find($id);
        $checkQuizAnswer = QuizTempAnswer::where('token', '=', $request->token)->where('question_id', '=', $id)->first();
        if(!$checkQuizAnswer) {
            $quizAttempt = new QuizTempAnswer();
        } else {
            $quizAttempt = $checkQuizAnswer;
        }

        $prevAnswer = QuizTempAnswer::where('token', '=', $request->token)->where('question_id', '=', $id -1)->first();

        $prevscore = $prevAnswer ? $prevAnswer->score : 0;
        if($request->answer == $quize->answer){
            $score = $prevscore + 1;
        } else {
            $score = $prevscore;
        }

        $quizAttempt->score = $score;
        $quizAttempt->answer = $request->answer;
        $quizAttempt->question_answer = $quize->answer;
        $quizAttempt->token = $request->token;
        $quizAttempt->question_id = $id;
        $quizAttempt->save();

        return url('/').'/api/v1/quiz/'.($id + 1).'/'.$request->token;
    }
}
