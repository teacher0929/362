@extends('layouts.app')
@section('title') Register @endsection
@section('content')
    <div class="py-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4">
                <div class="h3 text-center">
                    Register
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-success" type="button" id="btnPassword" value="0"><i class="bi-eye-slash"></i></button>
                        </div>
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

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
