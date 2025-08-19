<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateAvatar(Request $request, ImageService $imageService)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($request->hasFile('avatar')){
            $user = auth()->user();
            $imageUrl = $imageService->store($request->file('avatar'), 'avatar' . $user->id, 'avatars');
            $user->update(['avatar' =>  $imageUrl['original'] ? '/storage/' . $imageUrl['original'] : null,]);
        }


        // Supprimer l'ancien avatar si existe
        // if ($user->avatar && Storag::exists('public/' . $user->avatar)) {
        //     Storage::delete('public/' . $user->avatar);
        // }

        return back()->with('success', 'Avatar mis à jour avec succès.');
    }
}
