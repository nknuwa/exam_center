<?php

namespace App\Http\Controllers;

use App\Models\ExamDb;
use App\Models\SpecialNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index()
    {
        return view('pages.comments.index');
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'         => 'required|date',
            'session'      => 'required|string',
            'subject_code' => 'required|string',
            'paper_code'   => 'required|string',
            'message'      => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $center_no = $user->center_no ?? null;

        SpecialNote::create([
            'center_no'    => $center_no,
            'date'         => $validated['date'],
            'session'      => $validated['session'],
            'subject_code' => $validated['subject_code'],
            'paper_code'   => $validated['paper_code'],
            'message'      => $validated['message'],
            'user_id'      => $user->id,
        ]);

        return back()->with('success', 'Special note saved successfully!');
    }
}
