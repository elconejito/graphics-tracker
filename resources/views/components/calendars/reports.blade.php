<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-calendar"></i>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ route('reports') }}">thisweek</a></li>
        <li><a href="{{ route('reports', 'lastweek') }}">lastweek</a></li>
        <li><a href="{{ route('reports', 'thismonth') }}">thismonth</a></li>
        <li><a href="{{ route('reports', 'lastmonth') }}">lastmonth</a></li>
        <li class="divider"></li>
        <li><a href="#">Other timeframe</a></li>
    </ul>
</div>