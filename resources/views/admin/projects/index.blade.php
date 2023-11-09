@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Project List for') }} {{ Auth::user()->name }}
        </h2>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('status') }}
            </div>
        @endif

        <a href="{{route('admin.projects.create')}}" class="btn btn-primary my-3">Add a New Project</a>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Preview</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Project Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="">
                            <td class="align-middle" scope="row">{{ $project->id }}</td>

                            @if (str_contains($project->thumb, 'http'))
                                <td class="text-center align-middle"><img class="img-fluid" style="height: 100px"
                                        src="{{ $project->thumb }}" alt="{{ $project->title }}"></td>
                            @else
                                <td class="text-center align-middle"><img class="img-fluid" style="height: 100px"
                                        src="{{ asset('storage/' . $project->thumb) }}"></td>
                            @endif


                            <td class="align-middle">{{ $project->title }}</td>
                            <td class="align-middle">{{ $project->description }}</td>
                            <td class="align-middle">{{ $project->type }}</td>
                            <td class="align-middle">
                                <a href="{{ route('admin.projects.edit', $project->title) }}">Edit</a>
                                <a href="{{ route('admin.projects.show', $project->title) }}">Details</a>
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <td class="align-middle text-center" colspan="6">No Projects to show</td>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
