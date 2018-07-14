<form id="scheduleForm">
    <div class="modal-body">
        <div id="sections">
            <div class="form-row section">
                <div class="flex items-center" id="0">
                <div class="form-group flex-1 mr-1">
                        <label for="">Day</label>
                        <select name="day[0][day_id]" class="form-control mr-1">
                            <option value="">Select a day</option>
                            @foreach (\App\Day::all() as $day)
                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group flex-1 mr-1">
                        <label for="">Start</label>
                        <input name="day[0][start_at]" type="text" class="form-control mr-1" placeholder="00:00" />
                    </div>
                    <div class="form-group flex-2">
                        <label for="">End</label>
                        <div class="flex">
                            <input name="day[0][end_at]"type="text" class="form-control mr-1" placeholder="00:00" />
                            <button type="button" class="btn btn-info" id="addMore">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dynamic sections here -->
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-schedule">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>