{{--
  Catatan : 
    1. wire.model
      wire:model = setiap ngetik / keydown
      wire:model.lazy = setiap lost focus
      wire:model.debounce.500ms = di bere waktu 500 mili seconds
--}}
<div class="card h-100 card-custom mb-3">
  <div class="card-body">
    <h4>Comment</h4>
    @if ($msg = session('message'))
      <div class="alert alert-{{ $msg['color'] }}" role="alert">{{ $msg['message'] }}</div>
    @endif

    @auth
    <form wire:submit.prevent="addComment">
      <section>
        <div>
          @if ($image)
            <img src="{{ $image }}" alt="" class="rounded mb-3" style="width: 150px;">                
          @endif
        </div>
        <input type="file" id="image" wire:change="$emit('fileChoosen')" style="font-size: 13px;">
      </section>
      <div class="form-group">
        <label for="body">Comment</label>
        <textarea wire:model.lazy="body" id="body" class="form-control" rows="4"></textarea>
        @error('body') <p><small class="text-danger">{{ $message }}</small></p> @enderror
        <button class="btn btn-primary mt-2">Submit</button>
      </div>
    </form>
    @endauth

    <div class="content">
      @foreach ($comments as $r)
      <div class="card card-custom mb-3">
        <div class="card-body">
          <p>
            {{ $r->creator->name ?? '-' }} <small class="text-muted">{{ $r->created_at->diffForHumans() }}</small>
          </p>

          @if (Auth::check() && Auth::user()->id == $r->user_id)
            <span class="delete-post" wire:click="deleteComment({{ $r->id }})">&times;</span>
          @endif

          <p class="content">{{ $r->body }}</p>
          @if ($r->image)
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <img src="{{ $r->image_path }}" alt="Post {{ $r->creator->name ?? '' }}" class="w-100 rounded">
              </div>
            </div>
          @endif
        </div>
      </div>
      @endforeach
      {{ $comments->links() }}
    </div>
  </div>
</div>

@push('script')
<script>
  window.livewire.on('fileChoosen', () => {
    let inputField = document.getElementById('image');
    let file = inputField.files[0];

    if(inputField.files.length){
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onloadend = () => { window.livewire.emit('fileUpload', reader.result) }
    }
  });
</script>    
@endpush