<a href="{{ route('view_mp', ['member_id' => $mp->id]) }}">
    <div class="panel panel-default panel-body">
        <p class="lead">{{ $mp->name }}</p>
        <p>party: {{ $mp->party }} | constituency: {{ $mp->constituency }}</p>
    </div>
</a>
