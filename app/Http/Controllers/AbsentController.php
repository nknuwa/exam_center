<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Centers;


class AbsentController extends Controller
{
    public function index() {
        $response['centers'] = Centers::select('center_no')->distinct()->get();
        return view('pages.absents.index')->with($response);;
    }

    public function getPaperDetails(Request $request)
    {
        try {
            $center_no = trim($request->center_no);
            $exam_date = $request->exam_date;
            $session_input = strtoupper(trim($request->session));

            // Auto-correct session
            $valid_sessions = [
                'MORNING' => ['MORNIN', 'MORNING'],
                'AFTERNOON' => ['AFTERNON', 'AFTERNOON']
            ];

            $session = $session_input;
            foreach ($valid_sessions as $key => $aliases) {
                if (in_array($session_input, $aliases)) {
                    $session = $key;
                    break;
                }
            }

            $data = DB::table('centers')
                ->where('center_no', $center_no)
                ->whereDate('date', $exam_date)
                ->where('session', $session)
                ->select('subject_code', 'paper_code')
                ->first();

            return response()->json($data ?? ['subject_code' => '', 'paper_code' => '']);
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('getPaperDetails Error: '.$e->getMessage(), [
                'request' => $request->all()
            ]);
            return response()->json(['subject_code' => '', 'paper_code' => ''], 500);
        }
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'center_no' => 'required',
            'date' => 'required|date',
            'session' => 'required',
            'subject_no' => 'required',
            'paper_code' => [
                'required',
            ],
            'index_no'   => 'required|digits:8',
        ]);


        AbsentCandidates::create([
            'center_no'  => $request->center_no,
            'date' => $request->date,
            'session' => $request->session,
            'subject_no' => $request->subject_no,
            'paper_code' => $request->paper_code,
            'index_no'   => $request->index_no,

        ]);

        session()->flash('success', 'Index added successfully!');
        return redirect()->route('absentees.all');
    }

}
