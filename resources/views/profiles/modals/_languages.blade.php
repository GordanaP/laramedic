<div class="modal" tabindex="-1" role="dialog" id="profileLanguagesModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-language mr-1"></i>
                    <span>Foreign languages</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <div class="modal-body">
                <p class="required-fields mb-18">* Required field.</p>

                <form id="profileLanguagesForm">
                    <div class="form-group">
                        <label for="languages">Languages</label>
                        <input type="text" name="languages" id="languages"  class="form-control" placeholder="Enter languages" />
                        <span class="invalid-feedback languages"></span>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveLanguages">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>