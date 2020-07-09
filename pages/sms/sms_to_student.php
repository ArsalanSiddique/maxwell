				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Sms To Student</a></li>
					</ul>
				</div>

				<!-- Sms To Student -->
				<form action="" method="post" class="form-inline" style="margin-top:40px;">
				<div class="row">
					
						<div class="form-group col-md-3">
							<label for="class">Class</label><br>
							<select name="class" class="form-control" id="" style="width:100%;">
								<option value="">Select Class</option>
								<?php
									$object->class_options();
								?>
							</select>
						</div>
						<div class="form-group col-md-3" style="padding-left:10px;">
							<label for="section">Section</label>
							<select name="section" class="form-control" id="" style="width:100%;">
								<option value="">Select Section</option>
								<?php
									$object->section_options();
								?>
							</select>
						</div>
						<div class="form-group col-md-3" style="padding-left:10px">						
							<input type="submit" name="load_student" class="btn btn-info" style="margin-top:23px;" value="Load Students" />
						</div>
					
				</div>

				<div class="row" style="margin-top:30px;">
					<div class="col-md-6">
						<form action="" method="post" class="form-group" id="resetform">
							<div class="form-group">
								<label for="" class="pull-left">Message</label>
								<textarea class="form-control" name="" id="" cols="60" rows="10"></textarea>
							</div>
							<div class="form-group" style="margin-top:15px;">
								<input type="submit" class="btn btn-default" value="Send Sms" />
								<input type="button" class="btn btn-default" value="Clear" onclick="resetFunction()" />
								<p>Characters: <span class="text-danger">00</span></p>
							</div>
						</form>
					</div>
					<div class="col-md-6" style="margin-top:50px;">
						<div class="count pull-left">
							<p class="text-info" style="font-size:40px;color:green;">00</p>
							<h3>Students Selected</h3>
						</div>
					</div>
				</div>
				
				<div class="row"> <hr /> </div>

				<!-- Student Details -->
				<div class="row" style="margin:0px 00px 0px 02px;">
					<button type="button" class="btn btn-default"><i class="fa fa-check"> &nbsp </i>Mark All Students</button>
				</div>

				<!-- Details Table -->
				<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;"> 
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					    <thead>
					        <tr>
						        <th>Status</th>
						        <th>Name</th>
						        <th>Email</th>
						        <th>Phone</th>
								<th>Photo</th>
						    </tr>
						</thead>
						<tbody>
							<?php	
								if(isset($_POST["load_student"])) {
									extract($_POST);
									$object->sts($class, $section); 
								}
							?>
						</tbody>
					</table>
				</div>
				</form>
				<div class="row"></div>
