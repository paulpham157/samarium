<div class="border p-3 mb-3">

  <h2 class="h5 o-heading mb-3">
    Any question?
  </h2>

  @if (session()->has('message'))
    {{-- Flash message div --}}
    <div class="p-2">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>
          <h2 class="h4 font-weight-bold">
            <i class="fas fa-check-circle mr-1"></i>
            Thank you!
          </h2>
          <p>
            Thank you for submitting your enquiry. We will get back
            to you soon.
          </p>
        </div>
        <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
          <span class="text-success" aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  @endif

  <div class="form-group">
    <input class="form-control" type="text" placeholder="Name" wire:model="writer_name">
    @error('writer_name')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group">
    <input class="form-control" type="text" placeholder="Email" wire:model="writer_email">
    @error('writer_email')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group">
    <input class="form-control" type="text" placeholder="Phone" wire:model="writer_phone">
    @error('writer_phone')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group">
    <textarea class="form-control" rows="3" placeholder="Question" wire:model="question_text"></textarea>
    @error('question_text')
      <span class="text-danger" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  <button class="btn btn-primary btn-block py-2"
              style="
                  @if ($cmsTheme)
                  background-image:
                      linear-gradient(
                          to bottom right,
                          {{ $cmsTheme->ascent_bg_color }},
                          {{ $cmsTheme->ascent_bg_color }}
                      );
                      color: {{ $cmsTheme->ascent_text_color }};
                  @else
                    background-color: #123;
                    color: white;
                  @endif
                  "
              wire:click="store"
  >
    Submit
  </button>
  <br/>

</div>
