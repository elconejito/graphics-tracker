@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Your Jobs</h1>
                <p>breadcrumbs</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['action'=>'JobsController@store']) !!}
                    <div class="input-group">
                        <input type="text" class="form-control" id="graphic" name="graphic" placeholder="Graphic Number or Name">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Add</button>
                        </span>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Graphic #</th>
                            <th>Type (N/E)</th>
                            <th>Project</th>
                            <th>Duration</th>
                            <th>Started</th>
                            <th>Finished</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $jobs->isEmpty() )
                        <tr>
                            <td colspan="4">No jobs in this timeframe</td>
                        </tr>
                        @else
                            @foreach ( $jobs as $job )
                        <tr id="job_{{ $job->id }}">
                            <td>{{ $job->id }}-{{ $job->graphic }}</td>
                            <td>{{ ($job->new ? 'new':'edit') }}</td>
                            <td>XYZ ABC</td>
                            <td>{{ $job->duration }}</td>
                            <td>{{ $job->job_start->toDateTimeString() }}</td>
                            <td>{{ $job->job_end->toDateTimeString() }}</td>
                            <td>{{ ($job->owner->name == Auth::user()->name ? 'me':$job->owner->name) }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ action('ModalController@show', ['job', $job->id]) }}" data-toggle="modal" data-target="#modalTarget"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
