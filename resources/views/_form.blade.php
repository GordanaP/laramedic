<form>
    <section id="days">
        <fieldset class="day" data-order="0">
            <div class="form-group items-center">
                <label>Day</label>
                <div class="flex">
                    <div class="flex-1">
                        <select name="day[]" class="form-control mr-2">
                            <option value="">Select a day</option>
                            @foreach ($days as $day)
                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback day day-0"></span>
                    </div>

                    <div  class="flex-1">
                        <input type="text" class="form-control mr-2" name="start[]" placeholder="start">
                        <span class="invalid-feedback start start-0"></span>
                    </div>

                    <div  class="flex-1">
                        <input type="text" class="form-control mr-2" name="end[]" placeholder="end">
                        <span class="invalid-feedback end end-0"></span>
                    </div>

                    <div>
                        <button type="button" class="btn btn-danger" id="addRow">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </fieldset>
    </section>
</form>
