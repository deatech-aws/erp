<div class="modal right fade" id = "modal_create_user" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-full-height modal-right modal-notify modal-info bd-gradient-black" role= "document">
			<div class="modal-content">
      <div class="modal-header" style="height:85px">
        <div class="text-left text-green" style="margin-top:10px;font-size:16px">
          <b>YOU ARE CREATING:</b>
          <h4 class="modal-title text-green" id="my_rta"> <b>A NEW USER ACCOUNT</b></h4> </div>
        <button class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-30px"><span aria-hidden="true">&times</span>
        </button>
        <!-- <h3 class="modal-title" id="my_rta"> <b>Confirmation of Result</b></h3> -->
      </div>
      <div class="modal-body bg-grey-transparent-2" style="margin-top:0px">
        <!-- <form action="" method="POST" class="margin-bottom-0"> -->
            <label class="control-label">Account Name <span class="text-danger">*</span></label>
              <div class="row m-b-15">
                <div class="col-md-12">
                    <input type="text" id="acct_name" name="acct_name" class="form-control input-lg" placeholder="First name" required />
                </div>
                <!-- <div class="col-md-6 m-b-15">
                    <input type="text" id="t_lname" name="lname" class="form-control input-lg" placeholder="Last name" required />
                </div> -->
            </div>
            <label class="control-label">Phone Number <span class="text-danger">*</span></label>
            <!-- <label class="control-label" style="margin-left:115px">Phone Number <span class="text-danger">*</span></label> -->
              <div class="row m-b-15">
              <div class="col-md-12">
                    <input type="text" id="acct_phone" name="acct_phone" class="form-control input-lg" placeholder="Phone no" required />
                </div>
            </div>
            <label class="control-label">Email (Username) <span class="text-danger">*</span></label>
            <div class="row m-b-15">
                <div class="col-md-12">
                    <input type="text" id="acct_email" name="acct_email" class="form-control input-lg" placeholder="Email address" required />
                </div>
            </div>
            <label class="control-label">Re-enter Email <span class="text-danger">*</span></label>
            <div class="row m-b-15">
                <div class="col-md-12">
                    <input type="text" id="acct_cemail" name="cemail" class="form-control input-lg" placeholder="Re-enter email address" required />
                </div>
            </div>
            <label class="control-label">User Role <span class="text-danger">*</span></label>
            <div class="row m-b-15">
                <div class="col-md-12">
									<select id="usr_role" class="form-control input-lg" name="usr_unit">
									<option value="ADMIN">Admin (DEA)</option>
									<option value="DEAN">Dean</option>
									<option value="FAEO">Faculty Exam Officers</option>
									<option value="FHOD">Heads of Department</option>
									<option value="FDEO">Department Exam Officers</option>
									<option value="SPGS">SPGS Officer</option>
									<option value="HDSS">Help Desk Officers </option>
									<option value="TECHO">Technical Support/Counsellor (Center)</option>
									<option value="MGMT">Management</option>
								</select>
                </div>
            </div>

						<label class="control-label">Center/Faculty/Directorate <span class="text-danger">*</span></label>
						<div class="row m-b-15">
								<div class="col-md-12">
										<select id="usr_unit" class="form-control input-lg" name="usr_unit">

										</select>
								</div>
						</div>
            <br>
            <p class="text-justify" style="font-size:16px;font-style:italic"><b>N:B</b> <br> For Faculty Users (Deans, HODs and Exam Officers), Faculty and Programs MUST be assigned to the user before user can view the respective faculty or program result.</p>

            <div class="register-buttons">
                <button id="btn_usr" class="btn btn-success btn-block btn-lg">Create User</button>
            </div>
            <hr />
            <p class="text-center">
                &copy; National Open University of Nigeria. All Right Reserved 2021
            </p>
        <!-- </form> -->
      </div>
  </div>
</div>
</div>

<!-- /modals -->
