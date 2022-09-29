<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The purpose of this file is to serve as the web page for the About Us section. 
  This web page follows the formatting style of the entire web site using the same
  header, random sticker generator, and footer. The body of the web page contains the
  project description and team member names.*/

  include ('sticker_sc_fns.php');
  
  // Starting shopping cart sessions
  session_start();
  
  //Display header with navigation panel 
  do_html_header("Welcome to StickersXYZ");

  //Display information about project
  do_html_about();

  //Display random stickers 
  echo "<h2>Check out this sticker!</h2>";
  random_sticker();
 
  //Display footer
  do_html_footer();
?>