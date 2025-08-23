<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'content' => $this->content,
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'parent_id' => $this->parent_id,
            'created_at' => $this->formatDate($this->created_at),
            'updated_at' => $this->formatDate($this->updated_at),
            'user' => [
                'id' => $this->user->id,
                'full_name' => $this->getFullName(),
                'email' => $this->user->email,
                'avatar' => $this->user->avatar ? /* URL de l'avatar si disponible */: null,
            ],
            'reply' => count($this->whenLoaded('replies')),
            'can_delete' => auth()->check() ? auth()->user()->can('delete', $this->resource) : false,
        ];
    }

    /**
     * Format date for human readability
     */
    protected function formatDate($date): string
    {
        $carbonDate = Carbon::parse($date);

        // S'assurer que les mois/jours sont en français
        Carbon::setLocale('fr');

        if ($carbonDate->isToday()) {
            return 'aujourd\'hui ' . $carbonDate->format('H:i');
        }

        if ($carbonDate->isYesterday()) {
            return 'hier ' . $carbonDate->format('H:i');
        }

        if ($carbonDate->isTomorrow()) {
            return 'demain ' . $carbonDate->format('H:i');
        }

        // Utiliser isoFormat pour avoir les noms en français
        return $carbonDate->isoFormat('D MMM Y H:i'); // ex: "15 janv. 2024 14:30"
    }
    /**
     * Get user's full name
     */
    protected function getFullName(): string
    {
        return trim($this->user->first_name . ' ' . $this->user->last_name);
    }
}
