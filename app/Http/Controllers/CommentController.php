<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
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
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json(CommentResource::collection($comments));
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

        // Retourner le commentaire créé
        return response()->json([
            'success' => true,
            'comment' => $comment->load('user')
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

    public function destroy($id)
    {

        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Supprimé avec succès']);
    }
}
