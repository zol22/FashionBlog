<?php
  
  /////////////////////////////////// LOGIN.PHP //////////////////////////////////
  //define('CSSPATH', 'template/css/'); //define css path
  //$css = 'mystyles.css';

 //session_start using a non-default path and detect path in session cookie
	session_set_cookie_params(0,"~sp2235/download/","web.njit.edu");
	session_start();

  //*************************** INCLUDE PHP FILES  ****************************/
	include ( "account.php" );
	include ( "myfunctions.php" );
 //***************************************************************************//

  errorChecking ( );               	//call error checking
	connectToDB ( $db );             	//Connect to database

  //*******************************GET INPUTS *********************************//

  $username  = $_GET[ "username" ];
  $password  = $_GET[ "password" ];

  //***************************************************************************//

  //AUTHENTICATE DATA INPUT EXISTANCE//
  if ( ! authenticate ( $username, $password, $db ) )
  {
    echo "<br><b><i>Verification process failed:</b></i> try again <br><br>" ;
    header ( "refresh: 3; url = ../index.html" );
    exit( );
  }

  else
  {
    //echo "<br><br><b><i>/// Password is valid! ///</b></i><br>";

    $_SESSION['logged'] = true;
    $_SESSION['username'] = $username;

    echo "<br><br>Login in...<br>";
    echo "You will be allowed entry in a moment...<br><br>";
    header ( "refresh: 3; url = ../userInterface/index.html" );
    exit( );

  }

	//closeDB ( $db );                  //close database
  //******************************************************************************//
?>
