<form id="createAccountForm">
    <div class="modal-body">
        <p class="italic text-sm">
            Fields marked with <sup><i class="fa fa-asterisk text-red-dark"></i></sup> are required.
        </p>

        <div class="row">
            <div class="col-md-4">
                <div class="uppercase tracking-wide font-medium">Profile Information</div>
                <div class="text-muted text-xs">This information is visible to the public.</div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    <!-- First name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="font-medium">First name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="max 30 chars; only letters, numbers & spaces"></i></label>

                            <input type="text" class="form-control admin-modal-input first_name" id="first_name" name="first_name" placeholder="Enter first name" />

                            <span class="invalid-feedback first_name"></span>
                        </div>
                    </div>

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name" class="font-medium">Last name <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="max 30 chars; only letters, numbers & spaces"></i></label>

                            <input type="text" class="form-control admin-modal-input last_name" id="last_name" name="last_name" placeholder="Enter last name" />

                            <span class="invalid-feedback last_name"></span>
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-box">
                            <label for="role_id" class="font-medium">Role  <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="max 2; must not exclude each other"></i></label>

                            <select class="role_id form-control req_place" name="role_id[]" id="role_id" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="invalid-feedback role_id"></span>
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="font-medium">Title <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="max 1"></i></label>

                            <select name="title" id="title" class="form-control title admin-modal-input">
                                <option value="0">Select a title</option>

                                <!-- Append the role-dependent dropdown list -->
                            </select>

                            <span class="invalid-feedback title"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4 mb-4">

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="uppercase tracking-wide font-medium">Access Credentials</div>
                <div class="text-muted text-xs">The new credentails will be sent to the user. The email address requires user verification.</div>
            </div>

            <div class="col-md-8">

                <!-- Email -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="font-medium">E-Mail Address <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="max 100 chars; email format; unique"></i></label>

                            <input type="text" class="form-control email admin-modal-input"  id="email" name="email" placeholder="example@domain.com" />

                            <span class="invalid-feedback email"></span>
                        </div>
                    </div>
                </div>

                <!-- Password-->
                <div class="row">

                    <!-- Checkbox -->
                    <div class="col-md-6">
                        <label for="create_password" class="mb-0 font-medium">Password <sup><i class="fa fa-asterisk text-red-dark fa-required"></i></sup> <i class="icon icon-question" data-toggle="tooltip" data-placement="top" title="min 6 chars when creating manually"></i></label>
                        <div class="form-check mt-2">
                            <input class="form-check-input admin-modal-input" type="checkbox" name="create-password" id="auto_password" value="auto"  checked />
                            <label class="form-check-label" for="auto_password">
                                Auto generate password
                            </label>
                        </div>
                    </div>

                    <!-- Hidden password -->
                    <div class="col-md-6">
                        <div class="form-group" id="hidden_password">
                            <label for=""></label>
                            <input type="password" class="form-control password admin-modal-input" id="password" name="password" placeholder="Give password to the user" />

                            <span class="invalid-feedback password"></span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer mt-2">
        <button type="button" class="btn bg-none admin-modal-button" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-account admin-modal-button" id="storeAccount">Save</button>
    </div>
</form>