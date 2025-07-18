<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use Illuminate\Http\Request;
use App\Http\Resources\HabitResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('can:own,habit')->except('index');
    }

    public function index()
    {
        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i'],
        ]);

        return HabitResource::collection(
            Habit::query()
                ->where('user_id', Auth::id())
                ->when(str(request()->string('with', ''))->contains('user'), fn ($q) => $q->with('user'))
                ->when(str(request()->string('with', ''))->contains('logs'), fn ($q) => $q->with('logs'))
                ->paginate()
        );
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = Auth::user()->habits()->create($request->validated());

        return HabitResource::make($habit);
    }

    public function show(Habit $habit)
    {
        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i'],
        ]);

        $load = collect(explode(',', request()->string('with')))
            ->filter(fn($w) => strlen($w) > 0)
            ->toArray();

        return HabitResource::make($habit->load($load));
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update($request->validated());

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        $habit->delete();

        return response()->noContent();
    }
}