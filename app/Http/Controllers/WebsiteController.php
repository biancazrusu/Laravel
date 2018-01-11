<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website = Website::first();
        return view('backend.pages.website', ['currentWebsite' => $website]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $website = new Website;
        return view('backend.pages.website', ['currentWebsite' => $website]);
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

        $website         = new Website;
        $website->text   = $request->text;
        $website->type   = $request->type;
        $website->status = isset($request->status) ? 1 : 0;

        try {
            $website->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Website successfully created']);
        return redirect()->route('websites.edit', ['id' => $website->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        return view('backend.pages.website', ['currentWebsite' => $website]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
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

        $website->text   = $request->text;
        $website->type   = $request->type;
        $website->status = isset($request->status) ? 1 : 0;

        try {
            $website->save();
        } catch (\Exception $e) {
            \Session::flash('exceptions', [$e->getMessage()]);
            return redirect()->back()->withInput();
        }
        \Session::flash('success', ['Website successfully updated']);
        return redirect()->route('websites.edit', ['id' => $website->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function createWebsiteTables(Website $website)
    {
        // Schema::create($website->questions_table, function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('question_id')->nullable();
        //     $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->unsignedInteger('answer_id')->nullable();
        //     $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });

        // Schema::create($website->answers_table, function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('question_id')->nullable();
        //     $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->unsignedInteger('answer_id')->nullable();
        //     $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });

        // Schema::table($website->questions_table, function (Blueprint $table) {
        //     $table->foreign('parent_id')->references('id')->on('answers')->onDelete('set null')->onUpdate('cascade');
        // });

        // Schema::create($website->answers_table . '_' . $website->questions_table, function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('question_id')->nullable();
        //     $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
        //     $table->unsignedInteger('answer_id')->nullable();
        //     $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        // });
    }
}
