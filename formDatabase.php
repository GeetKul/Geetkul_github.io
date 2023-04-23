<!DOCTYPE html>

<!-- Fig. 19.22: formDatabase.php -->
<!-- Displaying the MailingList database. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Search Results</title>
      <style type = "text/css">
	  

        div{
  
         margin-top: 50px;
         margin-left: 30px;
  
 
         }


	    h1{
		
            color: black;
		
			font-size: 50px;
			padding: 2px;
			text-align: left;
			margin-top:10px;
			margin-left:30px;
        }
		

		
         table  { background-color: lightblue;
                  border: 1px solid gray;
                  border-collapse: collapse; 
				  font-size: 15px;
			      padding: 2px;
			      margin-top:5px;
			      margin-left:15px;}
         th, td { padding: 25px; border: 1px solid gray; }
         tr:nth-child(even) { background-color: white; }
         tr:first-child { background-color: #C0C9D0 ; }
		 
        </style>
    </head>
    <body style="background-color:#3392D8 "> 
      <?php
         // build SELECT query
         $query = "SELECT * FROM contacts";

         // Connect to MySQL
         if ( !( $database = mysqli_connect( "localhost:3306", "root", "" ) ) )
            die( "<p>Could not connect to database</p></body></html>" );

         // open MailingList database
         if ( !mysqli_select_db( $database, "mailingList" ) )
            die( "<p>Could not open MailingList database</p> </body></html>" );

         // query MailingList database
         if ( !( $result = mysqli_query( $database, $query ) ) )
         {
            print( "<p>Could not execute query!</p>" );
            die( mysqli_error($database) . "</body></html>" );
         } // end if
		 
		 // query MailingList database
         // end if
      ?><!-- end PHP script -->
	  <div>
      <input type="submit" onclick="window.location.href='index.php';"  value="Project Demo Registration Form">   
      <input type="submit" onclick="window.location.href='formDatabase.php';"  value="Registered Students">    	  
	  </div>
      <h1>Registered Students</h1>
      <table>
         <caption></caption>
         <tr>
            <th>UMID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>E-mail Address</th>
            <th>Phone Number</th>
            <th>Project Title</th>
			<th>Seats</th>
           
         </tr>
         <?php
            // fetch each record in result set
            for ( $counter = 0; $row = mysqli_fetch_row( $result );
               ++$counter )
            {
               // build table to display results
               print( "<tr>" );

               foreach ( $row as $key => $value )
                  print( "<td>$value</td>" );

               print( "</tr>" );
            } // end for

            mysqli_close( $database );
         ?><!-- end PHP script -->
      </table>
   </body>
</html>

