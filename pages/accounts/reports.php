				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Reports</a></li>
					</ul>
				</div>
				<div class="thumbnail" style="padding:20px;">
					<div class="row">
						<form action="" class="form-inline" method="post" align="">
							<div class="form-group col-md-2">
								<label for="status">Select Status:</label><br>
								<select name="status" class="form-control" id="" style="width:100%;">
									<option value="active">Active</option>
									<option value="in-active">In Active</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="status">Select Class:</label><br>
								<select name="class" class="form-control" id="" required="required" style="width:100%;">
									<option value="">Select</option>

								</select>
							</div>
							<div class="form-group col-md-2">
								<label for="status">Select Section:</label><br>
								<select name="section" class="form-control" id="" required="required" style="width:100%;">
									<option value="">Select</option>

								</select>
							</div>
							<div class="form-group col-md-2">
								<br />
								<input type="submit" id="" name="info" class="btn btn-primary" value="Show Student Details" />
							</div>
						</form>
						<br />
						<div class="form-group" style="margin-right:15px;">
							<a href="index.php?page=academics/students/admit_student"><button type="submit" id="" class="btn btn-primary">
									<span class="fa fa-plus"></span>&nbsp Add Student
								</button></a>
						</div>
					</div>
				</div>

				<div class="table-responsive thumbnail" style="margin-top:50px;padding:20px;">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Roll No</th>
								<th>Admis.No.</th>
								<th>Class</th>
								<th>Section</th>
								<th>DOJ(d-m-y)</th>
								<th>Name</th>
								<th>Father Name</th>
								<th>Gender</th>
								<th>DOB(d-m-y)</th>
								<th>Religion</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>