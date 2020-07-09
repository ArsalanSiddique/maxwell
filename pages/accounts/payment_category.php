				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Payment Category</a></li>
					</ul>
				</div>
				
				<!-- Add Category Button -->
				<div class="container-fluid">
					<button class="btn btn-default pull-right" data-toggle="modal" data-target="#payment_category">
						<i class="fa fa-plus"></i> &nbsp Add Fee Category
					</button>
				</div>

				<!-- #add_payment_category -->
					<div id="payment_category" class="modal fade col-md-6" style="margin-top: 20px; margin-left: 25%; display: block; padding-right: 10px; role="dialog">
						<div class="dialog">
							<div class="modal-content">
								<div class="modal-header">
									<p>School Name</p>
								</div>
								<div class="modal-body">
									<h4><i class="fa fa-plus"></i>&nbsp Add Payment Category</h4>
									<form action="php/add_payment_category.php" method="post" class="form-group thumbnail" style="">
										<div class="form-group">
											<label for="">Name</label>
											<input type="text" name="name" id="" class="form-control" placeholder="Name" />
											<input type="hidden" name="category" value="payment" id="" />
										</div>
										<div class="row">
											<input type="submit" name="payment_category" class="btn btn-success" style="margin-left:20px;" value="Add">
										</div>
									</form>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
									</div>
							</div>
						</div>
					</div>	
				<!-- student payment category table -->
				<div class="table-responsive thumbnail" style="margin-top: 10px;padding: 10px;padding-bottom: 50px;"> 
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					          	<th>#</th>
					            <th>Name</th>
					            <th>Options</th>
						    </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>