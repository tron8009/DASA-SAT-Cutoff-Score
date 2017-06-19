<?php
  error_reporting(0);
  require_once('connect.php');
?>

<?php
	
	if(isset($_POST['search'])){
		
		//Details From Student
		$instituteNo = @trim(stripslashes($_POST["instituteOption"]));
		$courseNo = @trim(stripcslashes($_POST["courseOption"]));
		$score = @trim(stripcslashes($_POST["score"]));

		$model = 0;

        if( empty($courseNo) && empty($score)) {
        	$model = 4;
        }
        else if( empty($instituteNo) && empty($score)) {
        	$model = 5;
        }
        else if( empty($instituteNo) && empty($courseNo)) {
        	$model = 6;
        }
        else if(empty($score)){
           $model = 1;
        }
        else if(empty($instituteNo)){
           $model = 2;
        }
        else if(empty($courseNo)){
           $model = 3;
        }
        else{
        	$model = 0;
        }
        
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>DASA SAT Cutoff Score | DASA 2017 | Direct Admission of Students Abroad</title>
	<link rel="stylesheet" type="text/css" href="./css/w3css.css">
	<link rel="stylesheet" type="text/css" href="./css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,800" rel="stylesheet">
	<script type="text/javascript">
		function validateform(){

            var scoreValue = document.forms["searchForm"]["score"].value;
            var instituteValue = document.forms["searchForm"]["instituteOption"].value;
            var courseValue = document.forms["searchForm"]["courseOption"].value;
             
            if( (instituteValue==null || instituteValue=="") && (courseValue==null || courseValue=="") && (scoreValue==null || scoreValue=="") ){
            	alert("Atleast one field should be filled");
            	return false;
            }
            
            if( (scoreValue<0) || (scoreValue>2400) ){
            	alert("Invalid SAT Score");
            	return false;
            }
            
		}
	</script>
	<style type="text/css">
	    .enteredData{
			font-size: 20px;
			font-weight: 800;
			background-color: yellow;
		}
		.enteredDataCover{
			padding-left: 20px;
			font-family: 'Raleway', sans-serif;
			font-size: 17px;
		}
		.branchPad{
			margin-left:13px;
		}
		.notice{
            font-family: 'Raleway', sans-serif;
            text-align: center;
            font-size: 20px;
            background-color: #f44336;
            color:#fff;
        }
        th,td{
        	font-family: 'Raleway', sans-serif;
        	font-size: 16px; 
        }	
        #ModalChart2, #ModalChart3, #ModalChart4, #ModalChart5, #ModalChart6{
    	 overflow-x: scroll; 
		 overflow-y: hidden;
		
	    }

	</style>

	<!-- Google Chart JS -->
	<script type="text/javascript" src="./js/googleChartLoader.js"></script>
	<!-- Google Chart JS Ends Here -->

	<!-- Bootstrap Essential Files -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Bootstrap Essential Files Ends Here-->

</head>

