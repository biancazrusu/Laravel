<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getQuestions(Request $request)
    {
        $requestData = $request->json()->all();

        $estimateId = isset($requestData['estimate_id']) ? $requestData['estimate_id'] : null;
        $estimate   = $this->getEstimate($estimateId);
        $step       = $estimate->responses->unique('question_id')->count() + 2;
        $question   = $estimate->getNextQuestion();
        if ($question) {
            $question->load('answers');
        } else {
            $estimate->status    = Estimate::PENDING;
            $estimate->completed = true;

            try {
                $estimate->save();
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }

        return response()->json(['estimate' => $estimate, 'question' => $question, 'step' => $step]);
    }

    public function getEstimate($estimateId)
    {
        // TODO change
        $user = User::find(1);

        // TODO change to use jwt tokens and get user from that token

        $estimate = Estimate::find($estimateId);
        if (!$estimate) {
            $estimate            = new Estimate;
            $estimate->completed = false;
            $this->addEstimateToUser($estimate, $user->id);
        }

        return $estimate;
    }

    public function addEstimateToUser(Estimate $estimate, $userId)
    {
        $estimate->user_id = $userId;

        try {
            $estimate->save();
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function submitAnswer(Request $request)
    {
        $requestData = $request->json()->all();
        $estimateId  = $requestData['estimate_id'];
        $estimate    = Estimate::find($estimateId);
        $response    = $estimate->addResponse($requestData);

        return response()->json(['response' => $response]);
    }
}
