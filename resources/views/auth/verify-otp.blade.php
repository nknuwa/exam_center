@extends('layouts.guest')

@section('content')

<div class="container mt-5">

    <div class="card">

        <div class="card-header">

            Verify OTP

        </div>

        <div class="card-body">
            @if(session('otp'))
    <div class="alert alert-info">
        Test OTP: {{ session('otp') }}
    </div>
@endif

            <form method="POST"
                  action="{{ route('verify.otp') }}">

                @csrf

                <input type="hidden"
                       name="phone_no"
                       value="{{ session('phone') }}">

                <div class="mb-3">

                    <label>OTP</label>

                    <input
                        type="text"
                        name="otp"
                        class="form-control"
                        maxlength="6"
                        required>

                </div>

                @error('otp')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

                <button class="btn btn-primary">

                    Verify OTP

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
