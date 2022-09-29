<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This is one of the files imported into sticker_sc_fns.php. The purpose of this file 
  is to create functions that will connect to the database and fetch the result of the 
  database in an array.The function db_connect imports the file db_var.php which 
  contains variables holding information about the server, user name, password, and 
  database. It connects to the MariaDB database. The function db_results_to_array() 
  fetches the data from the database and returns it in an array. */

/*---------------db_connect Function----------------------*/
function db_connect() {
   include('db_vars.php'); 

   $result = new mysqli($db_server, $db_user_name, $db_password, $db_name);
   if (!$result) {
      return false;
   }
   $result->autocommit(TRUE);
   return $result;
}

/*-----------db_result_to_array Function-----------------*/
function db_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}
?>