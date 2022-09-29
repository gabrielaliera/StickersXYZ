<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The purpose of this file is to process credit card information during the final 
  stage of the checkout process. During the purchasing stage in purchase.php, a user 
  inputs credit card information. This program displays information on whether the 
  purchase was processed or not with the previous credit card information.*/
  
  include ('sticker_sc_fns.php');
  
  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header('Checkout');

  //Create default varibles
  if (empty($_POST['card_type'])) {
    $_POST['card_type'] = 'VISA';
  }

  if (empty($_POST['card_number'])) {
    $_POST['card_number'] = '';
  }
 
  if (empty($_POST['card_month'])) {
    $_POST['card_month'] = '';
  }

  if (empty($_POST['card_year'])) {
    $_POST['card_year'] = '';
  }

  if (empty($_POST['card_name'])) {
    $_POST['card_name'] = '';
  }

  //Create variables from credit card form
  $card_type = $_POST['card_type'];
  $card_number = $_POST['card_number'];
  $card_month = $_POST['card_month'];
  $card_year = $_POST['card_year'];
  $card_name = $_POST['card_name'];
  
  //Create date and last 4 digits of cc
  $date = date("F-d-Y");
  $last_digits = substr($card_number,-4);

  //Proceed with program if cc form is completed
  if(($_SESSION['cart']) && ($card_type) && ($card_number) &&
     ($card_month) && ($card_year) && ($card_name)) {
    
    //display cart, not allowing changes and without pictures
    display_cart($_SESSION['cart'], false, 0);

    display_shipping(calculate_shipping_cost());

    //Process credit card detail and display receipt or couldnt not process warning
    if(process_card($_POST)) {
      //Display receipt information
      echo "<h2>Receipt</h2><p><strong>Order Placed: $date</strong></p>";
      
      echo "<p>Name: " .$_SESSION['name']."</p>
            <p>Address: " .$_SESSION['address']. "</p>
            <p>City: " .$_SESSION['city']. "</p>
            <p>Zip: " .$_SESSION['zip']. "</p>
            <p>Country: " .$_SESSION['country']. "</p>";
     
      echo "<h3>Shipping Details</h3>";
      
      echo "<p>Name: " .$_SESSION['ship_name']."</p>
            <p>Address: " .$_SESSION['ship_address']. "</p>
            <p>City: " .$_SESSION['ship_city']. "</p>
            <p>Zip: " .$_SESSION['ship_zip']. "</p>
            <p>Country: " .$_SESSION['ship_country']. "</p>";
      
      echo "<h3>Payment Method</h3>";
      
      echo "<p>" .$card_type. " | Last Digits: " .$last_digits. "</p>";
      //Empty shopping cart
      session_destroy();
      
      echo "<p>Thank you for shopping with us. Your order has been placed.</p>";
      
      display_button("index.php", "Continue Shopping");

    } else {
      echo "<p>Could not process your card. Please contact the card issuer or try again.</p>";
      display_button("purchase.php", "Back");
    }
  } else {
    echo "<center><p>You did not fill in all the required fields.</p></center><hr/>";
    display_button("checkout.php", "Back");
  }

  do_html_footer();
?>