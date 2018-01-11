<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Question;
use Illuminate\Http\Request;
use App\User;

class EstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allEstimates          = Estimate::all();
        $completedEstimates    = Estimate::where('completed', true)->get();
        $notCompletedEstimates = Estimate::where('completed', false)->get();
        return view('backend.pages.estimates',[
            'allEstimates'          => $allEstimates,
            'completedEstimates'    => $completedEstimates,
            'notCompletedEstimates' => $notCompletedEstimates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estimate  $stimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimate $estimate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate $estimate)
    {
        $estimate->status = $request->status;
        try {
            $estimate->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['The estimate has been successfully updated !']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string  $estimate
     * @param string $question
     * @return \Illuminate\Http\Response
     */
    public function estimateEdit($estimate, $question = null)
    {
        $estimate  = Estimate::find($estimate);
        $user      = User::find($estimate->user_id);
        $responses = $estimate->responses;

        $questions           = [];
        $answers             = [];
        $price               = [];
        $price['totalPrice'] = 0;
        $currentQuestion     = new Question();

        if ($responses->isEmpty()) {
            \Session::flash('exceptions', ['The estimate is empty!']);
            return redirect()->route('estimates.index');
        }

        foreach ($responses as $key => $response) {
            $questionId                      = $response->question->id;
            $questions[$questionId]          = $response->question;
            $answerId                        = $response->answer->id;
            $answers[$questionId][$answerId] = $response->answer;
            if (!isset($price[$questionId])) {
                $price[$questionId] = 0;
            }

            $price[$questionId]  += $answers[$questionId][$answerId]->price;
            $price['totalPrice'] += $answers[$questionId][$answerId]->price;
        }


        if (isset($question) && array_key_exists($question, $questions)) {
            $currentQuestion = $questions[$question];
        } else {
            reset($questions);
            $first_key = key($questions);
            $currentQuestion = $questions[$first_key];
        }

        return view('backend.pages.estimate', [
            'estimate'        => $estimate,
            'questions'       => $questions,
            'answers'         => $answers,
            'currentQuestion' => $currentQuestion,
            'prices'          => $price,
            'currentUser'     => $user,
        ]);
    }
}
