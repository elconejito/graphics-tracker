@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Reports: <small>{{ $timeframe }}</small></h1>
                @include('components.calendars.reports')
                {!! Breadcrumbs::render('reports') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>New</th>
                            <th>Edit</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $projects->isEmpty() )
                        <tr>
                            <td colspan="3">No projects in this timeframe</td>
                        </tr>
                        @else
                            <?php
                            $total_new = 0;
                            $total_edit = 0;
                            $total_graphics = 0;
                            ?>
                            @foreach ( $projects as $project )
                        <tr>
                            <td>{{ $project->getName() }}</td>
                            <td>{{ $project->jobs()->new()->$timeframe()->count() }}</td>
                            <td>{{ $project->jobs()->edit()->$timeframe()->count() }}</td>
                            <td>{{ $project->jobs()->$timeframe()->count() }}</td>
                        </tr>
                            <?php 
                            $total_new = $total_new + $project->jobs()->new()->$timeframe()->count();
                            $total_edit = $total_edit + $project->jobs()->edit()->$timeframe()->count();
                            $total_graphics = $total_graphics + $project->jobs()->$timeframe()->count();
                            ?>
                            @endforeach
                        <tr class="info">
                            <td>TOTAL GRAPHICS</td>
                            <td>{{ $total_new }}</td>
                            <td>{{ $total_edit }}</td>
                            <td><span class="badge">{{ $total_graphics }}</span></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 col-md-offset-1">
                
            </div>
        </div>
    </div>
@endsection
