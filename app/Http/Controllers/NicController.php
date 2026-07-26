<?php

namespace App\Http\Controllers;
use App\Models\ExamDb;
use App\Models\NicChanges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exports\NicExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class NicController extends Controller
{
     public function index()
    {
        $response['exam_db'] = ExamDb::select('center_no')->distinct()->get();
        $response['nicChanges'] = NicChanges::where('user_id', Auth::id())->get();
        return view('pages.nic.index')->with($response);
    }

    public function All()
    {
        $response['nicChanges'] = NicChanges::all();
        return view('pages.nic.all')->with($response);
    }

    public function getPaperDetails(Request $request)
    {
        try {
            $user = Auth::user();

            $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->exam_date)));

            $session_input = strtoupper(trim($request->session));



            $valid_sessions = ['SESSION-I', 'SESSION-II'];
            if (!in_array($session_input, $valid_sessions)) {
                return response()->json(['subjects' => []], 422);
            }

            $query = ExamDb::whereDate('date', $exam_date)
                ->where('session', $session_input);

            // 🔥 Important: Handle Admin & Super Admin
            if (!$user->hasAnyRole(['super-admin', 'admin'])) {
                $query->where('center_no', $user->center_no);
            }

            $subjects = $query
                ->select('subject_code', 'paper_code')
                ->distinct()
                ->get();

            return response()->json(['subjects' => $subjects]);
        } catch (\Exception $e) {

            Log::error('getPaperDetails Error: ' . $e->getMessage());

            return response()->json(['subjects' => []], 500);
        }
    }

    public function getCandidate(Request $request)
{
    $candidate = ExamDb::where('center_no', $request->center_no)
        ->whereDate('date', $request->date)
        ->where('session', $request->session)
        ->where('subject_code', $request->subject_code)
        ->where('index_no', $request->index_no)
        ->first();

    if (!$candidate) {
        return response()->json([
            'status' => false
        ]);
    }

    return response()->json([
        'status'     => true,
        'paper_code' => $candidate->paper_code,
        'exam_id'    => $candidate->exam_id,
    ]);
}

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
            'old_nic'       => 'required',
            'new_nic'       => 'required',
        ]);

        $candidateExists = ExamDb::where('center_no', $request->center_no)
            ->whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->where('exam_id', $request->exam_id)
            ->exists();

        if (!$candidateExists) {
            throw ValidationException::withMessages([
                'index_no' => 'This Index Number does not exist under the selected Subject and Paper.',
            ]);
        }

        // Check for duplicate absentee record
        $duplicate = NicChanges::where('center_no', $request->center_no)
            ->whereDate('date',  $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->where('exam_id', $request->exam_id)
            ->exists();

        if ($duplicate) {
            throw ValidationException::withMessages([
                'index_no' => 'This candidate has already been marked as absent for the selected paper.',
            ]);
        }

        // Create nic record
        NicChanges::create([
            'center_no'    => $request->center_no,
            'date'         => $request->date,
            'session'      => $request->session,
            'subject_code' => $request->subject_code,
            'paper_code'   => $request->paper_code,
            'index_no'     => $request->index_no,
            'exam_id'      => $request->exam_id,
            'old_nic'     => $request->old_nic,
            'new_nic'     => $request->new_nic,
            'reason'     => $request->reason,
            'user_id'      => Auth::id(),
        ]);

        // Optional debug check
        //dd($absentees);

        return redirect()
            ->back()
            ->with('success', 'Candidate NIC Change successfully.');

        // return redirect()
        //     ->route('absentees.all')
        //     ->with('success', 'Absent candidate added successfully.');
    }

}
