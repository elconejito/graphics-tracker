@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Projects</h1>
                <p>breadcrumbs</p>
            </div>
        </div>
        {!! Form::open() !!}{!! Form::close() !!}
        <div class="row">
            <div class="col-md-8">
                <table class="table" id="jobList">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Shortcode</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $projects->isEmpty() )
                        <tr>
                            <td colspan="3">No projects</td>
                        </tr>
                        @else
                            @foreach ( $projects as $project )
                        <tr id="project_{{ $project->id }}">
                            <td><a class="editable" data-type="text" data-name="name" data-pk="{{ $project->id }}" data-url="{{ action('ProjectsController@update', $project->id) }}" >{{ $project->name }}</a></td>
                            <td>{{ $project->shortcode }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ action('ModalController@show', ['project', $project->id]) }}" data-toggle="modal" data-target="#modalTarget"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 col-md-offset-1">
                
            </div>
        </div>
    </div>
@endsection
