<div class="modal" tabindex="-1" role="dialog" id="profileHospitalModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-home mr-1"></i>
                    <span>Hospital affiliation</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <div class="modal-body">
                <p class="required-fields mb-18">* Required field.</p>

                <form id="profileHospitalForm">
                    <div class="form-group">
                        <label for="hospital">Hospital</label>
                        <textarea name="hospital" id="hospital" rows="5" class="form-control" placeholder="Enter hospital"></textarea>

                        <span class="invalid-feedback hospital"></span>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveHospital">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>