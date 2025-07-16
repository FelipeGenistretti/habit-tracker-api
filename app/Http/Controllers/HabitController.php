<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use Illuminate\Http\Request;
use App\Http\Resources\HabitResource;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        ds()->clear();
        ds()->queriesOn();

        return HabitResource::collection(
            Habit::query()
            ->when(str(request()->string('with', ''))->contains('user'),
            fn ($query)=> $query->with('user')
            )
            ->when(str(request()->string('with', ''))->contains('logs'),
            fn ($query)=> $query->with('logs')
            )
            ->paginate()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHabitRequest $request)
    {

        $habit = Habit::create(array_merge($request->validated(), [
            'user_id' => 1,
        ]));

        return HabitResource::make($habit);
    }

    /**
     * Display the specified resource.
     */
    public function show(Habit $habit)
    {   
        //return Habit::whereuuid($habit)->firstOrFail();
        $habit = Habit::where('uuid', $habit->uuid)->firstOrFail();

        return HabitResource::make($habit);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habit $habit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHabitRequest $request, Habit $habit)
    {
        $habit->update($request->validated());
        return HabitResource::make($habit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Habit $habit)
    {
        $habit->delete();
        
        return response()->noContent();
    }
}
