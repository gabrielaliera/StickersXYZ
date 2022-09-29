<?php 
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This is one of the files imported into sticker_sc_fns.php. It contains various sticker functions.
  The first section of functions opens a connection to the database and pulls information from various
  tables- categories, stickers. The next set of functions calculate various costs like standard
  shipping, price and total items. */

/*---------------get_categories Function---------------------*/

function get_categories() {
   // query database for a list of categories
   $conn = db_connect();
   $query = "select catid, catname from categories";
   $result = @$conn->query($query);
   
   if (!$result) {
     return false;
   }
   
   $num_cats = @$result->num_rows;
   
   if ($num_cats == 0) {
      return false;
   }
   
   $result = db_result_to_array($result);
   
   return $result;
}

/*-------------get_category_name Function-------------------*/

function get_category_name($catid) {
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select catname from categories
             where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   
   return $row->catname;
}

/*-------------get_stickers Function---------------------*/

function get_stickers($catid) {
   // query database for the stickers in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from stickers where catid = '".$catid."'";
   $result = @$conn->query($query);
   
   if (!$result) {
     return false;
   }
   
   $num_sticker = @$result->num_rows;
   
   if ($num_sticker == 0) {
      return false;
   }
   
   $result = db_result_to_array($result);
   
   return $result;
}

/*-----------get_sticker_details Function----------------*/

function get_sticker_details($stickerID) {
  // query database for all details for a particular sticker
  if ((!$stickerID) || ($stickerID=='')) {
     return false;
  }
  
  $conn = db_connect();
  $query = "select * from stickers where stickerID='".$stickerID."'";
  $result = @$conn->query($query);
  
  if (!$result) {
     return false;
  }
  
  $result = @$result->fetch_assoc();
  
  return $result;
}

/*-----------calculate_price Function-----------------*/

function calculate_price($cart) {
  // sum total price for all items in shopping cart
  $price = 0.0;

  if(is_array($cart)) {
    
    $conn = db_connect();
    
    foreach($cart as $stickerID => $qty) {
      $query = "select price from stickers where stickerID='".$stickerID."'";
      
      $result = $conn->query($query);
      
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  
  return $price;
}

/*-----------calculate_items Function-----------------*/

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  
  if(is_array($cart))   {
    
    foreach($cart as $stickerID => $qty) {
      $items += $qty;
    }
  }
  
  return $items;
}

/*-----------calculate_shipping_cost Function-----------------*/

function calculate_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 5.00;
}

?>