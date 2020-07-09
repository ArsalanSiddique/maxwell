				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Fee Due</a></li>
					</ul>
				</div>

				<!-- Fee Dues -->
				<form action="" class="form-inline" style="margin-top:40px;margin-bottom:40px;">
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
							<select name="promotion_from_class" class="form-control" id="" style="width:100%;">
							<option value="">Select Section</option>
							<?php
								$object->section_options();
							?>
						</select>
					</div>
					<div class="form-group col-md-3" style="padding-left:10px">						
						<button type="button" class="btn btn-info" style="margin-top:23px;">Send Sms</button>
					</div>
				</form>
				<div class="row"></div>