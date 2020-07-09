				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li><a href="index.php?page=academics/students/Student_information">Student Information</a></li>
						<li class="active"><a href="#">Student Action</a></li>
					</ul>
				</div>
				
				<!--Student Information Table-->
				<div class="table-responsive thumbnail"> 
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin-bottom:180px;">
				        <thead>
				        	<tr><h2 class="text-primary" align="center">Student Information</h2></tr>
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
							<?php 

								if(isset($_REQUEST["id"])) {
									if(isset($_REQUEST["class"])) {
										if(isset($_REQUEST["section"])) {
											$s_id = $_REQUEST["id"];
											$s_class = $_REQUEST["class"];
											$s_section = $_REQUEST["section"];
											$object->stdnt_id_detail($s_id,$s_class,$s_section);
										}
									}
								}
								
							?>
				        </tbody>
				    </table>
				</div>

				<!--Student Fees Information-->
				<div class="table-responsive thumbnail"> 
					<table class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin-bottom:120px;">
				        <thead>
				        	<tr><h2 class="text-primary" align="center">Student Fees Information</h2></tr>
				            <tr>
				            	<th>#</th>
				                <th>Admis.No.</th>
				                <th>Student</th>
				                <th>Title</th>
				                <th>Total</th>
				                <th>Paid</th>
				                <th>Due</th>
				                <th>Status</th>
				                <th>Date</th>
								<th>Optoins</th>
				            </tr>
				        </thead>
				        <tbody>
							<?php 

								if(isset($_REQUEST["id"])) {
									$stdnt_fee_id = $_REQUEST["id"];
									//$object->stdnt_fee_detail($stdnt_fee_id);
								}
								
							?>
				            <tr>
				            	<td>1</td>
				                <td>reg_01</td>
				                <td>Arsalan Ahmed Siddque</td>
				                <td>Tution Fee</td>
				                <td>1000</td>
				                <td>0</td>
				                <td>1000</td>
				                <td><button type="button" class="btn btn-danger btn-xs">Unpaid</button></td>
				                <td>04-jan-2018</td>
				                <td>
									<div class="btn-group">
			                    		<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action <span class="caret"></span>
			                            </button>
			                            <ul class="dropdown-menu pull-right" role="menu">
			                                <li>
			                                    <a href="#"><i class="entypo-bookmarks"></i>Take Payment</a>
			                                </li>
			                                <li class="divider"></li>
			                                <li>
			                                    <a href="#"><i class="entypo-credit-card"></i>View Invoice</a>
			                                </li>
			                                <li class="divider"></li>
			                                <li>
			                                    <a href="#"><i class="entypo-pencil"></i>Edit</a>
			                                </li>
			                                <li class="divider"></li>
			                                <li>
			                                    <a href="#"><i class="entypo-trash"></i>Delete</a>
			                                </li>
			                                <li class="divider"></li>
			                                <li>
			                                    <a href="" target="_blank"><i class="entypo-docs"></i>Fees Receipt</a>
			                                </li>
			                                <li class="divider"></li>
			                                <li>
			                                	<a href="#" target="_blank"><i class="entypo-docs"></i>Fees History</a>
			                                </li>
			                            </ul>
			                        </div>
								</td>
				            </tr>
				        </tbody>
				    </table>
				</div>

				<div class="row">
					<p align="center" class="text-danger">(Note: If Fee Details are deleted they will be permanently removed from Database. You can't get it back. )</p>
				</div>


						