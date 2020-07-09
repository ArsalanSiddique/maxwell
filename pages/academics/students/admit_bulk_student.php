<div class="row">
	<ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Bulk Students</li>
    </ol>
</div>

   <form method="post" action="php/admit_bulk_student.php" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table" id="item_table">
      <tr>
       <th colspan = 2>
	     <select name="class" class="form-control">
			<option value="">Select Class</option>
		    <?php $object->class_options(); ?>
	     </select>
       </th>
       <th colspan = 2>
          <select name="section" class="form-control">
				<option value="">Select Sections</option>
				<?php $object->section_options() ?>
          </select>
       </th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
      <input type="submit" name="blk_stdnt" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
