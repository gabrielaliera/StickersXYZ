<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The file contains the home page of the website. It imports sticker_sc_fns.php
  which is a collection of files that contain various program functions. A session is 
  started to track user information. The header and navigation panel is created. A random
  sticker generator displays 3 random stickers to help with advertisement.*/

  //Import program functions
  include ('sticker_sc_fns.php');
  
  // Start shopping cart sessions
  session_start();
  
  //Display header
  do_html_header("Welcome to StickersXYZ");

  // Display a random book
  echo "<h2>Check out some of our stickers!</h2>";
  random_sticker();
 
  //Display footer
  do_html_footer();
?>