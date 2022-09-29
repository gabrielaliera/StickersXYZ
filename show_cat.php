<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The purpose of this file is to display the sticker categories. Within each category, a table of the 
  stickers and sticker details are generated. A “continue shopping” button is generated to return
  the user to the home page.*/
  
  //import needed files for functions
  include ('sticker_sc_fns.php');
  
  // Start shopping cart session
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  //Display category name as header
  do_html_header($name);

  // get the sticker info out from db and displat
  $sticker_array = get_stickers($catid);
  display_stickers($sticker_array);

  //Display Continue shopping button
  display_button("index.php", "Continue Shopping");
 
  //Display footer
  do_html_footer();

?>