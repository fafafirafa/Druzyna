<?php
	$drz = "SELECT Informacja FROM druzyna_informacja";
	$do_zmiany = '';
	$graczeg = mysqli_query($db,$drz);
	if (mysqli_num_rows($graczeg)) {
		// output data of each row
		while($row = mysqli_fetch_assoc($graczeg)) {
			$do_zmiany = $row['Informacja'];
		}
	} //else & while	
