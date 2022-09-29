<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The purpose of this file is to create a separate page for each sticker when a user clicks
  on the particular sticker. The sticker_sc_fn.php imports program functions. The sticker
  title becomes the header and the sticker details are displayed in a list. An “add sticker
  to shopping cart” and “continue shopping” buttons are generated.*/

  //import needed files for functions
  include ('sticker_sc_fns.php');
  
  // Start shopping cart session
  session_start();

  $stickerID = $_GET['stickerID'];

  // get this sticker out of database
  $sticker = get_sticker_details($stickerID);
  
  //Display header
  do_html_header($sticker['title']);
  
  display_sticker_details($sticker);

  // set url for "continue button"
  $target = "index.php";
  
  if($sticker['catid']) {
    $target = "show_cat.php?catid=".$sticker['catid'];
  }
  
  //Generate Add sticker button
  display_button("show_cart.php?new=".$stickerID,"Add ".$sticker['title']." To My Shopping Cart");

  //Generate continue shopping button
  display_button($target, "Continue Shopping");
  
  //Display footer
  do_html_footer();
?>