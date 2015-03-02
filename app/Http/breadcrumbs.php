<?php
// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'), ['icon' => 'fa-home']);
});

Breadcrumbs::register('jobs', function($breadcrumbs, $timeframe, $user)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Jobs', action('JobsController@index'));
    if ( $timeframe != 'thisweek' ) {
        $breadcrumbs->push($timeframe, action('JobsController@index', $timeframe));
    }
});

Breadcrumbs::register('projects', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Projects', action('ProjectsController@index'));
});



Breadcrumbs::register('reports', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Reports', action('ReportsController@index'));
});