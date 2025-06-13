<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtWorks;
use Illuminate\Support\Facades\Log;

class ArtWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->header('Authorization');
        
        // if($userId){
        //     $data = ArtWorks::where('Authorization', $userId)->get();
            
        // }else{
            $data = ArtWorks::all();
        // }
        Log::info('User ID from Authorization header: ' . $data);
        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return response()->json([
            'status' => 'success',
            'message' => 'Form to create a new art work',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());
        $request->validate([
            'Authorization' => 'nullable|string',
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        $artWork = new ArtWorks();
        $artWork->Authorization = $request->header('Authorization');
        $artWork->title = $request->input('title');
        $artWork->type = $request->input('type');
        $artWork->date = $request->input('date');

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $artWork->image = $imagePath;
        }
        $artWork->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Art work created successfully',
            'data' => $artWork,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Code to display a specific art work
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Code to show form for editing an art work
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Request data for update: ', $request->all());
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'type' => 'sometimes|string|max:255',
            'date' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $artWork = ArtWorks::findOrFail($id);
        $artWork->title = $request->title;
        $artWork->type = $request->type;
        $artWork->date = $request->date;
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $artWork->image = $imagePath;
        }
        $artWork->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Art work updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Log::info('Request to delete art work with ID: ' . $id);
        $artWork = ArtWorks::findOrFail($id);
        $artWork->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Art work deleted successfully'
        ], 200);
    }
}
