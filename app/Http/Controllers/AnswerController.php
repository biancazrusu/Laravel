<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rules = [
            'text'  => 'required|max:255',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $answer = new Answer;

        $currentPosition = DB::table('answers')
            ->where('parent_id', '=', $request->parent_id)
            ->count();
        $answerPosition = $currentPosition + 1;

        if ($request->position < $answerPosition) {
            DB::table('answers')
                ->where([
                    ['parent_id', '=', $request->parent_id],
                    ['position', '>=', $request->position],
                ])
                ->increment('position');
            $answer->position = $request->position;
        } else {
            $answer->position = $answerPosition;
        }

        $answer->text      = $request->text;
        $answer->parent_id = $request->parent_id;
        $answer->price     = $request->price;

        $answer->status = isset($request->status) ? 1 : 0;
        if ($request->hasFile('image')) {
            $photo       = $answer->id . '_' . $request->parent_id . '_' . $request->file('image')->getClientOriginalName();
            $destination = base_path() . '/public/design/images';
            if (isset($answer->image)) {
                File::delete($destination . '/' . $answer->image);
            }

            $request->file('image')->move($destination, $photo);
            $answer->image = $photo;
        } else {
            $answer->image = 'default-image.png';
        }

        try {
            $answer->save();
            if (isset($request->child_questions)) {
                $answer->children()->sync(explode(',', $request->child_questions));
            }
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Answer successfully created']);
        return redirect()->route('answers.edit', ['id' => $answer->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsAnswer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsAnswer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        \Session::flash('focusQuestion', true);
        return redirect()->route('questions.edit', ['id' => $answer->parent_id])->with(['lastEditedAnswer' => $answer->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $rules = [
            'text'  => 'required|max:255',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $photo       = $answer->id . '_' . $request->parent_id . '_' . $request->file('image')->getClientOriginalName();
            $destination = base_path() . '/public/design/images';
            if (isset($answer->image)) {
                File::delete($destination . '/' . $answer->image);
            }

            $request->file('image')->move($destination, $photo);
            $answer->image = $photo;
        }

        if ($request->position < $answer->position) {
            DB::table('answers')
                ->where('parent_id', '=', $answer->parent_id)
                ->whereBetween('position', array($request->position, $answer->position))
                ->increment('position');
        } else if ($request->position > $answer->position) {
            DB::table('answers')
                ->where('parent_id', '=', $answer->parent_id)
                ->whereBetween('position', array($answer->position, $request->position))
                ->decrement('position');
        }

        $answer->text      = $request->text;
        $answer->parent_id = $request->parent_id;
        $answer->price     = $request->price;
        $answer->position  = $request->position;
        $answer->status    = isset($request->status) ? 1 : 0;

        try {
            $answer->save();
            if (isset($request->child_questions)) {
                $answer->children()->sync(explode(',', $request->child_questions));
            }

        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Answer successfully updated']);
        return redirect()->route('answers.edit', ['id' => $answer->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        DB::table('answers')
            ->where([
                ['parent_id', '=', $answer->parent_id],
                ['position', '>', $answer->position],
            ])
            ->decrement('position');
        $destination = base_path() . '/public/design/images';
        if (isset($answer->image)) {
            File::delete($destination . '/' . $answer->image);
        }

        try {
            $answer->delete();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Answer successfully deleted']);
        return redirect()->back();
    }
}
