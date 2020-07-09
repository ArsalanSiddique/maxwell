				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Sms To Teacher</a></li>
					</ul>
				</div>
				<form action="" method="post" class="form-group" id="resetform">
					<div class="row" style="margin-top:30px;">
						<div class="col-md-6">
								<div class="form-group">
									<label for="" class="pull-left">Message</label>
									<textarea class="form-control" name="" id="" cols="70" rows="10"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-default" value="Send Sms" />
									<input type="button" class="btn btn-default" value="Clear" onclick="resetFunction()" />
									<p>Characters: <span class="text-danger">00</span></p>
								</div>
						</div>
						<div class="col-md-6" style="margin-top:50px;">
							<div class="count pull-left">
								<p class="text-info" style="font-size:40px;color:green;">00</p>
								<h3>Teachers Selected</h3>
							</div>
						</div>
					</div>
					
					<div class="row"> <hr /> </div>

					<!-- Student Details -->
					<div class="row" style="margin:0px 00px 0px 02px;">
						<button type="button" class="btn btn-default"><i class="fa fa-check"> &nbsp </i>Mark All Teachers</button>
					</div>

					<!-- Details Table -->
					<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;"> 
								<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Status</th>
											<th>Name</th>
											<th>Class</th>
											<th>Phone</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody> <?php $object->sms_teacher(); ?> </tbody>
								</table>
					</div>
				</form>
				<div class="row"></div>