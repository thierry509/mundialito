<?php

namespace App\Http\Controllers;

use App\Events\CommentDeleted;
use App\Models\Comment;
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

       public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);

        $commentId = $comment->id; // garder l'id avant suppression
        $commentableType = $comment->commentable_type;
        $commentableId   = $comment->commentable_id;

        $comment->delete();

        // 🔥 broadcast event après suppression
        event(new CommentDeleted($commentId, $commentableType, $commentableId));

        return redirect()->back();

    }
}
