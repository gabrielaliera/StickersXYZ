<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The purpose of this file will display the cart. Sticker_sc_fns.php will provide functions to validate data. 
  This file will calculate the price of items in cart, tell you if there are no items in your cart, and give you options to continue shopping */

  include ('sticker_sc_fns.php');
 
  // The shopping cart needs sessions, so start one
  session_start();
     
  @$new = $_GET['new'];

  if($new) {
    //new item selected
    if(!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
      $_SESSION['items'] = 0;
      $_SESSION['total_price'] ='0.00';
    }

    if(isset($_SESSION['cart'][$new])) {
      $_SESSION['cart'][$new]++;
    } else {
      $_SESSION['cart'][$new] = 1;
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  if(isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $stickerID => $qty) {
      if($_POST[$stickerID] == '0') {
        unset($_SESSION['cart'][$stickerID]);
      } else {
        $_SESSION['cart'][$stickerID] = $_POST[$stickerID];
      }
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  //Display header
  do_html_header("Your shopping cart");

  //Define $_Sessionn['cart'] as array if doesnt exist
  if (empty($_SESSION['cart'])) {
     $_SESSION['cart'] = array();
  }

  //Display Shopping Cart
  if($_SESSION['cart']) {
    display_cart($_SESSION['cart']);
  } else {
    echo "<p>There are no items in your cart</p><hr/>";
  }

  $target = "index.php";

  // if we have just added an item to the cart, continue shopping in that category
  if($new)   {
    $details =  get_sticker_details($new);
    if($details['catid']) {
      $target = "show_cat.php?catid=".$details['catid'];
    }
  }

  //Display Continue Shopping button
  display_button($target,"Continue Shopping");

  //Display Checkout Button
  echo "<br>";
  display_button("checkout.php", "Go To Checkout");

  //Display footer
  do_html_footer();
?>