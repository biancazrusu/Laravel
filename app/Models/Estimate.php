<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = ['budget'];
    protected $hidden   = ['responses'];

    const PENDING       = 0;
    const CANCELED      = 1;
    const CONTACTED     = 2;
    const FINISHED      = 3;
    const NOT_COMPLETED = 4;

    public function getNextQuestion()
    {
        $responses = $this->responses;
        if (count($responses)) {
            $questionCollection = collect();

            $allQuestionIds       = [];
            $allQuestionPositions = [];
            $respondedQuestionIds = [];
            $respondedQuestionPos = [];
            foreach ($responses as $response) {
                $answer                 = $response->answer;
                $questionId             = $response->question->id;
                $respondedQuestionIds[] = $questionId;
                $position               = $response->question->position;
                $respondedQuestionPos[] = $position;
                $questions              = $answer->getQuestionsWithAnswers();
                foreach ($questions as $question) {
                    $allQuestionIds[]       = $question->id;
                    $allQuestionPositions[] = $question->position;
                }
            }

            $questionsDiff = array_diff(array_unique($allQuestionIds), array_unique($respondedQuestionIds));
            $questionsDiff = array_values($questionsDiff);

            $positionDiff = array_diff(array_unique($allQuestionPositions), array_unique($respondedQuestionPos));
            asort($positionDiff);
            $positionDiff = array_values($positionDiff);

            if (empty($positionDiff)) {
                return false;
            }

            if (isset($questionsDiff[0]) && isset($positionDiff[0])) {
                $nextQuestionId       = $questionsDiff[0];
                $nextQuestionPosition = $positionDiff[0];
                return Question::where('position', $nextQuestionPosition)->first();
            }
            return false;
        }
        return Question::where('position', 1)->first();

    }

    public function responses()
    {
        return $this->hasMany('App\Models\EstimateResponse', 'estimate_id', 'id');
    }

    public function addResponse($responseData = array())
    {
        if (!empty($responseData) && $this->testResponses($responseData)) {
            $responses = [];
            foreach ($responseData['answers'] as $answer) {
                $responses[] = new EstimateResponse([
                    'question_id'   => $responseData['question_id'],
                    'answer_id'     => $answer[0],
                    'current_price' => $answer[1]]);
            }
            $this->responses()->saveMany($responses);

            return true;
        }
        return false;

    }

    protected function testResponses($responseData)
    {
        $question = Question::find($responseData['question_id']);
        if ($question) {
            $answersId    = [];
            $answersArray = $question->answers->pluck('id')->toArray();
            foreach ($responseData['answers'] as $answer) {
                $answersId[] = $answer[0];
            }
            return !array_diff($answersId, $answersArray);
        }
        return false;
    }

    public function getTotalPrice()
    {
        $responses  = $this->responses;
        $totalPrice = 0;
        foreach ($responses as $response) {
            $answer = $response->answer;
            $totalPrice += $answer->price;
        }

        return $totalPrice;
    }

    public function getStep()
    {
        $responses = $this->responses;
        $step      = $responses->count() + 1;

        return $step;
    }
}
