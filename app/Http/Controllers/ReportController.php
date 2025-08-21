<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Report.Index', [
            'reports' => Report::with(['comment.user', 'user'])
                ->where('status', 'pending') // Seulement les signalements en attente
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function reject($id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'rejected';
        $report->save();

        return redirect()->back();
    }
}
