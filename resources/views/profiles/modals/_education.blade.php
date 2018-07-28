<div class="modal" tabindex="-1" role="dialog" id="profileEducationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-graduation mr-1"></i>
                    <span>Edit education</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <div class="modal-body">
                <p class="required-fields mb-18">* Required field.</p>

                <form id="profileEducationForm">
                    <div class="form-group">
                        <label for="education">Education</label>
                        <textarea name="education" id="education" rows="5" class="form-control" placeholder="Enter education"></textarea>

                        <span class="invalid-feedback education"></span>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-profile" id="saveEducation">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>