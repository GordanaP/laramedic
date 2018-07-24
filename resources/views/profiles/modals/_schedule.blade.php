<div class="modal schedule-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="scheduleForm">

                    <section id="days">
                        <fieldset id="0">
                            <div class="flex">
                                <div class="flex">
                                    <div class="form-group flex-1 mr-1">
                                        <label class="day-label">Day #1</label>
                                        <select name="day[0][day_id]" class="form-control">
                                            <option value="">Select a day</option>
                                            @foreach ($days as $day)
                                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback day day-0"></span>
                                    </div>

                                    <div class="form-group flex-1 mr-1">
                                        <label>Start</label>
                                        <input type="text" name="day[0][start_at]" class="form-control" placeholder="00:00" />
                                        <span class="invalid-feedback start start-0"></span>
                                    </div>

                                    <div class="form-group flex-1 mr-1">
                                        <label>End</label>
                                        <input type="text" name="day[0][end_at]" class="form-control" placeholder="00:00">
                                        <span class="invalid-feedback end end-0"></span>
                                    </div>
                                </div>
                                <div class="mt-26">
                                    <button type="button" class="btn btn-primary" id="addRow"><i class="fa fa-plus" ></i></button>
                                </div>
                            </div>
                        </fieldset>
                    </section>

                </form>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveSchedule">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>