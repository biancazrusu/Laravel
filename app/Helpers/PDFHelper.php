<?php

namespace App\Helpers;

use App\Models\Estimate;
use App\Models\Question;
use DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;


class PDFHelper
{

    /**
     * Creating a pdf from the contents of a file.
     *
     * @param $pathFile
     * @param $options
     * @return \Dompdf\Dompdf
     */

    public static function createPDFFromFile($pathFile, $options)
    {
        $html = file_get_contents($pathFile);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($options['size'], $options['orientation']);
        $dompdf->render();

        return $dompdf;
    }

    /**
     * Creating a pdf
     *
     * @param hmtl
     * @param options
     * @return \Dompdf\Dompdf pdf
     */

    public static function createPDF($html, $options)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($options['size'], $options['orientation']);
        $dompdf->render();

        return $dompdf;
    }

    /**
     * Save the pdf on the local sistem
     *
     * @param \Dompdf\Dompdf pdf
     * @param path
     * @param name
     * @return pathFile
     */

    public static function savePDF(Dompdf $pdf, $path, $name)
    {
        $output   = $pdf->output();
        $pathFile = $path . '/' . $name . '.pdf';
        file_put_contents($pathFile, $output);

        return $pathFile;
    }

    /**
     * Shows an pdf for the istoric of the estimate
     */

    public static function printAllIstoric($estimateId = null)
    {
        if (Auth::check()) {
            $estimatesAll = DB::table('estimates')
                            ->where('user_id', Auth::user()->id)
                            ->orderby('updated_at', 'DESC')
                            ->get();
            $logged       = 1;
        }
        $estimates = [[]];
        $questions = [[]];
        $answers   = [];
        $questionId = 1;

        foreach ($estimatesAll as $key => $value) {
            $total     = 0;
            $estimate  = Estimate::find($value->id);
            $responses = $estimate->responses;
            $k = -1;
            foreach ($responses as $response) {
                $k++;
                if($questionId != $response->question->id)
                    $k = 0;
                $questionId                         = $response->question->id;
                $answers[$questionId][$k]['id']            = $response->answer;
                $answers[$questionId][$k]['price'] = $response->current_price;
                $questions[$questionId]['question'] = $response->question;
                $total                              = $total + $response->current_price;
            }
            unset($questions[0]);
            foreach ($questions as $key => $question) {
                $questions[$key]['answers'] = $answers[$key];
            }
            $estimates[$value->id]['totalPrice'] = $total;
            $estimates[$value->id]['questions']  = $questions;
            $questions                           = [];
            $answers                             = [];
            $estimates[$value->id]['text']       = $value;
            $price                               = [];
            $price['totalPrice']                 = 0;
        }
        unset($estimates[0]);

        // dump($estimates);
        if ($estimateId == 0) {
            return $estimates;
        } else {
            if(isset($estimates[$estimateId]))
                return $estimates[$estimateId];
            else
                return '403';
        }
    }

    public static function printPdf($estimates)
    {
        $pdf = PDFHelper::createPDF(view('frontend.istoricTemplate', [
            'estimates' => $estimates,
        ]), ['size' => 'A4', 'orientation' => 'portrait']);
        $pdf->stream('estimate.pdf', ['Attachment' => false]);
    }

}
