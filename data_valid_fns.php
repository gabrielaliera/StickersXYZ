<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This is one of the files imported into sticker_sc_fns.php. The purpose of this file
  to to provide functions to validate data. The filled_out function validates that the 
  checkout and shipping details form are completed before being submitted.*/

/*--------------------filled_out Function-----------------------*/
function filled_out($form_vars) {
  // test that each variable has a value
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
     }
  }
  return true;
}

?>