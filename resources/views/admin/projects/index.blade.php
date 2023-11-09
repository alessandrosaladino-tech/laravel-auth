@extends('layouts.admin')

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
                                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="0.75em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
                                </a>
                                <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-outline-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                </a>
                                
                                
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$project->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#000000}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </button>
                            </div>
                             
                             <!-- Modal Body -->
                             <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$project->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$project->id}}">
                                                <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                            </h5>
                                        </div>
                                        {{-- /.modal-header --}}

                                        <div class="modal-body text-center">
                                            Are you sure you want to delete?
                                        </div>
                                        {{-- /.modal-body --}}

                                        <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>
                                        {{-- /.modal-footer --}}

                                    </div>
                                    {{-- /.modal-content --}}

                                </div>
                                {{-- /.modal-dialog --}}
                            </div>
                            {{-- /.modal --}}
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
