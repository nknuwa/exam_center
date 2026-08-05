<?php

namespace App\Http\Controllers;

use App\Models\CenterChange;
use App\Models\ExamDb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exports\CentersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class CenterController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $query = CenterChange::where('user_id', Auth::id())
            ->where('exam_id', 'AL26');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('current_center_no', 'like', "%{$search}%")
                    ->orWhere('new_center_no', 'like', "%{$search}%")
                    ->orWhere('index_no', 'like', "%{$search}%")
                    ->orWhere('subject_code', 'like', "%{$search}%")
                    ->orWhere('paper_code', 'like', "%{$search}%")
                    ->orWhere('session', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%");
            });
        }

        $response['exam_db'] = ExamDb::where('exam_id', 'AL26')
            ->select('center_no')
            ->distinct()
            ->orderBy('center_no')
            ->get();

        $response['centers'] = $query
            ->latest()
            ->paginate($perPage)
            ->appends($request->query());

        return view('pages.center.index', $response);

        // $response['exam_db'] = ExamDb::select('center_no')->distinct()->get();
        // $response['centers'] = CenterChange::where('user_id', Auth::id())->get();
        // return view('pages.center.index')->with($response);
    }

    public function All()
    {
        $response['centers'] = CenterChange::all();
        return view('pages.center.all')->with($response);
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

    // public function getCandidate(Request $request)
    // {
    //     $candidate = ExamDb::where('index_no', $request->index_no)
    //         ->where('subject_code', $request->subject_code)
    //         ->whereDate('date', $request->date)
    //         ->where('session', $request->session)
    //         ->where('exam_id', $request->exam_id)
    //         ->first();

    //     if (!$candidate) {
    //         return response()->json([
    //             'status' => false
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'center_no' => $candidate->center_no,
    //         'paper_code' => $candidate->paper_code,
    //         'exam_id' => $candidate->exam_id,
    //     ]);
    // }

    // public function getCenterByIndex(Request $request)
    // {
    //     $index_no = $request->index_no;

    //     // Example: look up student or candidate record by index number
    //     $candidate = ExamDb::where('index_no', $index_no)->first();

    //     if ($candidate) {
    //         return response()->json([
    //             'center_no' => $candidate->center_no,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'center_no' => null,
    //             'message' => 'Index not found',
    //         ], 404);
    //     }
    // }

    public function getCenterByIndex(Request $request)
{
    $candidate = ExamDb::where('index_no', $request->index_no)
        ->first();

    if ($candidate) {
        return response()->json([
            'center_no' => $candidate->center_no,
            // 'paper_code' => $candidate->paper_code,
            'exam_id' => $candidate->exam_id,
        ]);
    }

    return response()->json([
        'center_no' => null,
        // 'paper_code' => null,
        'exam_id' => null,
        'message' => 'Index not found',
    ], 404);
}

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'session' => 'required|string',
            'subject_code' => 'required|string',
            'paper_code' => 'required|string',
            'index_no' => 'required|string',
            'current_center_no' => 'required|string',
            'new_center_no' => 'required|string',
        ]);

        // Ensure candidate exists
        $exists = ExamDb::where('index_no', $request->index_no)
            ->where('subject_code', $request->subject_code)
            ->where('paper_code', $request->paper_code)
            ->exists();

        if (! $exists) {
            return back()->withErrors(['index_no' => 'Index number not found for this paper.'])->withInput();
        }

        // Prevent duplicate record
        $duplicate = CenterChange::where([
            'date' => $request->date,
            'session' => $request->session,
            'index_no' => $request->index_no,
            'subject_code' => $request->subject_code,
            'paper_code' => $request->paper_code,
            'current_center_no' => $request->current_center_no,
            'new_center_no' => $request->new_center_no,
        ])->exists();

        if ($duplicate) {
            return back()->withErrors(['index_no' => 'This center change already exists.'])->withInput();
        }

        CenterChange::create([
            'date' => $request->date,
            'session' => $request->session,
            'subject_code' => $request->subject_code,
            'paper_code' => $request->paper_code,
            'index_no' => $request->index_no,
            'exam_id' => $request->exam_id,
            'current_center_no' => $request->current_center_no,
            'new_center_no' => $request->new_center_no,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('center.all')->with('success', 'Center changed successfully!');
    }

    public function downloadExcel()
    {
        return Excel::download(new CentersExport, 'centers_report.xlsx');
    }

    public function downloadPDF()
    {
        $centers = CenterChange::all(); // or your filtered query

        $pdf = Pdf::loadView('pdf.centers', compact('centers'))
            ->setPaper('A4', 'landscape'); // landscape better for wide tables

        return $pdf->download('centers_report.pdf');
    }
}
