<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This file includes two order functions. The first function , process_card, validates credit card details. This function 
  is currently a placeholder until more advance credit card validation is created. The second function, insert_order, extracts 
  customer details and order details from the customer form. After connecting to the database, it inserts the values into the 
  customer table and order details into the orders table. It also inserts sticker order-details into the order_items table.*/

/*---------------------------process_card Function-------------------------*/

function process_card($card_details) {
  // connect to payment gateway or store in DB for future project
  return true;
}

/*-------------------------insert_order Function---------------------------*/

function insert_order($order_details) {
  // extract order_details out as variables
  extract($order_details);

  // set shipping address same as address
  if((!$ship_name) && (!$ship_address) && (!$ship_city) && (!$ship_state) && (!$ship_zip) && (!$ship_country)) {
    $ship_name = $name;
    $ship_address = $address;
    $ship_city = $city;
    $ship_state = $state;
    $ship_zip = $zip;
    $ship_country = $country;
  }

  //Connect to database
  $conn = db_connect();

  // we want to insert the order as a transaction
  // start one by turning off autocommit
  $conn->autocommit(FALSE);

  // insert customer address
  $query = "select customerid from customers where
            name = '".$name."' and address = '".$address."'
            and city = '".$city."' and state = '".$state."'
            and zip = '".$zip."' and country = '".$country."'";

  $result = $conn->query($query);

  if($result->num_rows>0) {
    $customer = $result->fetch_object();
    $customerid = $customer->customerid;
  } else {
    $query = "insert into customers values
            ('', '".$name."','".$address."','".$city."','".$state."','".$zip."','".$country."')";
    $result = $conn->query($query);

    if (!$result) {
       return false;
    }
  }

  $customerid = $conn->insert_id;

  $date = date("Y-m-d");
  define("PARTIAL","PARTIAL"); 
  
  $query = "insert into orders values
            ('', '".$customerid."', '".$_SESSION['total_price']."', '".$date."', '".PARTIAL."',
             '".$ship_name."', '".$ship_address."', '".$ship_city."', '".$ship_state."',
             '".$ship_zip."', '".$ship_country."')";

  $result = $conn->query($query);
  if (!$result) {
    return false;
  }

  $query = "select orderid from orders where
               customerid = '".$customerid."' and
               amount > (".$_SESSION['total_price']."-.001) and
               amount < (".$_SESSION['total_price']."+.001) and
               date = '".$date."' and
               order_status = 'PARTIAL' and
               ship_name = '".$ship_name."' and
               ship_address = '".$ship_address."' and
               ship_city = '".$ship_city."' and
               ship_state = '".$ship_state."' and
               ship_zip = '".$ship_zip."' and
               ship_country = '".$ship_country."'";

  $result = $conn->query($query);

  if($result->num_rows>0) {
    $order = $result->fetch_object();
    $orderid = $order->orderid;
  } else {
    return false;
  }

  // insert each sticker
  foreach($_SESSION['cart'] as $stickerID => $quantity) {
    $detail = get_sticker_details($stickerID);
    $query = "delete from order_items where
              orderid = '".$orderid."' and stickerID = '".$stickerID."'";
    $result = $conn->query($query);
   
    $query = "insert into order_items values
              ('".$orderid."', '".$stickerID."', ".$detail['price'].", $quantity)";
    $result = $conn->query($query);
    
    if(!$result) {
      return false;
    }
  }

  // end transaction
  $conn->commit();
  $conn->autocommit(TRUE);

  return $orderid;
}

?>