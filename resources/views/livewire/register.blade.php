<div class="row pt-5">
  <div class="col-sm-12 col-md-6 offset-md-3">
    <div class="card card-custom">
      <div class="card-body">
        <h4 class="text-center">Register</h4>
        <p class="text-center"><small class="text-muted">Lorem ipsum dolor sit amet.</small></p>

        <form wire:submit.prevent="submit">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label>Name</label>
              <input type="text" wire:model.lazy="form.name" class="form-control" autocomplete="off">
              @error('form.name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <label>Email</label>
              <input type="text" wire:model.lazy="form.email" class="form-control" autocomplete="off">
              @error('form.email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <label>Password</label>
              <input type="password" wire:model.lazy="form.password" class="form-control">
              @error('form.password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <label>Password Confirmation</label>
              <input type="password" wire:model.lazy="form.password_confirmation" class="form-control">
              @error('form.password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <button class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>