<body>

 <div id="wrapper" >

       <div class="w3-container"><a class="w3-right w3-blue w3-round-xxlarge w3-margin Raleway" href="instructions.html" style="text-decoration: none;padding: 0px 10px 0px 10px;">Instructions</a></div>
    
	   <form  name="searchForm" onsubmit="return validateform()" action="validate.php" method="POST">

			<div class="w3-row">
			  <h1 class="w3-center">DASA SAT Cutoff Score</h1>

			  <div class="w3-container w3-third">
			      <select class="w3-select w3-border" name="instituteOption">
				    <option class="Raleway" value="" disabled selected> Select Institute</option>
				    <!-- <option class="Raleway" value="0">Empty</option> -->
				    <?php
                      $sql = "SELECT instituteName FROM institutetable;";
                      $query = mysqli_query($conn,$sql);

                      if(!$query){
                        die("SQL Error".mysqli_errno($conn));
                      }
                      $counter = 1;
                      while($row = mysqli_fetch_array($query)){
                          echo '<option class="Raleway" value="'.$counter.'" id="'.$counter.'">'.$row['instituteName'].'</option>.';
                          $counter++;
                          echo "\n";echo "\t\t\t\t\t";
                      }
                      echo "\n";
                    ?>
				   </select>
			  </div>

			  <div class="w3-container w3-third">
			      <select class="w3-select w3-border" name="courseOption">
				    <option class="Raleway" value="" disabled selected>Select Branch</option>
				    <!-- <option class="Raleway" value="0">Empty</option> -->
				    <?php
                      $sql = "SELECT cName FROM coursenametable;";
                      $query = mysqli_query($conn,$sql);

                      if(!$query){
                        die("SQL Error".mysqli_errno($conn));
                      }
                      $counter = 101;
                      while($row = mysqli_fetch_array($query)){
                          echo '<option class="Raleway" value="'.$counter.'" id="'.$counter.'">'.$row['cName'].'</option>.';
                          $counter++;
                          echo "\n";echo "\t\t\t\t\t";
                      }
                    ?>				    
				  </select>  
			  </div>

			  <div class="w3-container w3-third">
			    <input class="w3-input w3-border" type="text" name="score" placeholder="Enter Your SAT Score">
			  </div>
			</div>

		    <div class="w3-row w3-padding-large">
		      <div class="w3-center">
		    	<button id="searchbtn" class="w3-btn" name="search" type="submit">Search</button>
		      </div>  
		    </div>
	   </form>
	
 </div>

   <?php
      switch($model){

      	    // Input Name: Institute Name | Course Name | Score 
      	    case 0:
      	            echo '<span class="enteredDataCover">Selected Insititute: 
      	                    <span class="enteredData"> 
                              <script type="text/javascript">
                                   document.open();document.write(document.getElementById('.$instituteNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';
                    echo '<span class="enteredDataCover">Selected Branch: 
                            <span class="enteredData branchPad">
                              <script type="text/javascript">document.open();document.write(document.getElementById('.$courseNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';
                    echo '<span class="enteredDataCover">Entered SAT Score: 
                            <span class="enteredData">
                              <script type="text/javascript">
                                   document.open();document.write('.$score.');document.close();
                              </script>
                            </span>
                          </span>';

                    $sql = "SELECT cs.score_2016 
                            FROM coursescoretable cs, institutetable it 
                            WHERE (it.iNo = $instituteNo) AND (cs.cNo = $courseNo) AND (it.iNo = cs.iNo);";
                      
					$query = mysqli_query($conn, $sql);
                       
					if(!$query){
					  header("Location: http://dasa.ankitverma.com.np/");
                      die();
					  // die("SQL Error".mysqli_errno($conn));
					}else{
					  	$value = mysqli_fetch_object($query);
					  	if(empty($value) || ($value->score_2016 == 0) ){
                           echo '<p class="notice w3-brown">DATA for selected course is not available. The system is not sure if the course is available through DASA Scheme.</p>';
					  	}
					    else if( $score < $value->score_2016){
					    	echo '<p class="notice w3-red">Your score is less than the previous year\'s cutoff score which was '.' '.$value->score_2016.'</p>';
					    }else{
					  	    echo '<p class="notice w3-green	">Your score is higher than the previous year\'s cutoff score which was  '.' '.$value->score_2016.'</p>';
					    }	
					}
			break;

            // Input: Institute | Course
            case 1:
      	            echo '<span class="enteredDataCover">Selected Insititute: 
      	                    <span class="enteredData"> 
                              <script type="text/javascript">
                                   document.open();document.write(document.getElementById('.$instituteNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';
                    echo '<span class="enteredDataCover">Selected Branch: 
                            <span class="enteredData branchPad">
                              <script type="text/javascript">document.open();document.write(document.getElementById('.$courseNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span>';

                    echo '
                    <button class="w3-round-xxlarge w3-right" data-toggle="modal" data-target="#ModalCase1" style="border:none;background-color:#2196F3;margin:0px 20px 5px 0px;" id="graphButton">
                        <img src="./img/graphIcon.png" alt="Graph Icon" title="Score Graph" style="padding-bottom:7px;">
	                </button>
                    ';       

                    $sql = "SELECT cn.cName, cs.score_2015, cs.score_2016 
                            FROM coursenametable cn, coursescoretable cs, institutetable it 
                            WHERE (it.iNo = $instituteNo) AND (cs.cNo = $courseNo) AND (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo);";

					$query = mysqli_query($conn, $sql);

					if(!$query){

					  header("Location: http://dasa.ankitverma.com.np/");
                      die();						
					  // die("SQL Error".mysqli_errno($conn));
					}

			        $no = 1;

			        if( 0 < mysqli_num_rows($query)){
			                echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
										<caption class="title w3-green w3-center">SAT Cutoff Score for the Selected Branch</caption>
										
										<thead>
											<tr>
											    <th>S.No.</th>
												<th>Course</th>
												<th>Cutoff Score 2015</th>
												<th>Cutoff Score 2016</th>
											</tr>
										</thead>
										
										<tbody>
							';			          	
			            	while ($row = mysqli_fetch_array($query)){
                                

								echo "
									<script type='text/javascript'>
										  google.charts.load('current', {'packages':['corechart']});
										  google.charts.setOnLoadCallback(drawChart);

										  function drawChart() {
										    var data = google.visualization.arrayToDataTable([
										      ['Year', 'Score'],
                                               
										      ['2015',  ".$row['score_2015']." ],
										      ['2016',  ".$row['score_2016']." ],

										    ]);

										    var options = {
										      
										       width:500,
											   height:250,
											   vAxis: {minValue:0, maxValue: 2400, title: 'SAT Score'},
											   hAxis: {title: 'Year'},
										       bar: {groupWidth: '40%'},
										       legend: {position: 'right'}
										       
											};

										    var chart = new google.visualization.ColumnChart(document.getElementById('ModalChart1'));

										    chart.draw(data, options);
										  }
									</script>
								";
								
								echo '<tr>
								        <td>'.$no.'</td>
										<td>'.$row['cName'].'</td>
										<td>'.$row['score_2015'].'</td>
										<td>'.$row['score_2016'].'</td>
										<td style="padding-left:40px;">
										    
     									</td>
						              </tr>';

						              $no++;


						   }			          	
						    echo '</tbody>
								  </table>
						    ';
			        }else{
                            echo '<p class="notice">No Records Found</p>';
					}
			break;

            // Input: Course | Score
            case 2:

                    echo '<span class="enteredDataCover">Selected Branch: 
                            <span class="enteredData branchPad">
                              <script type="text/javascript">document.open();document.write(document.getElementById('.$courseNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';
                    echo '<span class="enteredDataCover">Entered SAT Score: 
                            <span class="enteredData">
                              <script type="text/javascript">
                                   document.open();document.write('.$score.');document.close();
                              </script>
                            </span>
                          </span>';

                    echo '
                     <button class="w3-round-xxlarge w3-right" data-toggle="modal" data-target="#ModalCase2" style="border:none;background-color:#2196F3;margin:0px 20px 5px 0px;" id="graphButton">
                            <img src="./img/graphIcon.png" alt="Graph Icon" title="Score Graph" style="padding-bottom:7px;">
				      </button>
                    ';
                          
			        $sql = "SELECT it.instituteName, cs.score_2015, cs.score_2016  
					        FROM coursescoretable cs, institutetable it 
							WHERE (cs.iNo = it.iNo) AND (cs.cNo = $courseNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0) ORDER BY cs.score_2016;";

					$query = mysqli_query($conn, $sql);

					if(!$query){
					  header("Location: http://dasa.ankitverma.com.np/");
                      die();
					  // die("SQL Error".mysqli_errno($conn));
					}

					$no = 1;

			        if( 0 < mysqli_num_rows($query)){

								echo "
									<script type='text/javascript'>
										  google.charts.load('current', {'packages':['corechart']});
										  google.charts.setOnLoadCallback(drawChart);

										  function drawChart() {
										    var data = google.visualization.arrayToDataTable([
										      ['Institute', '2015', '2016'],
										      
                                            ";
                                           
                                            while($row = mysqli_fetch_array($query)) {
												    echo "[ '".$row['instituteName']."' , ".$row['score_2015']." , ".$row['score_2016']." ],";
												}"
                                            ";	

										    echo "]); 
										    var options = {
										      
										       width:500,
											   height:350,
											   chartArea:{left:100,top:30},

											   vAxis: {minValue:0, maxValue: 2400, title: 'SAT Score'},

											   hAxis: {direction:-1, 
											   	       slantedText:true, 
											   	       slantedTextAngle:20,
											   	       textStyle : {
											   	       	 fontSize: 10
											   	       }
											   },
                                               "; 

                                               if (mysqli_num_rows($query) > 4 ){
                                               	 echo 'width: data.getNumberOfRows() * 100 ,';
                                               }else{
                                                 echo 'width: 500 ,'; 	
                                               }
                                               echo "

										       bar: {groupWidth: '45%'},
										       legend: {position: 'right'}
										       
											};

										    var chart = new google.visualization.ColumnChart(document.getElementById('ModalChart2'));

										    chart.draw(data, options);
										  }
									</script>
								";


							echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
										<caption class="title w3-green w3-center">Institutes with the Selected Branch within your SAT Score</caption>
										
										<thead>
											<tr>
											    <th>S.No.</th>
												<th>Institute Name</th>
												<th>2015 Cutoff Score</th>
												<th>2016 Cutoff Score</th>
											</tr>
										</thead>
										
										<tbody>
							';
                          
                          mysqli_data_seek( $query, 0 );
					   	  while ($row = mysqli_fetch_array($query)){
								
								echo '<tr>
								        <td>'.$no.'</td>
										<td>'.$row['instituteName'].'</td>
										<td>'.$row['score_2015'].'</td>
										<td>'.$row['score_2016'].'</td>
						              </tr>';

						              $no++;
						  }

						  echo '</tbody>
							    </table>
						  ';


					}else{
                          echo '<p class="notice">No Records Found</p>';
					}						  
     		break;

            // Input: Institute | Score
            case 3:
      	            echo '<span class="enteredDataCover">Selected Insititute: 
      	                    <span class="enteredData"> 
                              <script type="text/javascript">
                                   document.open();document.write(document.getElementById('.$instituteNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';

                    echo '<span class="enteredDataCover">Entered SAT Score: 
                            <span class="enteredData">
                              <script type="text/javascript">
                                   document.open();document.write('.$score.');document.close();
                              </script>
                            </span>
                          </span>';
                    
                    echo '
                     <button class="w3-round-xxlarge w3-right" data-toggle="modal" data-target="#ModalCase3" style="border:none;background-color:#2196F3;margin:0px 20px 5px 0px;" id="graphButton">
                            <img src="./img/graphIcon.png" alt="Graph Icon" title="Score Graph" style="padding-bottom:7px;">
				      </button>
                    ';

			        $sql = "SELECT cn.cName, cs.score_2015, cs.score_2016  
                            FROM coursenametable cn, coursescoretable cs, institutetable it 
                            WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (it.iNo = $instituteNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0);";

					$query = mysqli_query($conn, $sql);

					if(!$query){
					  header("Location: http://dasa.ankitverma.com.np/");
                      die();						
					  // die("SQL Error".mysqli_errno($conn));
					}

			        $no = 1;

			        if( 0 < mysqli_num_rows($query)){			          

								echo "
									<script type='text/javascript'>
										  google.charts.load('current', {'packages':['corechart']});
										  google.charts.setOnLoadCallback(drawChart);

										  function drawChart() {
										    var data = google.visualization.arrayToDataTable([
										      ['Branch', '2015', '2016'],
										      
                                            ";
                                           
                                            while($row = mysqli_fetch_array($query)) {
												    echo "[ '".$row['cName']."' , ".$row['score_2015']." , ".$row['score_2016']." ],";
												}"
                                            ";	

										    echo "]); 
										    var options = {
										      
										       width:500,
											   height:350,
											   
											   vAxis: {minValue:0, maxValue: 2400, title: 'SAT Score'},

											   hAxis: {direction:-1, 
											   	       slantedText:true, 
											   	       slantedTextAngle:30,
											   	       textStyle : {
											   	       	 fontSize: 10
											   	       }
											   },
                                               "; 

                                               if (mysqli_num_rows($query) > 4 ){
                                               	 echo 'width: data.getNumberOfRows() * 100 ,';
                                               }else{
                                                 echo 'width: 500 ,'; 	
                                               }
                                               echo "

										       bar: {groupWidth: '45%'},
										       legend: {position: 'right'}
										       
											};

										    var chart = new google.visualization.ColumnChart(document.getElementById('ModalChart3'));

										    chart.draw(data, options);
										  }
									</script>
								";

							echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
									    <caption class="title w3-green w3-center">Branches offered by the Institute within your SAT score</caption>
										
											<thead>
												<tr>
												    <th>S.No.</th>
													<th>Courses</th>
													<th>2015 Cutoff Score</th>
													<th>2016 Cutoff Score</th>
												</tr>
											</thead>
										
										<tbody>
							';

                          mysqli_data_seek( $query, 0 );
					   	  while ($row = mysqli_fetch_array($query)){
								
								echo '<tr>
								        <td>'.$no.'</td>
										<td>'.$row['cName'].'</td>
										<td>'.$row['score_2015'].'</td>
										<td>'.$row['score_2016'].'</td>
						              </tr>';

							              $no++;
						  }

						  echo '</tbody>
							    </table>
						  ';
					}else{
                          echo '<p class="notice">No Records Found</p>';
					}						  
     		break;

            // Input:Institute Name
            case 4:
      	            echo '<span class="enteredDataCover">Selected Insititute: 
      	                    <span class="enteredData"> 
                              <script type="text/javascript">
                                   document.open();document.write(document.getElementById('.$instituteNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span>';

                    echo '
                     <button class="w3-round-xxlarge w3-right" data-toggle="modal" data-target="#ModalCase4" style="border:none;background-color:#2196F3;margin:0px 20px 5px 0px;" id="graphButton">
                            <img src="./img/graphIcon.png" alt="Graph Icon" title="Score Graph" style="padding-bottom:7px;">
				      </button>
                    ';       

			        $sql = "SELECT cn.cName, cs.score_2015, cs.score_2016 
                            FROM coursenametable cn, coursescoretable cs, institutetable it 
                            WHERE (it.iNo = $instituteNo) AND (it.iNo = cs.iNo) AND (cn.cNo = cs.CNo);";

					$query = mysqli_query($conn, $sql);

					if(!$query){
					  header("Location: http://dasa.ankitverma.com.np/");
                      die();						
					  // die("SQL Error".mysqli_errno($conn));
					}

			        $no = 1;

			        if( 0 < mysqli_num_rows($query)){			          

								echo "
									<script type='text/javascript'>
										  google.charts.load('current', {'packages':['corechart']});
										  google.charts.setOnLoadCallback(drawChart);

										  function drawChart() {
										    var data = google.visualization.arrayToDataTable([
										      ['Branch', '2015', '2016'],
										      
                                            ";
                                            
                                            while($row = mysqli_fetch_array($query)) {
												    echo "[ '".$row['cName']."' , ".$row['score_2015']." , ".$row['score_2016']." ],";
												}"
                                            ";	

										    echo "]); 
										    var options = {
										      
										       width:500,
											   height:350,

											   chartArea:{left:100,top:30},
											   
											   vAxis: {minValue:0, maxValue: 2400, title: 'SAT Score'},

											   hAxis: {direction:-1, 
											   	       slantedText:true, 
											   	       slantedTextAngle:30,
											   	       textStyle : {
											   	       	 fontSize: 10
											   	       }
											   },
                                               "; 

                                               if (mysqli_num_rows($query) > 4 ){
                                               	 echo 'width: data.getNumberOfRows() * 100 ,';
                                               }else{
                                                 echo 'width: 500 ,'; 	
                                               }
                                               echo "

										       bar: {groupWidth: '45%'},
										       legend: {position: 'right'}
										       
											};

										    var chart = new google.visualization.ColumnChart(document.getElementById('ModalChart4'));

										    chart.draw(data, options);
										  }
									</script>
								";

							echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
										<caption class="title w3-green w3-center">Branches offered by the Selected Institute</caption>
										
											<thead>
												<tr>
												    <th>S.No.</th>
													<th>Courses</th>
													<th>2015 Cutoff Score</th>
													<th>2016 Cutoff Score</th>
												</tr>
											</thead>
										
										<tbody>
							';


                          mysqli_data_seek( $query, 0 );
					   	  while ($row = mysqli_fetch_array($query)){
								
							echo '<tr>
							        <td>'.$no.'</td>
									<td>'.$row['cName'].'</td>
									<td>'.$row['score_2015'].'</td>
									<td>'.$row['score_2016'].'</td>
					              </tr>';

							              $no++;
						  }

						  echo '</tbody>
							    </table>
						  ';
					}else{
                          echo '<p class="notice">No Records Found</p>';
					}						  
     		break;

            // Input:Course Name
            case 5:
                    echo '<span class="enteredDataCover">Selected Branch: 
                            <span class="enteredData branchPad">
                              <script type="text/javascript">document.open();document.write(document.getElementById('.$courseNo.').innerHTML);document.close();
                              </script>
                            </span>
                           </span><br/>';
                    echo '
                     <button class="w3-round-xxlarge w3-right" data-toggle="modal" data-target="#ModalCase5" style="border:none;background-color:#2196F3;margin:0px 20px 5px 0px;" id="graphButton">
                            <img src="./img/graphIcon.png" alt="Graph Icon" title="Score Graph" style="padding-bottom:7px;">
				      </button>
                    ';

			        $sql = "SELECT it.instituteName, cs.score_2015, cs.score_2016  
                            FROM coursenametable cn, coursescoretable cs, institutetable it 
                            WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (cn.cNo = $courseNo) AND (cs.score_2016 > 0)
                            ORDER BY cs.score_2016;";

					$query = mysqli_query($conn, $sql);

					if(!$query){
					  header("Location: http://dasa.ankitverma.com.np/");
                      die();						
					  // die("SQL Error".mysqli_errno($conn));
					}

			        $no = 1;

			        if( 0 < mysqli_num_rows($query)){			          

								echo "
									<script type='text/javascript'>
										  google.charts.load('current', {'packages':['corechart']});
										  google.charts.setOnLoadCallback(drawChart);

										  function drawChart() {
										    var data = google.visualization.arrayToDataTable([
										      ['Branch', '2015', '2016'],
										      
                                            ";
                                            
                                            while($row = mysqli_fetch_array($query)) {
												    echo "[ '".$row['instituteName']."' , ".$row['score_2015']." , ".$row['score_2016']." ],";
												}"
                                            ";	

										    echo "]); 
										    var options = {
										      
										       width:500,
											   height:350,

											   chartArea:{left:100,top:30},
											   
											   vAxis: {minValue:0, maxValue: 2400, title: 'SAT Score'},

											   hAxis: {direction:-1, 
											   	       slantedText:true, 
											   	       slantedTextAngle:20,
											   	       textStyle : {
											   	       	 fontSize: 10
											   	       }
											   },
                                               "; 

                                               if (mysqli_num_rows($query) > 4 ){
                                               	 echo 'width: data.getNumberOfRows() * 100 ,';
                                               }else{
                                                 echo 'width: 500 ,'; 	
                                               }
                                               echo "

										       bar: {groupWidth: '45%'},
										       legend: {position: 'right'}
										       
											};

										    var chart = new google.visualization.ColumnChart(document.getElementById('ModalChart5'));

										    chart.draw(data, options);
										  }
									</script>
								";

							echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
										<caption class="title w3-green w3-center">Institutes offerring the Selected Branch</caption>
										
											<thead>
												<tr>
												    <th>S.No.</th>
													<th>Institute</th>
													<th>2015 Cutoff Score</th>
													<th>2016 Cutoff Score</th>
												</tr>
											</thead>
										
										<tbody>
							';

                          mysqli_data_seek( $query, 0 );
					   	  while ($row = mysqli_fetch_array($query)){
								
							echo '<tr>
							        <td>'.$no.'</td>
									<td>'.$row['instituteName'].'</td>
									<td>'.$row['score_2015'].'</td>
									<td>'.$row['score_2016'].'</td>
					              </tr>';

							              $no++;
						  }

						  echo '</tbody>
							    </table>
						  ';
					}else{
                          echo '<p class="notice">No Records Found</p>';
					}						  
     		break;

            // Input:Score
            case 6:

                    echo '<span class="enteredDataCover">Entered SAT Score: 
                            <span class="enteredData">
                              <script type="text/javascript">
                                   document.open();document.write('.$score.');document.close();
                              </script>
                            </span>
                          </span>';
                    
			        $sql = "SELECT it.instituteName, cn.cName, cs.score_2015, cs.score_2016  
                            FROM coursenametable cn, coursescoretable cs, institutetable it 
                            WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0)
                            ;";

					$query = mysqli_query($conn, $sql);

					if(!$query){
					  	die("SQL Error".mysqli_errno($conn));
					}

			        $no = 1;

			        if( 0 < mysqli_num_rows($query)){			          
								
							echo '
									  <table class="w3-table w3-striped w3-hoverable w3-bordered">
								
										<caption class="title w3-green">Institutes and their Branches within your SAT Score</caption>
										
											<thead>
												<tr>
												    <th>S.No.</th>
													<th>Institute</th>
													<th>Course</th>
													<th>2015 Cutoff Score</th>
													<th>2016 Cutoff Score</th>
												</tr>
											</thead>
										
										<tbody>
							';

                          while ($row = mysqli_fetch_array($query)){
								
							echo '<tr>
							        <td>'.$no.'</td>
									<td>'.$row['instituteName'].'</td>
									<td>'.$row['cName'].'</td>
									<td>'.$row['score_2015'].'</td>
									<td>'.$row['score_2016'].'</td>
					              </tr>';

							              $no++;
						  }

						  echo '</tbody>
							    </table>
						  ';
					}else{
                          echo '<p class="notice">No Records Found</p>';
					}						  
     		break;

            default:
			    echo '<p class="notice w3-red">Invalid Input</p>';
      }
   ?>

	<!-- Modal Chart 1-->
	<div id="ModalCase1" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">SAT Cutoff Score for the Selected Branch</h4>
	      </div>
	      <div class="modal-body">
	        <div id="ModalChart1" align="center"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal Chart 2-->
	<div id="ModalCase2" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Institutes with the Selected Branch within your SAT Score</h4>
	      </div>
	      <div class="modal-body">
	        <div id="ModalChart2" align="center"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal Chart 3-->
	<div id="ModalCase3" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Branches offered by the Institute within your SAT score</h4>
	      </div>
	      <div class="modal-body">
	        <div id="ModalChart3" align="center"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal Chart 4-->
	<div id="ModalCase4" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Branches offered by the Selected Institute</h4>
	      </div>
	      <div class="modal-body">
	        <div id="ModalChart4" align="center"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- Modal Chart 5-->
	<div id="ModalCase5" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Institutes offerring the Selected Branch</h4>
	      </div>
	      <div class="modal-body">
	        <div id="ModalChart5" align="center"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

</body>
</html>

 