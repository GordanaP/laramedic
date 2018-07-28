<div class="modal" tabindex="-1" role="dialog" id="profileSpecialtyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-briefcase mr-1"></i>
                    <span>Specialty</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <div class="modal-body">
                <p class="required-fields mb-18">* Required field.</p>

                <form id="profileSpecialtyForm">
                    <div class="form-group">
                        <label for="specialty">Specialty</label>
                        <textarea name="specialty" id="specialty" rows="5" class="form-control" placeholder="Enter specialty"></textarea>

                        <span class="invalid-feedback specialty"></span>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveSpecialty">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>