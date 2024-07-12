<li class="sent float-end">
    <div class="d-flex align-items-center align-items-start mb15">
        <div class="title fz15"> Me <small class="ml10"> {{ $message->created_at->diffForHumans() }} </small></div>
    </div>
    <p>{{ $message->message }}</p>
</li>
