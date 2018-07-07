<form action="{{ route('users.update') }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card-body">
        <div class="row mt-4 mb-4">
            <div class="col-md-4">
                <div class="font-medium">Access Credentials</div>
                <div class="text-muted small mt-1">The credentials are required to access the site content.</div>
            </div>

            <div class="col-md-8">

                <!-- Email -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="email" class="font-medium">E-Mail Address <sup><i class="fa fa-asterisk text-red text-xs"></i></sup> <i class="icon icon-question text-sm font-medium icon-email"></i></label>

                            <input type="text" class="email form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="example@domain.com" value="{{ old('email') ?: $user->email }}" />

                            @if ($errors->has('email'))
                                <span class="invalid-feedback email">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="password" class="font-medium">Password  <i class="icon icon-question text-sm font-medium ml-1 icon-password"></i></label>

                            <input type="password" class="password form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"  id="password" name="password" placeholder="Choose your password" />

                            @if ($errors->has('password'))
                                <span class="password invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Confirm password -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="password-confirm" class="font-medium">Confirm Password <i class="icon icon-question text-sm font-medium ml-1 icon-password-confirm"></i></label>
                            <input type="password" class="form-control"  id="password-confirm" name="password_confirmation" placeholder="Retype password">
                        </div>
                    </div>
                </div>

            </div><!-- /.col-md-8 -->
        </div><!-- /.row -->
    </div><!-- /.card-body -->

    <div class="card-footer text-right" style="border: 1px solid #f1f1f1">
        <button type="submit" class="btn btn-orange text-white hover:bg-orange-dark hover:border-orange-dark">
            <span class="font-medium uppercase">Save changes</span>
        </button>
    </div>
</form>