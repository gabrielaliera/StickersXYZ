<?php
  /*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: The job of this file is to continue with the payment process. After the user enters customer and shipping details, this page is displayed. 
  The shopping cart is displayed along with the added shipping cost.  A credit card form is displayed to prompt the user to enter their payment information.
  This file uses the function insert_order() to insert customer and payment details into corresponding tables. The program will prompt the user if credit card
  information is missing.*/
  
  include ('sticker_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header("Checkout");

  // create short variable names
  $name = $_POST['name'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $country = $_POST['country'];

  //Create short variable for shipping details
  if ($_POST['ship_name'] == ""){
    $ship_name = $_POST['name'];
  } else{
    $ship_name = $_POST['ship_name'];
  }

  if ($_POST['ship_address'] == ""){
    $ship_address = $_POST['address'];
  } else{
    $ship_address = $_POST['ship_address'];
  }

  if ($_POST['ship_city'] == ""){
    $ship_city = $_POST['city'];
  } else{
    $ship_city = $_POST['ship_city'];
  }

  if ($_POST['ship_zip'] == ""){
    $ship_zip = $_POST['zip'];
  } else{
    $ship_zip = $_POST['ship_zip'];
  }

  if ($_POST['ship_country'] == ""){
    $ship_country = $_POST['country'];
  } else{
    $ship_country = $_POST['ship_country'];
  }

  //Create session variable
  $_SESSION['name'] =$name;
  $_SESSION['address'] =$address;
  $_SESSION['city'] =$city;
  $_SESSION['zip'] =$zip;
  $_SESSION['country'] =$country;
  
  $_SESSION['ship_name'] =$ship_name;
  $_SESSION['ship_address'] =$ship_address;
  $_SESSION['ship_city'] =$ship_city;
  $_SESSION['ship_zip'] =$ship_zip;
  $_SESSION['ship_country'] =$ship_country;

  // if filled out
  if (($_SESSION['cart']) && ($name) && ($address) && ($city) && ($zip) && ($country)) {
    // able to insert into database
    if(insert_order($_POST) != false ) {
      //display cart, not allowing changes and without pictures
      display_cart($_SESSION['cart'], false, 0);

      display_shipping(calculate_shipping_cost());

      //get credit card details
      display_card_form($name);

    } else {
      echo "<p>Could not store data, please try again.</p>";
      display_form_button("checkout.php", "Back");
    }
  } else {
    echo "<p>You did not fill in all the fields, please try again.</p><hr />";
    display_button('checkout.php', 'Back');
  }

  do_html_footer();
?>