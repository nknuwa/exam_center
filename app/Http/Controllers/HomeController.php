<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\ExamData;
use Illuminate\Http\Request;
use App\Models\AbsentCandidates;
use App\Models\CenterChange;
use App\Models\MediumChange;
use App\Models\SpecialNote;

class HomeController extends ParentController
{
    public function index() {
       $today = Carbon::now()->format('Y-m-d');
        $response['Absentees_Today'] = AbsentCandidates::whereDate('created_at', $today)->count();
        $response['center_Today'] = CenterChange::whereDate('created_at', $today)->count();
        $response['medium_Today'] = MediumChange::whereDate('created_at', $today)->count();
        $response['note_Today'] = SpecialNote::whereDate('created_at', $today)->count();

        $response['Absentees'] = AbsentCandidates::count();
        $response['centers'] = CenterChange::count();
        $response['medium'] = MediumChange::count();
        $response['notes'] = SpecialNote::count();
        // $response['exam'] = Exam::count();
        // $today = Carbon::now()->format('Y-m-d');
        // $response['today'] = Exam::whereDate('created_at', $today)->count();

        // $response['users'] = User::count();

        return view ('pages.home.index')->with($response);
    }
}
