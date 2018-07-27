<div class="modal admin-modal" tabindex="-1" role="dialog" id="profileNameModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="icon icon-user"></i>
                    <span>Edit profile</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="required-fields mb-18">* Required fields.</p>

                <form id="profileNameForm">

                    <!-- Roles -->
                    <div class="form-group select-box">
                        <label for="roleId" class="font-medium">Role</label>

                        <select class="role_id form-control req_place" name="role_id[]" id="roleId" multiple="multiple" disabled >
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>

                        <span class="invalid-feedback role_id"></span>
                    </div>

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select name="title" id="title" class="form-control">
                            <option value="">Select a title</option>
                        </select>

                        <span class="invalid-feedback title"></span>
                    </div>

                    <!-- First name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter first name">

                        <span class="invalid-feedback first_name"></span>
                    </div>

                    <!-- Last name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter last name">

                        <span class="invalid-feedback last_name"></span>
                    </div>
                </form>

            </div>

            <!-- Buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveProfile">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>