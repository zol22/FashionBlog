<?php

 //session_start using a non-default path and detect path in session cookie
	session_set_cookie_params(0,"~sp2235/download/","web.njit.edu");
	session_start();

  //*************************** INCLUDE PHP FILES  ****************************/
	include ( "account.php" );
	include ( "myfunctions.php" );
 //***************************************************************************//

  //errorChecking ( );               	//call error checking
	//connectToDB ( $db );             	//Connect to database

  //*******************************GET INPUTS *********************************//

  $name    = $_GET[ "Name" ];
  $email   = $_GET[ "Email" ];
  $message = $_GET[ "Message" ];

  //***************************************************************************//
    $output = "";

    //SEND OUTPUT TO EMAIL//
    $subject = "We'd love your feedback!";
    $headers = 'From:  "'.$email.'"' . "\r\n" .
               'Reply-To: FutureFashionBlog@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
               
    $output .= "Greetings, <br>"; 
    $output .= "<br>$message";
    $output .= "<br><br>Best Regards, <br> $name <br>";
    
    // Always set content-type when sending HTML email
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";;
  
  
    mail("shaiddyperez@gmail.com", $subject, $output, $headers);
    
    //header ( "url = ../userInterface/index.html" );
    header('Location: ../userInterface/index.html');

?>