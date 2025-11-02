<?php

namespace App\Http\Controllers;

use App\Models\ExamDb;
use App\Models\MediumChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class MediumController extends Controller
{
    public function index()
    {
        $response['mediumChanges'] = MediumChange::where('user_id', Auth::id())->get();
        return view('pages.medium.index')->with($response);
    }

    public function getPaperDetails(Request $request)
    {
        try {
            $user = Auth::user();
            $center_no = $user->center_no;

            $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->exam_date)));
            $session_input = strtoupper(trim($request->session));

            $subjects = ExamDb::where('center_no', $center_no)
                ->whereDate('date', $exam_date)
                ->where('session', $session_input)
                ->select('subject_code', 'paper_code')
                ->distinct()
                ->get();

            return response()->json(['subjects' => $subjects]);
        } catch (\Exception $e) {
            \Log::error('Error fetching paper details: ' . $e->getMessage());
            return response()->json(['subjects' => []], 500);
        }
    }



    public function getMedium(Request $request)
    {
        try {
            $user = Auth::user();
            $center_no = $user->center_no;

            $exam_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->exam_date)));
            $session = strtoupper(trim($request->session));
            $subject_code = trim($request->subject_code);
            $paper_code = trim($request->paper_code);
            $index_no = trim($request->index_no);

            $record = ExamDb::where('center_no', $center_no)
                ->whereDate('date', $exam_date)
                ->where('session', $session)
                ->where('subject_code', $subject_code)
                ->where('paper_code', $paper_code)
                ->where('index_no', $index_no)
                ->select('medium_no')
                ->first();

            if ($record) {
                return response()->json(['medium_no' => $record->medium_no]);
            } else {
                return response()->json(['medium_no' => ''], 404);
            }
        } catch (\Exception $e) {
            \Log::error('getMedium Error: ' . $e->getMessage());
            return response()->json(['medium_no' => ''], 500);
        }
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_no'     => 'required',
            'date'          => 'required|date',
            'session'       => 'required|string',
            'subject_code'  => 'required|string',
            'paper_code'    => 'required|string',
            'index_no'      => 'required|string',
            'medium_no'     => 'required|string',
            'new_medium_no' => 'required|string',
        ]);
        // dd($validated);


        // Check if already exists
        $exists = MediumChange::where('center_no', $request->center_no)
            ->whereDate('date', $request->date)
            ->where('session', $request->session)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->where('index_no', $request->index_no)
            ->exists();

        if ($exists) {
            return back()->withErrors(['index_no' => 'This candidate medium has already been changed.'])
                ->withInput();
        }

        // Create new record
        MediumChange::create([
            'center_no'     => $request->center_no,
            'date'          => $request->date,
            'session'       => $request->session,
            'subject_code'  => $request->subject_code,
            'paper_code'    => $request->paper_code,
            'index_no'      => $request->index_no,
            'medium_no' => $request->medium_no,
            'new_medium_no' => $request->new_medium_no,
            'user_id'       => Auth::id(),
        ]);

        return redirect()
            ->route('medium.all')
            ->with('success', 'Medium change saved successfully!');
    }
}
