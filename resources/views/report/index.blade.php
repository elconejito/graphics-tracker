@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Reports: <small>{{ $timeframe }}</small></h1>
                <p>breadcrumbs</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                            $total_graphics = 0;
                            ?>
                            @foreach ( $projects as $project )
                        <tr>
                            <td>{{ $project->getName() }}</td>
                            <td>{{ $project->jobs()->$timeframe()->count() }}</td>
                        </tr>
                            <?php 
                            $total_graphics = $total_graphics + $project->jobs()->$timeframe()->count();
                            ?>
                            @endforeach
                        <tr>
                            <td></td>
                            <td>{{ $total_graphics }}</td>
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
