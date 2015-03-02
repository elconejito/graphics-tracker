@if ($breadcrumbs)
	<ol class="breadcrumb">
		@foreach($breadcrumbs as $breadcrumb)
		    <?php if ( isset($breadcrumb->icon) ) $breadcrumb->title = '<i class="fa '.$breadcrumb->icon.'"></i>'; ?>
			@if ($breadcrumb->url && !$breadcrumb->last)
				<li><a href="{{{ $breadcrumb->url }}}">{!! $breadcrumb->title !!}</a></li>
			@else
				<li class="active">{{{ $breadcrumb->title }}}</li>
			@endif
		@endforeach
	</ol>
@endif