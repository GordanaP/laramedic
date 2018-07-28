<div class="modal" tabindex="-1" role="dialog" id="profileAchievementsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-diamond mr-1"></i>
                    <span>Professional achievements</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <div class="modal-body">
                <p class="required-fields mb-18">* Required field.</p>

                <form id="profileAchievementsForm">
                    <div class="form-group">
                        <label for="achievements">Achievements</label>
                        <textarea name="achievements" id="achievements" rows="5" class="form-control" placeholder="Enter achievements"></textarea>

                        <span class="invalid-feedback achievements"></span>
                    </div>
                </form>
            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAchievements">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>