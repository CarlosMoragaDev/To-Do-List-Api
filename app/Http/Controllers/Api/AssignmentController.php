<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::all();
        try{
            return response()->json($assignments);
        }catch(\Exception $e) {
            info($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'code'=>404], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
            ]);
            $assignmentData = Assignment::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);
            return response()->json([$assignmentData, 'message' => 'Nueva Tarea Creada','code'=>201], 201);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'code'=>405], 405);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assignment = Assignment::find($id);
        return response()->json($assignment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
            ]);
            $assignment->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $validated['status'],
            ]);
            return response()->json([$assignment, 'message' => 'Nueva Tarea Creada','code'=>201], 201);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'code'=>405], 405);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        try{
            $assignment->delete();
            return response()->json(['message' => 'Tarea Eliminada', 'code' => 200], 200);
        }catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'code'=>404], 404);
        }
    }

    public function statusAssignment(Request $request)
    {
        try {
            $assignment = Assignment::findOrFail($request->id);
            info($assignment);
            $validated = $request->validate([
                'status' => 'nullable|string|max:255',
            ]);
            $assignment->update([
                'status' => $validated['status'],
            ]);
            return response()->json([$assignment, 'message' => 'Tarea Terminada','code'=>201], 201);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'code'=>405], 405);
        }
    }
}
