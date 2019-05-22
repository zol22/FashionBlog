<?php

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

  $username  = $_GET[ "usernamesignup" ];
  $email     = $_GET[ "emailsignup" ];
  $password  = $_GET[ "passwordsignup" ];
  $password2 = $_GET[ "passwordsignup_confirm" ];

  //***************************************************************************//

  //CALL register function
  $result = "";

  if (! register ( $username, $email, $password, $password2, $db, $result ) )
  {
    $result = "Register failed, try again...";
    header ( "location: ../index.html#toregister" );

  }

  else
  {
    $result = "Successfully registered, login now... ";
    header ( "location: ../userInterface/index.html" );
  }


	//closeDB ( $db );                  //close database
  //******************************************************************************//
?>
