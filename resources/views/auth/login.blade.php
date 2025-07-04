<!doctype html>

{{--
|
| Login page blade file.
|
| This is the blade file of our login page. Many options from default laravel
| login page are removed or disabled. Please modify this file if you need
| any changes.
|
--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100% !important;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Chartjs -->
  <script src="{{ asset('js/chart.js') }}"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom-style.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.css') }}" rel="stylesheet">

  <style>
    html, body {
      overflow-x: hidden;
    }
  </style>

  <!-- Livewire -->
  @livewireStyles
</head>

<body style="height: 100% !important; background-color: #f0f0f0;">
  <div class="h-100 d-flex justify-content-center h-100">
    <div class="d-flex flex-column justify-content-center col-md-3">
      <div class="px-3 bg-white border shadow-sm">
        <div class="d-flex p-3">
          <div class="d-flex flex-column justify-content-center mr-2">
            @if ($company)
              <img src="{{ asset('storage/' . $company->logo_image_path) }}"
                  class="img-fluid"
                  alt="{{ $company->name }} logo"
                  style="height: 40px !important;">
            @else
              <i class="fas fa-user-circle fa-2x mr-2"></i>
            @endif
          </div>
          <div class="h4 my-3 o-heading">
            Login
          </div>
        </div>

        <div class=" d-flex">
          <div class="px-3 py-3 w-100">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{--
                | 
                | User email
                |
                --}}
                <div class="form-group mb-3">
                  <label class="o-heading">
                    Email
                  </label>
                  <input id="email" type="email"
                      class="form-row form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ old('email') }}"
                      required
                      autocomplete="email"
                      {{--
                      placeholder="Email"
                      --}}
                      autofocus>

                  @error ('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                {{--
                | 
                | Password
                |
                --}}
                <div class="form-group mb-2">

                    <label class="o-heading">
                      Password
                    </label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required
                        {{--
                        placeholder="Password"
                        --}}
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{--
                | 
                | Remember option
                |
                --}}
                {{--
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                --}}

                {{--
                | 
                | Login button
                |
                --}}
                <div class="form-group mt-4 mb-2">
                    <button type="submit" class="btn btn-dark btn-block py-3 text-white"
                        style="">
                        {{ __('Login') }}
                    </button>

                    {{--
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    --}}
                </div>

            </form>
          </div>
        </div>
      </div>

      {{--
      | 
      | Display version at bottom
      |
      --}}
      <div class="px-3 my-4">
        <div class="text-center text-muted">
          <small>
            v0.9.6
          </small>
        </div>
      </div>
    </div>
  </div>

  <!-- Livewire scripts -->
  @livewireScripts
</body>
</html>
