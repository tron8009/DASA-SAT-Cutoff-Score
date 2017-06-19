<?php
 require_once('connect.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title>DASA SAT Cutoff Score | DASA 2017 | Direct Admission of Students Abroad</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="./css/w3css.css">
	<link rel="stylesheet" href="./css/custom.css">	
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

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.5.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {	

			var id = '#dialog';
				
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
				
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});

			//transition effect
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("slow",0.9);	
				
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
			              
			//Set the popup window to center
			$(id).css('top',  winH/3-$(id).height()/3);
			$(id).css('left', winW/2-$(id).width()/2);
				
			//transition effect
			$(id).fadeIn(2000); 	
				
			//if close button is clicked
			$('.window .close').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();

			$('#mask').hide();
			$('.window').hide();
			});

			//if mask is clicked
			$('#mask').click(function () {
			$(this).hide();
			$('.window').hide();
			});
				
			});
    </script>
    <style type="text/css">
      /*PopUp CSS*/
	  #mask {
		  position: absolute;
		  left: 0;
		  top: 0;
		  z-index: 9000;
		  background-color: rgba(0, 0, 0, .9);
		  display: none;
		}

		#boxes .window {
		  position: absolute;
		  left: 0;
		  top: 0;
		  width: auto;
		  height: auto;
		  margin-right:50px;	
		  display: none;
		  z-index: 9999;
		  padding: 20px;
		  border-radius: 15px;
		  text-align: left;
		}
		@media only screen and (max-width: 600px) {
			#boxes .window {
              margin-top: 100px;
              margin-right:25px;
              border-radius: 15px;
			}
			.noticeFont{
			  font-size: 10px;
		    }
		}
		@media only screen and (max-width: 400px) {
			#boxes .window {
              margin-top: 150px;
              padding: 0px;
              border-radius: 15px;
              
			}
		}

		#boxes #dialog {
		  width: auto;
		  height: auto;
		  /*padding: 10px 20px 0px 20px;*/
		  background-color: #ffffff;
		  font-family: 'Segoe UI Light', sans-serif;
		  font-size: 15pt;
		}

		#popupfoot {
		  font-size: 16pt;
		  position: absolute;
		  bottom: 0px;
		  width: 250px;
		  left: 250px;
		}
		.noticeFont{
			font-size: 13px;
		}    	
    </style>

</head>

<body>

<div id="boxes">
	  <div id="dialog" class="window">

	      
	     <img class="w3-btn w3-right close" src="./img/closebtn.png">
	     

	      <div class="w3-container"> 
		    <h2 class="w3-center w3-green w3-text-white">Instructions</h2>
		  </div>

          <div class="w3-container">
          	<li class="noticeFont">This site uses the database from the official DASA website <a class="w3-text-blue" href="https://www.dasanit.org" target="_blank">www.dasanit.org</a></li>
		    <li class="noticeFont">User can search in seven multiple ways.</li>
          </div>

          <div class="w3-container">
          	<li class="noticeFont">Search Type 0: </li>
          	  <ul>
          	  	<li class="noticeFont"><strong>Input Name: [ Institute Name | Course Name | Score ]</strong></li>
          	  	<li class="noticeFont">Output : Eligibility</li>
          	  </ul>
          </div>		 
		  
		  <div class="w3-container">
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 1:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [ Institute Name | Course Name ]</strong></li>
		  		   	<li class="noticeFont">Output: Cutoff Score of the Selected Course of the Institute</li>
		  		   </ul>
                </li>
		    </div>
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 2:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [ Course Name | Score ]</strong></li>
		  		   	<li class="noticeFont">Output : All the Institutes offering the selected course within the entered SAT Score</li>
		  		   </ul> 
                </li>
		    </div>
		  </div>
 
          <div class="w3-container">
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 3:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [ Institute Name | Score ]</strong></li>
		  		   	<li class="noticeFont">Output : All the courses offered by the Institute within the entered SAT Score. </li>
		  		   </ul> 
                </li>
		    </div>
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 4:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [ Institute Name ]</strong></li>
		  		   	<li class="noticeFont">Output : All the courses offerred by the selected Institute and thier cutoff score.</li>
		  		   </ul> 
                </li>
		    </div>
		  </div>

		  <div class="w3-container">
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 5:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [ Course Name ]</strong></li>
		  		   	<li class="noticeFont">Output: All the Institutes offerring the selected branch with their cutoff Score.</li>
		  		   </ul> 
                </li>
		    </div>
		    <div class="w3-half">
		    	<li class="noticeFont">Search Type 6:
		  		   <ul>
		  		   	<li class="noticeFont"><strong>Input : [Score]</strong></li>
		  		   	<li class="noticeFont">Output: All the Institutes and their courses within the entered SAT score.</li>
		  		   </ul> 
                </li>
		    </div>
		  </div>		  		    
	  
	  </div>
      <div id="mask"></div>
</div>

 <div id="wrapper" >

       <div class="w3-container"><a class="w3-right w3-blue w3-round-xxlarge w3-margin Raleway" href="instructions.html" style="text-decoration: none;padding: 0px 10px 0px 10px;">Instructions</a></div>
    
	   <form  name="searchForm" onsubmit="return validateform()" action="validate.php" method="POST" class="middle">

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
                      $sql = "SELECT cName FROM courseNameTable;";
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

</body>
</html>       

<?php
  require_once('close.php');
?>