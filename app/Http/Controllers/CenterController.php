<?php

namespace App\Http\Controllers;

use App\Models\ExamDb;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index()
    {
        return view('pages.center.index');
    }

    public function getPaperDetails(Request $request)
    {
        $exam_date = date('Y-m-d', strtotime($request->date));
        $session   = strtoupper($request->session);

        $data = ExamDb::whereDate('date', $exam_date)
            ->where('session', $session)
            ->select('subject_code', 'paper_code')
            ->first();

        return response()->json($data ?? ['subject_code' => '', 'paper_code' => '']);
    }

}
