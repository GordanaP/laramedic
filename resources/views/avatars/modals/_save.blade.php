<div class="modal admin-modal" tabindex="-1" role="dialog" id="avatarModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-user mr-1"></i>
                    <span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="avatarForm">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 mb-12" id="displayAvatar"></div>

                            <div class="col-lg-8 col-sm-8">
                                <div class="form-group">
                                    <label for="avatar_options">Avatar</label>
                                    <select name="avatar_options" id="avatar_options" class="form-control">
                                        <option value="">Choose one</option>
                                        <option value="1">New avatar</option>
                                        <option value="2">Default avatar</option>
                                    </select>

                                    <span class="invalid-feedback avatar_options"></span>
                                </div>

                                <div class="form-group mt-30">
                                    <input type="file" class="avatar" name="avatar" id="avatar" />
                                    <p><span class="invalid-feedback avatar"></span></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-account admin-modal-btn" id="saveAvatar">Save changes</button>
                    <button type="button" class="btn  btn-secondary admin-modal-btn-close" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>