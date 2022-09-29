<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This file is rendered when a user checks out. The files from sticker_sc_fns are 
  imported in order to access various functions. A session is started to track the 
  user’s shopping cart. If the user has not started a session, the text “There are no
  items in your cart”. is displayed. Otherwise, the items in the shopping cart are 
  displayed with a checkout form below it. In addition, the button for “Update Cart”
  is displayed at the bottom of the page.*/
    
  //include our function set
  include ('sticker_sc_fns.php');

  // The shopping cart needs sessions, so start one
  session_start();

  //Display header with navigation panel
  do_html_header("Checkout");

  //Display shopping cart and checkoutform
  if(($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    display_cart($_SESSION['cart'], false, 0);
    display_checkout_form();
  } else {
    echo "<p>There are no items in your cart</p>";
  }

  //Display update cart button
  echo "<br>";
  display_button("show_cart.php", "Update Cart");
 
  //Display footer
  do_html_footer();
?>