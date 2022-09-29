<?php
/*Programmer Name: Gabriela Liera, Jonathan Ebueng, Karlos Valles
  Project Number: Final
  Date: 6/7/2022
  Description: This is one of the files imported into sticker_sc_fns.php. This file contains various output functions.
  The first few functions create the html code for the basic layout of the webpage. The next section contains
  display functions to display stickers,categories, shipping information and various forms. The last section 
  contains functions to create buttons and a random sticker generators.*/

/*-----------------------------do_html_heade Function8-------------------------------*/

function do_html_header($title = '') {
  // print an HTML header

  // declare the session variables we want access to inside the function
  if (empty($_SESSION['items'])) {
    $_SESSION['items'] = '0';
  }
  
  if (empty($_SESSION['total_price'])) {
    $_SESSION['total_price'] = '0.00';
  }

?>
  <DOCTYPE! html>
  <html lang= "en">
  <head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles.css">
    <meta charset = "UTF-8">
    <meta name="Programmer Name" content = "Gabriela Liera, Jonathan Ebueng, Karlos Valles">
    <meta name="Project Number" content = "CISW 31 Final Project">
    <meta name="Date" content="June 06,2022">
    <meta name= "Project Description" content ="We created a website where you can purchase various types of stickers
    through basic webpage interactions. You can click between pages, add to cart, and proceed with a transaction.">
  </head>
  <body>
  <ul class="nav">
    <li><a href="index.php"><strong>StickersXYZ</strong></a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">Stickers</a>
      <div class="dropdown-content">
        <a href="show_cat.php?catid=1">Animals</a>
        <a href="show_cat.php?catid=2">Cars</a>
        <a href="show_cat.php?catid=3">Flowers</a>
      </div>
    </li>
    <li><a href="about.php">About</a></li>
    <li id="shoppingcart">
      <?php
        echo "<a href=\"show_cart.php\"><strong>View Shopping Cart 
        </strong>(".$_SESSION['items']." items, $".number_format($_SESSION['total_price'],2).")</a>";
      ?>
    </li>
  </ul>
 
<?php
  if($title) {
    do_html_heading($title);
  }
}

/*----------------------------do_html_footer Function-------------------------------*/

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

/*--------------------------do_html_heading Function-------------------------------*/
function do_html_heading($heading) {
  // print heading
?>
  <h1><?php echo $heading; ?></h1>
<?php
}

/*---------------------------do_about Function------------------------------------*/
function do_html_about(){
?>
  <h2>Project Description</h2>
  <p>For our CISW 31 final project we created a website where you can purchase 
    various types of stickers through basic webpage interactions. You can click between pages, add to cart, and proceed with a 
    transaction. </p>
  <h2>Team Members</h2>
  <ul>
    <li>Gabriela Liera</li>
    <li>Jonathan Ebueng</li>
    <li>Karlos Valles</li>
  </ul>
  <hr>
<?php
}

/*---------------------------do_html_URL------------------------------------------*/
function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
<?php
}

/*----------------------display_categories Function-------------------------------*/
function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  echo "<ul>";
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?catid=".$row['catid'];
    $title = $row['catname'];
    echo "<li>";
    do_html_url($url, $title);
    echo "</li>";
  }
  echo "</ul>";
}

/*------------------------display_sticker Function--------------------------------*/

