<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\EmailToSend;
use App\Http\Controllers\Controller;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $userId               = Auth::user()->id;
            $estimateNotCompleted = Estimate::where([
                ['user_id', '=', $userId],
                ['completed', '=', 0],
            ])
                ->orderby('id', 'DESC')
                ->first();
            if ($estimateNotCompleted == null) {
                $estimate          = new Estimate;
                $estimate->user_id = Auth::user()->id;
                $estimate->status  = Estimate::NOT_COMPLETED;
                try {
                    $estimate->save();
                } catch (\Exception $e) {
                    return redirect()->back()->withInput();
                }
                return redirect()->route('calculate.show', ['id' => $estimate->id]);
            } else {
                return redirect()->route('calculate.show', ['id' => $estimateNotCompleted->id]);
            }

        }
        return redirect()->route('calculate.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //remove this
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //remove this
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        // if estimate exists and is finished show the final message or summary
        if ($estimate->user_id == Auth::user()->id && !$estimate->completed) {
            return view('frontend.pages.api-test', ['estimate' => $estimate]);
        }
        return redirect()->route('calculate.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimate $estimate)
    {
        //remove this
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, $id)
    {
        $estimate         = Estimate::find($id);
        $data['budget']   = $request->budget;
        $estimate->budget = $data['budget'];
        $estimate->fill($data);
        $estimate->save();
        $dataEmail['subject'] = '[Lori] Estimate for your application!';
        $dataEmail['link']    = 'http://lori-back.icoldo.com/public/history/estimate/' . $estimate->id;
        $dataEmail['name']    = $request->username;
        $dataEmail['email']   = Auth::user()->email;
        $sendEmail            = new EmailToSend();
        $sendEmail->sendEmail($dataEmail);

        return redirect()->route('estimateSucces');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        // remove this
    }

    /**
     * Show the estimate
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function finalStep(Estimate $estimate)
    {
        return view('frontend.pages.estimate-price', ['estimate' => $estimate]);
    }

    /**
     * Show the summary
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function summary(Estimate $estimate)
    {
        return view('frontend.pages.estimate-summary', ['estimate' => $estimate]);
    }

    /**
     * Handle the requested proposal
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function getProposal(Estimate $estimate)
    {
        return view('frontend.pages.estimate-proposal', ['estimate' => $estimate]);
    }
}
