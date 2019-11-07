<div class="event-sidebar">
    
    @if(!empty($event_verticals))
        <h3>Event Verticals</h3>
        <ul>
            @foreach($event_verticals as $event_vertical)
                <li><a href="{{ url('event-verticals/'.$event_vertical->slug) }}">{{ $event_vertical->event_verticals_name }}</a></li>
            @endforeach
        </ul>
    @endif
</div>