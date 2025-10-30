<?php

namespace App\Http\Controllers;

use App\Models\CenterChange;
use App\Models\ExamDb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CenterController extends Controller
{
    public function index()
    {
        return view('pages.center.index');
    }

    public function getPaperDetails(Request $request)
    {
        try {
            $user = Auth::user();

            // Use user's center_no directly (ignore the one from request)
            $center_no = $user->center_no;

            $exam_date = $request->exam_date;
            $session_input = strtoupper(trim($request->session));

            // Normalize date (handle dd/mm/yyyy or yyyy-mm-dd)
            $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $exam_date)));

            // Validate session input
            $valid_sessions = ['SESSION-I', 'SESSION-II'];
            if (!in_array($session_input, $valid_sessions)) {
                return response()->json(['subject_code' => '', 'paper_code' => ''], 422);
            }

            // Fetch data for that user's center only
            $data = ExamDb::where('center_no', $center_no)
                ->whereDate('date', $exam_date)
                ->where('session', $session_input)
                ->select('subject_code', 'paper_code')
                ->first();

            return response()->json($data ?? ['subject_code' => '', 'paper_code' => '']);
        } catch (\Exception $e) {
            Log::error('getPaperDetails Error: ' . $e->getMessage(), [
                'request' => $request->all()
            ]);
            return response()->json(['subject_code' => '', 'paper_code' => ''], 500);
        }
    }

    public function getCenterByIndex(Request $request)
    {
        $index_no = $request->index_no;

        // Example: look up student or candidate record by index number
        $candidate = ExamDb::where('index_no', $index_no)->first();

        if ($candidate) {
            return response()->json([
                'center_no' => $candidate->center_no,
            ]);
        } else {
            return response()->json([
                'center_no' => null,
                'message' => 'Index not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'date'          => 'required|date',
            'session'       => 'required',
            'subject_code'  => 'required',
            'paper_code'    => 'required',
            'index_no'      => 'required',
            'center_no'     => 'required',
            'new_center_no'     => 'required',
        ]);

        $centerExists = ExamDb::where('center_no', $request->center_no)
            ->whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->exists();

        if (!$centerExists) {
            throw ValidationException::withMessages([
                'index_no' => 'This Index Number does not exist under the selected Subject and Paper.',
            ]);
        }

        // Check for duplicate absentee record
        $duplicate = CenterChange::whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->where('center_no', $request->center_no)
            ->where('new_center_no', $request->new_center_no)
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'index_no' => 'This candidate has already been marked as absent for the selected paper.',
            ]);
        }

        // Create absentee record
        CenterChange::create([
            'date'         => $request->date,
            'session'      => $request->session,
            'subject_code' => $request->subject_code,
            'paper_code'   => $request->paper_code,
            'index_no'     => $request->index_no,
            'center_no'    => $request->center_no,
            'new_center_no'    => $request->new_center_no,
            'user_id'      => Auth::id(),
        ]);

        // Optional debug check
        dd($request);

        return redirect()
            ->route('center.all')
            ->with('success', 'Candidate Center change successfully.');
    }
}
