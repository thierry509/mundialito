<?php

namespace App\Http\Controllers;

use App\Events\CommentDeleted;
use App\Events\CommentPosted;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Afficher les commentaires d'un match.
     */
    public function gameComments($gameId)
    {
        $comments = Comment::where('commentable_id', $gameId)
            ->where('commentable_type', 'App\Models\Game')
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(CommentResource::collection($comments));
    }

    public function newsComments($gameId)
    {
        $comments = Comment::where('commentable_id', $gameId)
            ->where('commentable_type', 'App\Models\News')
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(CommentResource::collection($comments));
    }

    public function replies($id)
    {
        $replies = Comment::findOrFail($id)->replies;

        return response()->json(CommentResource::collection($replies));
    }

    /**
     * Créer un commentaire ou une réponse.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        $types = [
            'game' => \App\Models\Game::class,
            'news' => \App\Models\News::class,
            // ajouter d'autres types si nécessaire
        ];

        $commentableType = $validated['commentable_type'];

        if (!isset($types[$commentableType])) {
            return response()->json(['success' => false, 'message' => 'Type invalide'], 400);
        }

        $commentableClass = $types[$commentableType];
        $commentable = $commentableClass::findOrFail($validated['commentable_id']);

        $comment = $commentable->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        $commentWithRelations = $comment->load(['user', 'replies.user']);
        $commentArray = (new CommentResource($commentWithRelations))->toArray(request());

        event(new CommentPosted($commentArray));
        // Retourner le commentaire créé
        return response()->json([
            'success' => true,
            'comment' => $comment->load('user')
        ]);
    }

    /**
     * Mettre à jour un commentaire existant.
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $validated = $request->validated();

        $comment = \App\Models\Comment::findOrFail($id);

        // Vérifie que c'est bien l'auteur du commentaire qui modifie
        if ($comment->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée.'
            ], 403);
        }

        $comment->update([
            'content' => $validated['content'],
        ]);

        $commentWithRelations = $comment->load(['user', 'replies.user']);
        $commentArray = (new \App\Http\Resources\CommentResource($commentWithRelations))->toArray(request());

        event(new \App\Events\CommentUpdated($commentArray));

        return response()->json([
            'success' => true,
            'comment' => $commentWithRelations
        ]);
    }


    /**
     * Ajouter un like à un commentaire.
     */
    public function like(Comment $comment)
    {
        // Ici tu peux gérer un like unique par utilisateur si tu veux
        $comment->increment('likes_count');

        return response()->json([
            'success' => true,
            'likes_count' => $comment->likes_count
        ]);
    }

    public function report(StoreReportRequest $request, Comment $comment)
    {
        $validated = $request->validated();

        $report = Report::create([
            'comment_id' => $comment->id,
            'user_id' => auth()->id(),
            'reason' => $validated['reason'],
            'category' => $validated['category'],
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Signalement envoyé avec succès',
            'report' => $report
        ], 201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);

        $commentId = $comment->id; // garder l'id avant suppression
        $commentableType = $comment->commentable_type;
        $commentableId   = $comment->commentable_id;

        $comment->delete();

        // 🔥 broadcast event après suppression
        event(new CommentDeleted($commentId, $commentableType, $commentableId));


        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
