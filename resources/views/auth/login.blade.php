@extends('layouts.app')

@section('content')

<!-- Section: Design Block -->
<section class=" text-lg-start">

  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="{{asset('image/devs.png')}}" alt="Trendy Pants and Shoes"
        class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
    </div>
    <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input  class="form-control  @error('email') is-invalid @enderror"  id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                  <label class="form-label" for="email" style="color:#A9A9A9">Correo Eléctronico</label>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password" />
                <label class="form-label" for="form2Example2" style="color: #A9A9A9">Contraseña</label>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <!-- Password input -->
            <div class="form-outline mb-4">

                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                  <label class="form-check-label" for="form2Example31" style="color: #A9A9A9"> Recuerdame </label>
              </div>

          </div>



          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-block mb-4">Ingresar</button>

      </form>

  </div>
</div>
</div>
</div>
</section>
<!-- Section: Design Block -->
@endsection
