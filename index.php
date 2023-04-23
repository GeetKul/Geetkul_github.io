<!DOCTYPE html>

<!-- Fig. 19.21: dynamicForm.php -->
<!-- Dynamic form. -->
<html>
    <head>
         <meta charset = "utf-8">
		 
         <title>Registration Form</title>
		 
         <style type = "text/css">
               p       { margin: 20px; }
               .error  { color: red }
               p.head  { font-weight: bold; margin-top: 15px; }
               label   { width: 10em; float: left; }
			   
		    div {
           background-color: white ;
		   background-margin: 10px
           margin-top: 5px;
           margin-bottom: 5px;
           margin-right: 220px;
           margin-left: 220px;
 
         }	   
			   
	
         </style>
    </head>
    <body style="background-color:#D8D5D1 " >
	<div>
      <?php
	  
         // variables used in script
		 $umid = isset($_POST[ "umid" ]) ? $_POST[ "umid" ] : "";
         $fname = isset($_POST[ "fname" ]) ? $_POST[ "fname" ] : "";
         $lname = isset($_POST[ "lname" ]) ? $_POST[ "lname" ] : "";
		 $projecttitle = isset($_POST[ "projecttitle" ]) ? $_POST[ "projecttitle" ] : "";
         $email = isset($_POST[ "email" ]) ? $_POST[ "email" ] : "";
         $phone = isset($_POST[ "phone" ]) ? $_POST[ "phone" ] : "";
         $seats = isset($_POST[ "seats" ]) ? $_POST[ "seats" ] : "";
         $iserror = false;
         $formerrors =
            array( "umiderror" => false, "fnameerror" => false, "lnameerror" => false, "projecttitleerror" => false,
               "emailerror" => false, "phoneerror" => false );

              
         

         // array of name values for the text input fields
         $inputlist = array( "umid" => "UMID",  "fname" => "First Name",
            "lname" => "Last Name", "projecttitle" => "Project Title", "email" => "Email",
            "phone" => "Phone");
			
   

         // ensure that all fields have been filled in correctly
         if ( isset( $_POST["submit"] ) )
         {
			 
            if ( $umid == "" || !preg_match('/^[0-9]{8}$/', $umid))
            {
               $formerrors[ "umiderror" ] = true;
               $iserror = true;
            } // end if

            if ( $fname == "" )
            {
               $formerrors[ "fnameerror" ] = true;
               $iserror = true;
            } // end if

            if ( $lname == "" )
            {
               $formerrors[ "lnameerror" ] = true;
               $iserror = true;
            } // end if
			
			if ( $projecttitle == "" )
            {
               $formerrors[ "projecttitleerror" ] = true;
               $iserror = true;
            } // end if

            if ( $email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL))
            {
               $formerrors[ "emailerror" ] = true;
               $iserror = true;
            } // end if

            if ( !preg_match( "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
               $phone ) )
            {
               $formerrors[ "phoneerror" ] = true;
               $iserror = true;
            } // end if

            if ( !$iserror )
            {

               // Connect to MySQL
               if ( !( $database = mysqli_connect( "localhost:3306","root", "" , "mailingList") ) )
                  die( "<p>Could not connect to database</p>" );

               // open MailingList database
               if ( !mysqli_select_db( $database, "mailingList" ) )
                  die( "<p>Could not open MailingList database</p>" );
				$timeSlot=substr($seats,0,27);
				$lastSlot= substr($seats,28,1);
				$updatedslots= substr($seats,28,1);
				$lastDate = substr($seats,0,10);
				$startTime = substr($seats,12,6);
				$endTime = substr($seats,21,6);
				$intLastSlot = intval($lastSlot);
				$intLastSlot = $intLastSlot -1;
				$updatedLastSlot= intval($intLastSlot);
				$updatedLastSlot ='no more';
			   
				 
			
               
			   // build INSERT query
               $query = "INSERT INTO contacts " .
                  "( UMID, LastName, FirstName, ProjectTitle, Email, Phone, TimeSlot ) " .
                  "VALUES ( '$umid', '$lname', '$fname', '$projecttitle','$email', '$phone', '$timeSlot')";
               

			   $query2 = "UPDATE TIMESLOT SET AVAILABLESLOTS = '$intLastSlot' WHERE DATEOFSLOT = '$lastDate' AND STARTTIME = '$startTime' AND ENDTIME = '$endTime'";
              
                
			
		// open MailingList database
            if ( !mysqli_select_db( $database, "mailingList" ) )
            die( "<p>Could not open MailingList database</p> </body></html>" );

         // query1 MailingList database
           	
			
			
			
						   
			  
			if ( !( $database = mysqli_connect( "localhost:3306", "root", "" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );

         // open MailingList database
         if ( !mysqli_select_db( $database, "mailingList" ) )
            die( "<p>Could not open MailingList database</p> </body></html>" );

         
		}   
 
			  
			  
			  // execute query in MailingList database
               if ( !( $result = mysqli_query( $database, $query ) ) )
               {
                  print( "<p>Could not execute query!</p>" );  
				  
                  die( mysqli_error($database) );
				  
               } // end if
			   
               if ( !( $resultS = mysqli_query( $database, $query2 ) ) )
               {
                  print( "<p>Could not execute query!</p>" );
				  
                  die( mysqli_error($database) );
               }
			   
		  
            
               print( "<p>Hi $fname. Thank you for completing the registration form.
                     You have been added to the seat registrering list.</p>
                    <p class = 'head'>The following information has been
                     saved in our database:</p>
				  	<p>UMID: $umid </p> 
                    <p>Name: $fname $lname</p>
                    <p>Email: $email</p>
                    <p>Phone: $phone</p>
                   
                    <p><a href = 'formDatabase.php'>Click here to view entire database.</a></p>
                    <p class = 'head'>This is a sample form.
                     You have not been added to a mailing list.</p>
                  </body></html>" );
               die(); // finish the page
            } // end if
          // end if

         print( "<h1>Registration Form</h1>
            <p>Please fill in all fields and click Register.</p>" );

         if ( $iserror )
         {
            print( "<p class = 'error'>Fields with * need to be filled in properly.</p>" );
         } // end if

         print( "<!-- post form data to dynamicForm.php -->
            <form method = 'post' action = 'index.php'>
            <h2>User Information</h2>

            <!-- create four text boxes for user input -->" );
        foreach ( $inputlist as $inputname => $inputalt )
         {
            print( "<div><br><label>$inputalt:</label><input type = 'text'
               name = '$inputname' value = '" . $$inputname . "'>" );
            
            if ( $formerrors[ ( $inputname )."error" ] == true )
               print( "<span class = 'error'>*</span>" );

            print( "</div>" );
        } // end foreach
        
		 
		
         if ( $formerrors[ "phoneerror" ] )
            print( "<p class = 'error'>Must be in the form 555-555-5555" );


         
		 $rows = [];
    	$query1 = "SELECT Concat(dateofslot, '  ', starttime, ' - ',endtime,' ', availableslots,' slots available') As timeslots FROM timeslot";
		
		
	 // Connect to MySQL
         if ( !( $database = mysqli_connect( "localhost:3306", "root", "" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );

         // open MailingList database
         if ( !mysqli_select_db( $database, "mailingList" ) )
            die( "<p>Could not open MailingList database</p> </body></html>" );

         // query1 MailingList database
         if ( !( $result1 = mysqli_query( $database, $query1 ) ) )
         {
            print( "<p>Could not execute query!</p>" );
            die( mysqli_error($database) . "</body></html>" );
         } print(" <p>Which time slot would you like to pick?</p>");
		if ($result1) {
			print( "
           
            <select name = 'seats'>" );
		 while ($row = mysqli_fetch_row($result1)) {		

         foreach ( $row as $currbook )
         {
            print( "<option value='$currbook'" .
               ($currbook == $seats ? " selected>" : ">") .
               $currbook . "</option>" );
         } 
		    
							
		}
		}
		
		
		
		
		

			

         mysqli_close( $database );

        
		
         print( "<!-- create a submit button -->
            <p class = 'head'><input type = 'submit' name = 'submit'
            value = 'Register'><br><br></p></form></body></html>" );
			
			
			
		
			
	    
			
			
   ?><!-- end PHP script -->
   </div>

</body>
</html>

