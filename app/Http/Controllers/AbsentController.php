<?php

namespace App\Http\Controllers;

use App\Models\ExamDb;
use App\Models\Centers;
use Illuminate\Http\Request;
use App\Models\AbsentCandidates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AbsentController extends Controller
{
    /**
     * Show Absentees index page
     */
    public function index()
    {
        $response['exam_db'] = ExamDb::select('center_no')->distinct()->get();
        $response['absentees'] = AbsentCandidates::where('user_id', Auth::id())->get();
        return view('pages.absents.index')->with($response);
    }

    public function getPaperDetails(Request $request)
    {
        try {
            $user = Auth::user();
            $center_no = $user->center_no;

            $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->exam_date)));
            $session_input = strtoupper(trim($request->session));

            $valid_sessions = ['SESSION-I', 'SESSION-II'];
            if (!in_array($session_input, $valid_sessions)) {
                return response()->json(['subjects' => []], 422);
            }

            // Fetch all subjects for this center/date/session
            $subjects = ExamDb::where('center_no', $center_no)
                ->whereDate('date', $exam_date)
                ->where('session', $session_input)
                ->select('subject_code', 'paper_code')
                ->distinct()
                ->get();

            return response()->json(['subjects' => $subjects]);
        } catch (\Exception $e) {
            Log::error('getPaperDetails Error: ' . $e->getMessage(), [
                'request' => $request->all()
            ]);
            return response()->json(['subjects' => []], 500);
        }
    }


    // public function getPaperDetails(Request $request)
    // {
    //     try {
    //         $user = Auth::user();

    //         // Use user's center_no directly (ignore the one from request)
    //         $center_no = $user->center_no;

    //         $exam_date = $request->exam_date;
    //         $session_input = strtoupper(trim($request->session));

    //         // Normalize date (handle dd/mm/yyyy or yyyy-mm-dd)
    //         $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $exam_date)));

    //         // Validate session input
    //         $valid_sessions = ['SESSION-I', 'SESSION-II'];
    //         if (!in_array($session_input, $valid_sessions)) {
    //             return response()->json(['subject_code' => '', 'paper_code' => ''], 422);
    //         }

    //         // Fetch data for that user's center only
    //         $data = ExamDb::where('center_no', $center_no)
    //             ->whereDate('date', $exam_date)
    //             ->where('session', $session_input)
    //             ->select('subject_code', 'paper_code')
    //             ->first();

    //         return response()->json($data ?? ['subject_code' => '', 'paper_code' => '']);
    //     } catch (\Exception $e) {
    //         Log::error('getPaperDetails Error: ' . $e->getMessage(), [
    //             'request' => $request->all()
    //         ]);
    //         return response()->json(['subject_code' => '', 'paper_code' => ''], 500);
    //     }
    // }


    /**
     * Store absent candidate record
     */
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'center_no'     => 'required',
            'date'          => 'required|date',
            'session'       => 'required',
            'subject_code'  => 'required',
            'paper_code'    => 'required',
            'index_no'      => 'required',
        ]);

        $candidateExists = ExamDb::where('center_no', $request->center_no)
            ->whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->exists();

        if (!$candidateExists) {
            throw ValidationException::withMessages([
                'index_no' => 'This Index Number does not exist under the selected Subject and Paper.',
            ]);
        }

        // Check for duplicate absentee record
        $duplicate = AbsentCandidates::where('center_no', $request->center_no)
            ->whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'index_no' => 'This candidate has already been marked as absent for the selected paper.',
            ]);
        }

        // Create absentee record
        AbsentCandidates::create([
            'center_no'    => $request->center_no,
            'date'         => $request->date,
            'session'      => $request->session,
            'subject_code' => $request->subject_code,
            'paper_code'   => $request->paper_code,
            'index_no'     => $request->index_no,
            'user_id'      => Auth::id(),
        ]);

        // Optional debug check
        // dd($absentees);

        return redirect()
            ->route('absentees.all')
            ->with('success', 'Absent candidate added successfully.');
    }
}
