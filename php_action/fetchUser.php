<?php 	



require_once 'core.php';

$sql = "SELECT * FROM users";

$result = $connect->query($sql);

$output = array('data' => array());
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$userid = $row[0];
 	// active 
 	$username = $row[1];
 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$role = "<label class='label label-primary'>admin</label>";
 	} else {
 		// deactivate member
 		$role = "<label class='label label-success'>staff</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    ตั้งค่า <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <!--<li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser('.$userid.')"> <i class="glyphicon glyphicon-edit"></i> แก้ไข</a></li>-->
	    <li><a type="button" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser('.$userid.')"> <i class="glyphicon glyphicon-trash"></i> ลบข้อมูล</a></li>       
	  </ul>
	</div>';

	

 	$output['data'][] = array( 		
 		// name
 		$username,
		$row[3],
		$role,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);