function display_stickers($sticker_array) {
  //display all stickers in the array passed in
  if (!is_array($sticker_array)) {
    echo "<p>No stickers currently available in this category</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each sticker
    foreach ($sticker_array as $row) {
      $url = "show_sticker.php?stickerID=".$row['stickerID'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['stickerID'].".svg")) {
        $title = "<img src=\"images/".$row['stickerID'].".svg\"
                  height=\"55\" width=\"50\" style=\"border: 1px\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }
}

/*---------------------display_sticker_details Function---------------------------*/

function display_sticker_details($sticker) {
  
  // display all details about this sticker
  if (is_array($sticker)) {
    echo "<table><tr>";
    
    //display the picture if there is one
    if (@file_exists("images/".$sticker['stickerID'].".svg")) { 
    echo "<td><img src=\"images/".$sticker['stickerID'].".svg\"
                height=\"55\" width=\"50\"
                style=\"border: 1px\"/></td>";
    }
    echo "<td><ul>";
    echo "<li><strong>Color:</strong> ";
    echo $sticker['color'];
    echo "</li><li><strong>Sticker ID:</strong> ";
    echo $sticker['stickerID'];
    echo "</li><li><strong>Our Price:</strong> ";
    echo number_format($sticker['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo $sticker['description'];
    echo "</li></ul></td></tr></table>";
  } else {
    echo "<p>The details of this sticker cannot be displayed at this time.</p>";
  }
}

/*------------------display_checkout_form Function--------------------------------*/

function display_checkout_form() {
  //display the form that asks for name and address
?>
  <br />
  <table border="0" width="100%" cellspacing="0">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Your Details</th></tr>
  <tr>
    <td>Name</td>
    <td> <input type="text" name="name" value="" maxlength="40" size="40" /></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40" /></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40" /></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40" /></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40" /></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="" maxlength="20" size="40" /></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cccccc">Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="ship_country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
     <?php echo "<br>";
      display_button("purhcase.php", "Proceed to Purchase Details");
     ?>
    </td>
  </tr>
  </table>
<?php
}

/*--------------------display_shipping Function----------------------------------*/

function display_shipping($shipping) {
  // display table row with shipping cost and total price including shipping
?>
  <table border="0" width="100%" cellspacing="0">
  <tr><td align="left">Shipping</td>
      <td align="right"> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cccccc" align="left">TOTAL INCLUDING SHIPPING</th>
      <th bgcolor="#cccccc" align="right">$ <?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

/*--------------------display_card_form Function--------------------------------*/

function display_card_form($name) {
  //display form asking for credit card details
?>
  <table border="0" width="100%" cellspacing="0">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name="card_type" required>
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="card_number" value="" maxlength="16" size="40" required></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type="text" name="amex_code" value="" maxlength="4" size="4" required></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month
       <select name="card_month" required>
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Year
       <select name="card_year" required>
       <option value="2022">2022</option>
       <option value="2023">2023</option>
       <option value="2024">2024</option>
       <option value="2025">2025</option>
       <option value="2026">2026</option>
       <option value="2027">2027</option>
       </select>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type="text" name="card_name" value = "<?php echo $name; ?>" maxlength="40" size="40" required></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
     <?php display_button("process.php", "Purchase");?>
    </td>
  </tr>
</form>
  </table>
<?php
}

/*-----------------------display_cart Function----------------------------------*/

function display_cart($cart, $change = true, $images = 1) {
  // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cccccc\">Item</th>
         <th bgcolor=\"#cccccc\">Price</th>
         <th bgcolor=\"#cccccc\">Quantity</th>
         <th bgcolor=\"#cccccc\">Total</th>
         </tr>";

  //display each item as a table row
  foreach ($cart as $stickerID => $qty)  {
    $sticker = get_sticker_details($stickerID);
    echo "<tr>";
    if($images == true) {
      echo "<td align=\"left\">";     
      if (file_exists("images/".$stickerID.".svg")) {
        echo "<img src=\"images/".$stickerID.".svg\"
              height=\"55\" width=\"50\"
              style=\"border: 1px solid black\"/>";
      } else {
         echo "&nbsp;";
      }
      echo "</td>";
    }
    echo "<td align=\"left\">
          <a href=\"show_sticker.php?stickerID=".$stickerID."\">".$sticker['title']."</a></td>
          <td align=\"center\">\$".number_format($sticker['price'], 2)."</td>
          <td align=\"center\">";

    // if we allow changes, quantities are in text boxes
    if ($change == true) {
      echo "<input type=\"text\" name=\"".$stickerID."\" value=\"".$qty."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td align=\"center\">\$".number_format($sticker['price']*$qty,2)."</td></tr>\n";
  }
  // display total row
  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#cccccc\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#cccccc\">".$_SESSION['items']."</th>
        <th align=\"center\" bgcolor=\"#cccccc\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  // display save change button
  if($change == true) {
    echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"submit\" value=\"Save Changes\"
                    border=\"0\" alt=\"Save Changes\"
                    style=\"background-color: white;border-style: solid;
                    border-color: black;
                    font-size: 14px;
                    margin: 16px;
                    padding: 8px 12px;
                    outline-style:none;\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}

/*-------------------------display_button Function------------------------------*/
function display_button($target, $text) {
  echo "<div align=\"center\"><button onclick=window.location.href=\"{$target}\">{$text}</button></div>";
  
}

/*-----------------------display_form_button Function---------------------------*/
function display_form_button($target, $text) {
  echo "<div align=\"center\">
        <input type=\"submit\" value=\"{$text}\" required
        onclick=window.location.href=\"{$target}.php\">
        </div>";
}

/*-------------------------random_sticker Function------------------------------*/
function random_sticker() {
  $conn = db_connect();
  
  // Sort all stickers randomly and choose the first one in the list
  $query = "select * from stickers order by rand() limit 3;";
  
  $result = $conn->query($query);
  
  if (!$result) {
    echo "<p>Database access failed</p>";
  } else {
    for ($i = 0; $i < 3; $i++) {
      $sticker = $result->fetch_array();
      $url = "show_sticker.php?stickerID=".$sticker['stickerID'];
      echo "</h2>";
      $title = $sticker['title'];
      echo "<h2>";
      do_html_url($url, $title);
      echo "</h2>";
      echo "<br>";
      display_sticker_details($sticker);
    }
  }
}

?>