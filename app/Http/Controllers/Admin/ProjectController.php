<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.projects.index', ['projects' => Project::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $valData = $request->validated();

        $valData['slug'] = Str::slug($request->title, '-');

        if ($request->has('thumb')) {
            $file_path = Storage::put('thumbs', $request->thumb);
            $valData['thumb'] = $file_path;
        }

        $newProject = Project::create($valData);

        return to_route('admin.projects.index')->with('status', 'Post created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $valData = $request->validated();

        if ($request->has('thumb')) {

            // SALVA L'IMMAGINE NEL FILESYSTEM
            $newThumb = $request->thumb;
            $path = Storage::put('thumbs', $newThumb);

            // SE IL FUMETTO HA GIA' UNA THUMB NEL DB , DEVE ESSERE ELIMINATA DATO CHE LA STIAMO SOSTITUENDO
            if (!isNull($project->thumb) && Storage::fileExists($project->thumb)) {
                // ELIMINA LA VECCHIA PREVIEW
                Storage::delete($project->thumb);
            }

            // ASSEGNA AL VALORE DI $valData IL PERCORSO DELL'IMMAGINE NELLO STORAGE
            $valData['thumb'] = $path;
        }

        // dd($valData);
        // AGGIORNA L'ENTITA' CON I VALORI DI $valData
        $project->update($valData);
        return to_route('admin.projects.show', $project->slug)->with('status', 'Well Done, Element Edited Succeffully');
    }

       /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        //dd($project->exif_thumbnail);
        //dd($project->thumb);
        if (!is_null($project->thumb)) {
            Storage::delete($project->thumb);
        }
        $project->delete();

        return to_route('admin.projects.index')->with('message', 'Welldone! Project deleted successfully');
    }

    public function trash_projects()
    {
        return view('admin.projects.trash', ['trash_project' => Project::onlyTrashed()->orderByDesc('deleted_at')->paginate(5)]);
    }


    public function restore($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->restore();

        return to_route('admin.projects.index')->with('message', 'Welldone! Project restored successfully');
    }

    public function forceDelete($id)
    {
        $project = Project::withTrashed()->find($id);

        //dd($project->thumb);
        if (!is_null($project->thumb)) {
            Storage::delete($project->thumb);
        }

        $project->forceDelete();

        return to_route('admin.trash')->with('message', 'Well Done! Project deleted successfully!');
    }
}