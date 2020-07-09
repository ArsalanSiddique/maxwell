				 <script>
				$(function () {
					//lets use the jQuery Keyboard Event to catch the text typed in the textbox 
					$('#txtbox').keyup(function () {
						//.val() will give the text from the textbox and .length will give the number of characters
						var txtlen = $(this).val().length;
						//.replace used here to replace the space in the string and .length is to count the characters
						var txtlennospace = $(this).val().replace(/\s+/g, '').length;
						//the below lines will display the results 
						$('#txtbox_count').text(txtlen);
						$('#txtbox_count_no_space').text(txtlennospace);
	 
					});
				});
			</script>
				<div class="row">
					<ul class="breadcrumb" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="active"><a href="#">Annoucements</a></li>
					</ul>
				</div>

				<!-- Sms To Student -->
				<div class="row">
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
						<div class="form-group col-md-3" style="padding-left:10px;">
							<label for="section">Select Message</label>
								<select name="promotion_from_class" class="form-control" id="" style="width:100%;">
								<option value="">Festival</option>
								<option value="">Annual Celebrations</option>
								<option value="">Holiday Meassage</option>
								<option value="">Parents Meeting</option>
							</select>
						</div>
					</form>
				</div>

				<div class="row" style="margin-top:30px;">
					<div class="col-md-6">
						<form action="" method="post" class="form-group" id="resetform">
							<div class="form-group">
								<label for="" class="pull-left">Message</label>
								<textarea class="form-control" name="" id="" cols="70" rows="10"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-default" value="Send Sms" />
								<input type="button" class="btn btn-default" value="Clear" onclick="resetFunction()" />
								<p>Characters: <span class="text-danger">00</span></p>
							</div>
						</form>
					</div>
				</div>
				
				<div class="row"> <hr /> </div>
