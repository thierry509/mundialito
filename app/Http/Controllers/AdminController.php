<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModerationRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(ModerationRequest $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString(); // ← préserve ?search=...

        return Inertia::render('Users/Moderation', [
            'users' => $users,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function updateRoles(UpdateRolesRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['userId']);
        $user->update([
            'roles' => $validated['roles'],
        ]);
        return redirect()->back();
    }
}
