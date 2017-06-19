<?php
require_once('connect.php');
?>

<html>
<head>
	<title>Displaying MySQL Data in HTML Table</title>
	<link rel="stylesheet" type="text/css" href="./css/w3css.css">
</head>
<body>

    <div class="w3-container">
    	<div class="w3-row w3-padding-xxlarge">
    		    
						<?php

						  echo '
						  <table class="w3-table w3-striped">
					
							<!-- <caption class="title">Table Caption</caption> -->
							
							<thead>
								<tr>
								    <th>S.No.</th>
									<th>Institute Number</th>
									<th>Institute Name</th>
								</tr>
							</thead>
							
							<tbody>
						  ';

				          $sql = "SELECT it.instituteName, cs.score  
						   		  FROM coursescoretable cs, institutetable it 
								  WHERE (cs.iNo = it.iNo) AND (cs.cNo = 115) AND (cs.score < 2000);";

						  $query = mysqli_query($conn, $sql);

						  if(!$query){
						  	die("SQL Error".mysqli_errno($conn));
						  }

				          $no = 1;
					   	  while ($row = mysqli_fetch_array($query))
							{
								
								echo '<tr>
								        <td>'.$no.'</td>
										<td>'.$row['instituteName'].'</td>
										<td>'.$row['score'].'</td>
						              </tr>';

						              $no++;
						  }

						  echo '
						    </tbody>

						    <!-- <tfoot>
								<tr>
									<th colspan="2">TOTAL</th>
									<th>44</th>
								</tr>
						    </tfoot> -->
					      </table>
						  ';
						?>
							
        </div>
    </div>
	
	
</body>
</html>