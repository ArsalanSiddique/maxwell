<div class="row">
	<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><a href="#">Add Teacher</a></li>
	</ul>
</div>

<div class="container-fluid">
	<div class="row">

		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-plus"></i> &nbsp Add Teacher
			</div>
			<div class="panel-body">
				<form action="php/hr/hr.php" method="POST" class="form-group" enctype="multipart/form-data">
					<div class="col-md-7">
						<fieldset>
							<legend>Teacher Details</legend>
							<div class="form-group">
								<label for="">Name <span class="red_required">*</span></label>
								<input type="text" name="name" id="" class="form-control" placeholder="Name" required="required">
							</div>
							<div class="form-group">
								<label for="">Cnic <span class="red_required">*</span></label>
								<input type="number" name="cnic" id="" class="form-control" placeholder="42401xxxxxxxx" required="required">
							</div>
							<div class="form-group">
								<label for="">Phone <span class="red_required">*</span></label>
								<input type="number" name="phone" id="" class="form-control" placeholder="03xxXXXXXXXX" required="required">
							</div>
							<div class="form-group">
								<label for="">Gender <span class="red_required">*</span></label>
								<select name="gender" id="" class="form-control" required="required">
									<option value="">Select Gender</option>
									<option value="male">Male</option>
									<option value="female">female</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Password <span class="red_required">*</span></label>
								<input type="Password" name="password" id="" class="form-control" placeholder="password" required="requried">
							</div>
						</fieldset>
					</div>
					<div class="col-md-5">
						<fieldset>
							<legend>Other Details</legend>
							<div class="form-group">
								<label for="">Father Name</label>
								<input type="text" name="f_name" id="" class="form-control" placeholder="Father Name">
							</div>

							<div class="form-group">
								<label for="">Email</label>
								<input type="email" name="email" id="" class="form-control" placeholder="Email">
							</div>

							<div class="form-group">
								<label for="">Birth</label>
								<input type="date" name="dob" id="" class="form-control" />
							</div>

							<div class="form-group">
								<label for="">Address</label>
								<input type="text" name="address" id="" class="form-control" placeholder="Address">
							</div>
						</fieldset>
						<fieldset>
							<legend>Profile Photo</legend>
							<div class="form-group">
								<label>Upload Image</label>
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file">
											Browse… <input type="file" name="file" id="imgInp">
										</span>
									</span>
									<input type="text" name="file" class="form-control" readonly>
								</div>
								<img id='img-upload' />
							</div>
							<div class="form-group">
								<div class="row">
									<br />
									<input type=button value="Take Snapshot" class="btn btn-primary" onClick="take_snapshot()">
									<input type="hidden" name="image" class="image-tag">

									<div id="results">Your captured image will appear here...</div>
									<div id="my_camera"></div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="row">
						<input type="submit" name="add_teacher" class="btn btn-md btn-primary" style="margin-left: 24px;" value="Add Teacher">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>