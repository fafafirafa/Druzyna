<?php
	$info = "SELECT Informacja FROM o_druzynie WHERE Id=0";
	$daj_info = mysqli_query($db,$info);
	if (mysqli_num_rows($daj_info)) {
							// output data of each row
							while($row = mysqli_fetch_assoc($daj_info)) {
								echo bbcode($row['Informacja']);
							}
						} //else & while