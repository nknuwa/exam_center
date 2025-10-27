<?php

namespace App\Http\Controllers;

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
}
