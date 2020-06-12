{{--
  Catatan : 
    1. wire.model
      wire:model = setiap ngetik / keydown
      wire:model.lazy = setiap lost focus
      wire:model.debounce.500ms = di bere waktu 500 mili seconds
--}}
<div class="container pt-4">
  <div class="row">
    <div class="col-sm-12 col-md-8 offset-md-2">
      <h4>Comment</h4>
      @if ($msg = session('message'))
        <div class="alert alert-{{ $msg['color'] }}" role="alert">{{ $msg['message'] }}</div>
      @endif
      <form wire:submit.prevent="addComment">
        <div class="form-group">
          <label for="body">Comment</label>
          <textarea wire:model.lazy="body" id="body" class="form-control" rows="4"></textarea>
          @error('body') <p><small class="text-danger">{{ $message }}</small></p> @enderror
          <button class="btn btn-primary mt-2">Submit</button>
        </div>
      </form>

      <div class="content">
        @foreach ($comments as $r)
        <div class="card card-custom mb-3">
          <div class="card-body">
            <p>
              {{ $r->creator->name ?? '-' }} <small class="text-muted">{{ $r->created_at->diffForHumans() }}</small>
            </p>
            <span class="delete-post" wire:click="deleteComment({{ $r->id }})">&times;</span>
            <p class="content">{{ $r->body }}</p>
          </div>
        </div>
        @endforeach
        {{ $comments->links() }}
      </div>
    </div>
  </div>
</div>
