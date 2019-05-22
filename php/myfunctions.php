<style>

  table, td, th
  {
    border: 2px solid grey;
    border-collapse: collapse;

  }

  table
  {
    width: 70%;
    margin: auto;
    background: white;
  }

  th
  {
    height: 50px;
    color:  blue;
    font-weight: bold;
    font-size: 1.20em;
  }

  td
  {
    color : black;
    text-align : center;
    font-weight: bold;
  }

  tr:nth-child(even)
  {
    background-color : lightgray;
  }

  p
  {
    color: black;
    text-align: center;
    font-weight: bold;
    font-size: 25px;
    padding: 10px 0;
  }

</style>

<?php

/*******************************************************************************
*								                MYFUNCTIONS.PHP	              							   *
*******************************************************************************/

/*******************************************************************************
* ERRORCHECKING FUNCTION - displays any error warning if encountered while     *
* while connecting to database such as syntax error                            *
*******************************************************************************/
function errorChecking ()
{
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors' , 1);
}


/*******************************************************************************
* CONNECTTODB FUNCTION - connects to the database if succeful sent send values *
* otherwise outputs it fails to connect                                        *
*******************************************************************************/
function connectToDB ( &$db )
{
	global $hostname, $username, $password, $project;

	$db = mysqli_connect ( $hostname, $username, $password, $project );

	if (mysqli_connect_errno())
	{
		//echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

  return true;
	//print "<br>Successfully connected to MySQL... <br><br>";

	mysqli_select_db( $db, $project );
}


/*******************************************************************************
* AUTHENTICATE FUNCTION - checks whether the input pass matches the hash pass. *
* if the UCID and account exist it verifies the passwords and returns true if  *
* macthesothersise returns false                                               *
*******************************************************************************/
function authenticate ( $username, $password, &$db )
{
  global $result;

  $query = "SELECT * FROM accounts
            WHERE username = '$username' and password = '$password'" ;

  ($result = mysqli_query ( $db,  $query  ) )  or die ( mysqli_error ($db) );

  $numRows = mysqli_num_rows($result);

  if ($numRows == 0 )
  {
    echo "No user found\n";
    return false;
  }

  return true;
}

/*******************************************************************************
* REGISTER FUNCTION - register user and return true if succesfully registered  *
* otherwise return false.                                                      *
*******************************************************************************/
function register ( $username, $email, $password, $password2, &$db, &$result )
{
  global $r;

  $query =  "SELECT * from accounts
             WHERE username = '$username' AND password='$password' AND email='$email'";

  $r = ( mysqli_query ( $db,  $query  ) )  or die ( mysqli_error ($db) );

  if ($numRows = mysqli_num_rows($r) == 0)
  {
    if ($password == $password2)
    {
      $query = "INSERT INTO accounts ( username, email, password )
                VALUES('$username', '$email', '$password')";

      ($r = mysqli_query ( $db,  $query  ) )  or die ( mysqli_error ($db) );

      echo "Account succesfully created.".PHP_EOL;
      $result = "Account succesfully created.".PHP_EOL;
      
      return true;
    }

    else
    {
      echo "Password doesnt match".PHP_EOL;
      $result = "Password does not match".PHP_EOL;
      return false;
    }
  }

  else
  {
    echo "Account already exists".PHP_EOL;
    $result = "Account already exists".PHP_EOL;
    return false;
  }
}


/*******************************************************************************
* RECENTDATE FUNCTION - outputs the actual date using the PHP function         *
*******************************************************************************/
function recentDate ()
{
	date_default_timezone_set("America/New_York");
	$date = "<i>recent</i> is initialized to: " .
            date("l jS \of F Y h:i:s A") . "<br>"  ;
	echo $date ;
}


/*******************************************************************************
* CLOSEDB FUNCTION - close the database connection and output completion msg   *
*******************************************************************************/
function closeDB ( &$db, &$t )
{
  //mysqli_free_result($t);
  mysqli_close( $db );
  exit ( "<br>Closing Database..."  ) ;
}

?>
