@extends('layouts.admin')

@section('title', ' | Admin | Profile')

@section('content')

    @admcontent
        @slot('card')

            <div class="card-header admin-card-header p-3 flex align-center">
                <h1 class="font-medium text-4xl ml-3 mb-0">
                    {{ $profile->title_name }} {{ $profile->full_name }}
                </h1>

                <button type="button" class="btn btn-success btn-lg ml-3" id="#">
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

@endsection

@section('scripts')
    <script>

    </script>
@endsection