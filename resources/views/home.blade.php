@extends('layouts.app')

@section('title', '| Admin | Home')

@section('content')

    <div class="container" id="appContainer">
        <div class="row">
            <div class="col-md-3">
                @foreach ($doctors as $doctor)
                    <p>
                        <a href="{{ route('admin.appointments.index', $doctor) }}">
                            Dr {{$doctor->full_name}}
                        </a>
                    </p>
                @endforeach
            </div>

            <div class="col-md-9">
                <div class="card card-default bg-yellow">
                    <table class="table table-bordered bg-white mb-0 daily-calendar">
                        <p class="p-3 font-bold text-lg">Morning</p>
                        <thead class="bg-grey-lighter">
                            <th>Time</th>
                            @foreach ($doctors as $doctor)
                                <th>
                                    <a href="#" class="uppercase">
                                        {{ $doctor->full_name }}
                                    </a>
                                </th>
                            @endforeach
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection