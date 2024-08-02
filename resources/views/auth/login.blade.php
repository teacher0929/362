@extends('layouts.app')
@section('title') Login @endsection
@section('content')
    <div class="py-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="h3 text-center">
                    Login
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
                        @error('username')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <button class="btn btn-success" type="button" id="btnPassword" value="0"><i class="bi-eye-slash"></i></button>
                        </div>
                        @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                        <script>
                            document.getElementById('btnPassword')
                                .addEventListener('click', function () {
                                    if (this.value === '0') {
                                        this.previousElementSibling.setAttribute('type', 'text');
                                        this.classList.add('btn-danger');
                                        this.classList.remove('btn-success');
                                        this.firstElementChild.classList.add('bi-eye');
                                        this.firstElementChild.classList.remove('bi-eye-slash');
                                        this.value = 1;
                                    } else {
                                        this.previousElementSibling.setAttribute('type', 'password');
                                        this.classList.add('btn-success');
                                        this.classList.remove('btn-danger');
                                        this.firstElementChild.classList.add('bi-eye-slash');
                                        this.firstElementChild.classList.remove('bi-eye');
                                        this.value = 0;
                                    }
                                });
                        </script>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
