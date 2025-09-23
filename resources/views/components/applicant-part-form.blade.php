<div class="row">
    <div class="col-md-9 col-12 mb-3">
        <label class="form-label">Applicant ID</label>
        <input type="text" class="form-control"
            placeholder="Applicant ID" name="idcode" id="applicant_idcode" readonly required>
        <input type="hidden" class="form-control" name="applicant_profile_id" id="applicant_profile_id">
    </div>
    <div class="col-md-3 col-12 mb-3" id="browseApplicantContainer">
        <button type="button" class="btn btn-danger mt-md-4" onclick="$('#modalBrowseApplicant').modal('show')">
            BROWSE
        </button>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control"
            placeholder="Full Name" name="fullname" id="user_name" disabled>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Email</label>
        <input type="text" class="form-control"
            placeholder="Email" name="email" id="user_email" disabled>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Mobile Phone</label>
        <input type="text" class="form-control"
            placeholder="Mobile Phone" name="mobile_phone" id="user_mobile_phone" disabled>
    </div>
</div>
