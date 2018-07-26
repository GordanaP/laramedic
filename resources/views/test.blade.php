@extends('layouts.admin')

@section('title', ' | Admin | Test')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" />
@endsection

@section('content')

    <div class="container">

        <h1>Test Page</h1>

        <button type="button" class="btn btn-info" id="openModal">Open Modal</button>

        <div class="modal" tabindex="-1" role="dialog" id="timepickerModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="start" class="form-control" id="start" placeholder="00:00" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

    <script>

        $(document).on('click', '#openModal', function(){
            $('#timepickerModal').modal('show');
        })

        $('#start').timepicker({
            'show2400': true,
            'timeFormat': 'H:i',
            'minTime': '09:00',
            'maxTime': '20:00',
            'step' : 60,
            'disableTextInput': true,
            'selectOnBlur': true
        });

    </script>



@endsection