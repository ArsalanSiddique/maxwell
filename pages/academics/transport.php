<?php 


?>
				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Transport</a></li>
					</ul>
				</div>

				<ul class="nav nav-tabs">
					<li class="active"><a href="#lists" data-toggle="tab">Transport Lists</a></li>
					<li><a href="#add_list" data-toggle="tab">Add Transport</a></li>
				</ul>
				<div class="tab-content">
					<div id="lists" class="tab-pane fade in active" style="padding-top: 10px;">
						<div class="thumbnail" style="padding:20px;">
							<table id="example" class="table table-bordered table-stripped">
								<thead>
									<tr>
										<th>Route Name</th>
										<th>Number Of Vehicle</th>
										<th>Description</th>
										<th>Route Fair</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</div>
					<div id="add_list" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<div class="col-sm-6" style="padding-top: 20px;">
									<form action="" method="post" class="form-group thumbnail" style="padding: 20px;">
										<div class="form-group">
											<label for="route_name">Route name</label>
											<input type="text" name="name" id="" class="form-control">
										</div>
										<div class="form-group">
											<label for="number_vehical">Number Vehical</label>
											<input type="text" name="vehicals" id="" class="form-control">
										</div>
										<div class="form-group">
											<label for="description">Description</label>
											<input type="text" name="description" id="" class="form-control">
										</div>
										<div class="form-group">
											<label for="route_fair">Route Fair</label>
											<input type="text" name="route_fair" id="" class="form-control">
										</div>
										<input type="submit" value="Add Transport" name="addTransport" class="btn btn-success" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>