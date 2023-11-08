<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index', ['project' => Project::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        return view('admin.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, Project $project)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        $project->delete();

        return to_route('admin.index');
    }
}
