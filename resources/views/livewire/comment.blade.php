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

      <div class="content">
        @foreach ($comments as $r)
        <div class="card card-custom mb-3">
          <div class="card-body">
            <p>
              {{ $r->creator->name ?? '-' }} <small class="text-muted">{{ $r->created_at->diffForHumans() }}</small>
            </p>
            <span class="delete-post" wire:click="deleteComment({{ $r->id }})">&times;</span>
            <p class="content">{{ $r->body }}</p>
            @if ($r->image)
              <img src="{{ asset('storage/comments/'.$r->image) }}" alt="Post {{ $r->creator->name ?? '' }}" class="w-50 rounded">
            @endif
          </div>
        </div>
        @endforeach
        {{ $comments->links() }}
      </div>
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