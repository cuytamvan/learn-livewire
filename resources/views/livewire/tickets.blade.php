<div class="card h-100 card-custom mb-3">
  <div class="card-body">
    <h4>Support Ticket</h4>

    <ul class="list-group mt-4">
      @foreach ($tickets as $r)
      <li class="list-group-item {{ $active == $r->id ? 'list-group-item-secondary' : '' }}" wire:click="$emit('ticketSelected', {{ $r->id }})">
        <small>{{ $r->question }}</small>
      </li>
      @endforeach
    </ul>
  </div>
</div>
