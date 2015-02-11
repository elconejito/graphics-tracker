<h3><i class="fa fa-exclamation-triangle"></i> CAUTION!</h3>
<p>You are about to delete the {{ $modal->objectType }} &quot;<strong>{{ $modal->objectName }}</strong>&quot;. This action is NOT reversible.</p>
<p>{{ $modal->warnings }}</p>
<p>Are you REALLY SURE you wish to delete this {{ $modal->objectType }}? This cannot be undone. If you are really sure, then click the delete button below.</p>
<p>If you are not sure, remain calm, just hit the cancel button below or press the escape key and slowly back away from the keyboard...</p>
{!! $modal->form !!}