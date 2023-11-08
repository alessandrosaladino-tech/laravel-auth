@extends('layouts.admin')

@section('content')
    <div class="container ">
        <h1 class="text-center py-2">projects List</h1>

        <div class="table-responsive-sm">
            <table class="table table-light align-middle">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Thumb</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr class="text-center">
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>

                                @if (str_contains($project->thumb, 'http'))
                                    <img height="50px" src="{{ $project->thumb }}">
                                @else
                                    <img height="50px" src="{{ asset('storage/' . $project->thumb) }}">
                                @endif


                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('projects.show', $project->id) }}">More</a>
                                <a class="btn btn-success" href="{{ route('projects.edit', $project->id) }}">Edit</a>

                                <!-- Modal for deleting projects with danger message -->
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">Deleting project #{{ $project->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">Are you sure you want to delete the project?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, i want to delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <h6>There are no projects for the moment, Sorry</h6>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
@endsection
