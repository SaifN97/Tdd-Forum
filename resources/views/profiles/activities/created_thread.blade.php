@component('profiles.activities.activity')

    @slot('heading')
        {{ $profileUser->name }} published 
        <a href="{{ $activity->subject->path() }}">"{{ $activity->subject->title }}"</a>   
    @endslot


    @slot('body')
        <div class="body">{{ $activity->subject->body }}</div>
    @endslot

@endcomponent
