@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Project: {{ $project->getName() }}</h1>
                <p>breadcrumbs</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table class="table" id="jobList">
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
                            <td><a class="editable" data-type="text" data-name="graphic" data-pk="{{ $job->id }}" data-url="{{ action('JobsController@update', $job->id) }}" >{{ $job->graphic }}</a></td>
                            <td>{{ ($job->new ? 'new':'edit') }}</td>
                            <td>{{ $job->project->getName() }}</td>
                            <td><a class="editable" data-type="text" data-name="duration" data-pk="{{ $job->id }}" data-url="{{ action('JobsController@update', $job->id) }}" >{{ $job->duration }}</a></td>
                            <td><a class="editable-date" data-type="datetime" data-name="job_start" data-pk="{{ $job->id }}" data-url="{{ action('JobsController@update', $job->id) }}" data-value="{{ $job->job_start }}" >{!! $job->getJobStart() !!}</a></td>
                            <td><a class="editable-date" data-type="datetime" data-name="job_end" data-pk="{{ $job->id }}" data-url="{{ action('JobsController@update', $job->id) }}" data-value="{{ $job->job_end }}" >{!! $job->getJobEnd() !!}</a></td>
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
            <div class="col-md-2 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">This Week</h3>
                    </div>
                    <div class="panel-body">
                        <p>Total graphics done this week among this project</p>
                    </div>
                    <!-- List group -->
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('monday')->count() }}</span>Monday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('tuesday')->count() }}</span>Tuesday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('wednesday')->count() }}</span>Wednesday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('thursday')->count() }}</span>Thursday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('friday')->count() }}</span>Friday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('saturday')->count() }}</span>Saturday</li>
                        <li class="list-group-item"><span class="badge">{{ App\Job::mine()->project($project->id)->day('sunday')->count() }}</span>Sunday</li>
                        <li class="list-group-item list-group-item-info"><span class="badge">{{ App\Job::mine()->project($project->id)->thisweek()->count() }}</span>TOTAL</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
