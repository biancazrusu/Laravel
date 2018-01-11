<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Validator;
use DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('position')->get();
        return view('backend.pages.questions', ['questions' => $questions ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question;
        return view('backend.pages.question', ['currentQuestion' => $question]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'text' => 'required|max:255',
            'type' => 'required|numeric|max:25',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $question             = new Question;
        $question->text       = $request->text;
        $question->type       = $request->type;
        $question->website_id = getWebsiteId();
        $question->status     = isset($request->status) ? 1 : 0;
        $question->position   = $request->position;

        $lastPosition = Question::all()->count();

        if($request->position <= $lastPosition && $request->position > 0){
            DB::table('questions')
                ->where('position','>=',$request->position)
                ->increment('position');
        } else {
            $question->position = $lastPosition + 1;
        }

        try {
            $question->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Question successfully created']);
        return redirect()->route('questions.edit', ['id' => $question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->question as $key => $value) {
            $question = Question::find($value);
            DB::table('questions')
                ->where('position','>=',$question->position)
                ->decrement('position');
            try {
                foreach ($question->answers as $answer) {
                    $answer->delete();
                }
                $question->delete();
            } catch (\Exception $e) {
                \Session::flash('exceptions', [$e->getMessage()]);
                return redirect()->back()->withInput();
            }
        }
        \Session::flash('success', ['Questions successfully deleted']);
        return redirect()->route('questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $questions = Question::orderBy('position')->get();
        return view('backend.pages.question', ['currentQuestion' => $question, 'questions' => $questions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $rules = [
            'text' => 'required|max:255',
            'type' => 'required|numeric|max:25',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $lastPosition = Question::all()->count();

        if($request->position >= 1 && $request->position <= $lastPosition){
            if($question->position > $request->position){
                DB::table('questions')
                    ->whereBetween('position', [$request->position, $question->position])
                    ->increment('position');
            } else if($question->position < $request->position) {
                DB::table('questions')
                    ->whereBetween('position', [$question->position, $request->position])
                    ->decrement('position');
            }

            $question->position = $request->position;

        }

        $question->text     = $request->text;
        $question->type     = $request->type;
        $question->status   = isset($request->status) ? 1 : 0;

        try {
            $question->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }

        \Session::flash('success', ['Question successfully updated']);
        return redirect()->route('questions.edit', ['id' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question)
    {
        $question = Question::find($question);
        DB::table('questions')
            ->where('position','>=',$question->position)
            ->decrement('position');
        try {
            foreach ($question->answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Question successfully deleted']);
        return redirect()->route('questions.index');
    }
}
