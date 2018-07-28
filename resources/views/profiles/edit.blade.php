@extends('layouts.admin')

@section('title', ' | About')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
    <style>
        #profileDetails p {margin-left: 10px; color: #97a6b4; margin-bottom: 7px;}
    </style>
@endsection

@section('content')

    @admcontent
        @slot('card')

            <!-- Title -->
            <div class="card-header admin-card-header p-3 flex align-center">
                <h1 class="font-medium text-4xl ml-3 mb-0">
                    <span id="profileName">
                        {{ $profile->title_name }} {{ $profile->full_name }}
                    </span>
                </h1>

                <button type="button" class="btn btn-success btn-lg ml-3" id="editProfileName">
                    Change
                </button>
            </div>

            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card admin">

                            <!-- Avatar -->
                            @include('profiles.html._avatar')

                            <!-- Schedule -->
                            @include('profiles.html._schedule')

                        </div>
                    </div>

                    <div class="col-md-8 pl-3">

                        <!-- Details -->
                        @include('profiles.html._details')

                    </div>
                </div>
            </div>
        @endslot
    @endadmcontent

    @include('profiles.modals._schedule');
    @include('profiles.modals._name');
    @include('profiles.modals._specialty');
    @include('profiles.modals._education');
    @include('profiles.modals._achievements');
    @include('profiles.modals._hospital');
    @include('profiles.modals._languages');
    @include('avatars.modals._save');

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>

        // Profile
        var showProfileUrl = "{{ route('admin.profiles.show', $profile->id) }}";
        var profileUrl = "{{ route('admin.profiles.show', $profile->id) }}";

        // Schedule
        @include('profiles.js.schedule._all');

        // Name
        @include('profiles.js.name._all');

        // Specialty
        @include('profiles.js.specialty._all');

        // Education
        @include('profiles.js.education._all');

        // Achievements
        @include('profiles.js.achievements._all');

        // Hospital
        @include('profiles.js.hospital._all');

        // Languages
        @include('profiles.js.languages._all');

        // Avatar
        @include('avatars.js._all');

    </script>
@endsection