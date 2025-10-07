<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\BackExam;
use App\Models\ExamData;
use App\Exports\ExamsExport;
use Illuminate\Http\Request;
use App\Exports\ExamDataExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OlExamController extends Controller
{
    public function index()
    {
        $response['exams'] = Exam::orderBy('id', 'desc')->get();
        return view('pages.exam.ol.index')->with($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'index_no'   => 'required|digits:8',
            'subject_no' => 'required',
            'paper_code' => [
                'required',
                function ($value, $fail) use ($request) {
                    $exists = Exam::where('index_no', $request->index_no)
                        ->where('paper_code', $value)
                        ->exists();

                    if ($exists) {
                        $fail("This paper code is already added for this Index Number.");
                    }
                }
            ],
        ]);

        // Auto get center_no from exam_data
        $centerNo = ExamData::where('index_no', $request->index_no)->value('center_no');

        Exam::create([
            'index_no'   => $request->index_no,
            'center_no'  => $centerNo,
            'subject_no' => $request->subject_no,
            'paper_code' => $request->paper_code,
            'status'    => 'active',
        ]);

        ExamData::where('index_no', $request->index_no)->where('subject_no', $request->subject_no)->where('paper_code', $request->paper_code)->update(['status' => 'inactive']);

        session()->flash('success', 'Index added successfully!');
        return redirect()->route('ol.all');
    }

    public function getExamData($index_no)
    {
        $allExamData = ExamData::where('index_no', $index_no)->get();

        if ($allExamData->isEmpty()) {
            return response()->json([
                'found' => false,
                'has_active' => false,
                'center_no' => null,
                'subjects' => [],
            ]);
        }

        $centerNo = $allExamData->first()->center_no ?? null;

        $activeData = $allExamData->where('status', 'active');

        if ($activeData->isEmpty()) {
            return response()->json([
                'found' => true,
                'has_active' => false,
                'center_no' => $centerNo,
                'subjects' => [],
            ]);
        }

        $subjects = $activeData->groupBy('subject_no')->map(function ($rows) {
            return [
                'subject_no' => $rows->first()->subject_no,
                'papers' => $rows->pluck('paper_code')->unique()->values(),
            ];
        })->values();

        return response()->json([
            'found' => true,
            'has_active' => true,
            'center_no' => $centerNo,
            'subjects' => $subjects,
        ]);
    }

        public function downloadAllCsv()
    {
        // return Excel::download(new ExamsExport, 'all_exams.csv', \Maatwebsite\Excel\Excel::CSV);
    }



// public function downloadAllCsv()
// {
//     DB::beginTransaction();

//     try {
//         // Fetch all exams
//         $exams = Exam::all();

//         if ($exams->isEmpty()) {
//             return redirect()->back()->with('error', 'No exam data available to download.');
//         }

//         // Backup exams
//         $backupData = $exams->map(function ($exam) {
//             return [
//                 'index_no'   => $exam->index_no,
//                 'center_no'  => $exam->center_no,
//                 'subject_no' => $exam->subject_no,
//                 'paper_code' => $exam->paper_code,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ];
//         })->toArray();

//         BackExam::insert($backupData);

//         // Export CSV using the ExamsExport class
//         return Excel::download(new ExamsExport($exams), 'all_exams.csv', \Maatwebsite\Excel\Excel::CSV);

//         // Optional: truncate Exam table AFTER CSV download
//         // Exam::truncate();

//         DB::commit();

//     } catch (\Exception $e) {
//         DB::rollBack();
//         return redirect()->back()->with('error', 'Failed to download CSV: ' . $e->getMessage());
//     }
// }



    public function downloadAllExcel()
    {
        return Excel::download(new ExamsExport, 'all_exams.xlsx');
    }

    public function downloadAllPdf()
    {
        $data = Exam::all();

        $pdf = Pdf::loadView('exports.ol_exam', compact('data'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('ol_re_correction.pdf');
    }

    // AJAX method
    // Get exam data for given index_no
    // public function getExamData($index_no)
    // {
    //     $examData = ExamData::where('index_no', $index_no)->where('status', 'active')->get();

    //     if($examData->isEmpty()) {
    //         $centerNo = ExamData::where('index_no', $index_no)->value('center_no');
    //         return response()->json([
    //             'center_no' => $centerNo,
    //             'subjects' => [],
    //         ]);
    //     }
    //     // Group subjects
    //     $subjects = $examData->groupBy('subject_no')->map(function ($rows) {
    //         return [
    //             'subject_no' => $rows->first()->subject_no,
    //             'papers'     => $rows->pluck('paper_code')->unique()->values(),
    //         ];
    //     })->values();

    //     return response()->json([
    //         'center_no' => $examData->first()->center_no ?? null,
    //         'subjects'  => $subjects,
    //     ]);
    // }


}
