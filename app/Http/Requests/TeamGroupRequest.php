<?php

namespace App\Http\Requests;

use App\Models\Championship;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class TeamGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'group_id' => 'required|exists:groups,id',
            'team_id' => ['required', 'exists:teams,id', function ($attribute, $value, $fail) {
                $championship = Championship::whereHas('groups', function ($query) {
                    $query->where('id', $this->input('group_id'));
                })->first();

                if ($championship) {
                    $exists = DB::table('group_participations')
                        ->join('groups', 'group_participations.group_id', '=', 'groups.id')
                        ->where('groups.championship_id', $championship->id)
                        ->where('group_participations.team_id', $value)
                        ->exists();

                    if ($exists) {
                        $fail('Cette équipe est déjà inscrite dans un groupe de ce championnat.');
                    }
                }
            }],
        ];
    }
}
