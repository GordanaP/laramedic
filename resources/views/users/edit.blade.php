@extends('layouts.app')

@section('title', ' | My Account')

@section('content')
    <div class="container">

        <h1>My Account</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <a href="#" class="list-group-item hover:bg-grey-lightest hover:text-teal">Profile</a>
                    <a href="#" class="list-group-item hover:bg-grey-lightest hover:text-teal list-group-active ">Account Settings</a>
                    <a href="#" class="list-group-item hover:bg-grey-lightest hover:text-teal-dark">Notifications</a>
                    <a href="#" class="list-group-item hover:bg-grey-lightest hover:text-teal">Subscription</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-petroleum text-white">
                        <i class="icon icon-lock mr-2"></i>
                        <span class="uppercase font-medium tracking-wide">Account Settings</span>
                    </div>

                    @include('users.forms._edit_html')

                </div>
            </div>
        </div>
    </div><!-- /.Container -->
@endsection

@section('scripts')
    <script>

        var email = $(".icon-email");
        var password = $(".icon-password");
        var passwordConfirm = $(".icon-password-confirm");

        iconNotification(email, 'max 100 chars; email format')
        iconNotification(password, 'min 6 char')
        iconNotification(passwordConfirm, 'must match the password')

        removeErrorOnNewInput()

    </script>
@endsection