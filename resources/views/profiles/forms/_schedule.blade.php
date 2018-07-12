<form id="scheduleForm">

    <div class="modal-body">

        <section id="scheduleSection">

            <div class="form-group">
                <label>Day #1</label>
                <div class="flex" id="field-0">
                    <select type="text" class="form-control mr-1" name="day[0]['day_id']">
                        <option value="">Select a day</option>
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}">
                                {{ $day->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control mr-1" placeholder="00:00" name="day[0]['start_at']">

                    <input type="text" class="form-control mr-1" placeholder="00:00" name="day[0]['end_at']">

                    <button type="button" class="btn btn-default bg-grey btn-schedule" id="addRow"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <!-- Append dynamic fields here -->

        </section>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="storeSchedule">Save changes</button>
    </div>

</form>