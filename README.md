# StickersXYZ
> *StickersXYZ is an e-commerce website using a LAMP(Linux, Apache, MariaDB, and PHP).*

# What the System Does:
Users can browse between different product pages and add different stickers into their shopping cart. Users are allowed to continue to browse for more products, update their shopping cart or proceed to checkout via a credit card transaction. Information about the user is collected and inserted into database tables. This includes their payment details, billing address, shipping address, and order items. This system will provide error messages if customer details are not filled in completely. When a purchase is completed, a receipt is displayed to the user, the shopping cart empties, and a new session is created for future shopping opportunities.

# How I built it
The frontend was built using HTML and CSS. The backend was built using MariaDB and PHP. 

# Major Components
<ul>
  <li>Creating the database and tables </li>
  <li>Populating tables</li>
   <li>Designing the shopping cart system with css</li>
   <li>Creating the functions files</li>
   <li>Creating the home/index file</li>
   <li>Connecting to mysql database, import and export value into database</li>
   <li>Creating the product page for each sticker category</li>
   <li>Creating the shopping cart page</li>
   <li>Adding a product to cart and updating product quantity</li>
   <li>Handling the checkout with customer details, shipping details, and payment details</li>
   <li>Generating receipt with customer details</li>
</ul>

# Changes and Improvements
Throughout the life of the program we revise the code to make it more efficient and easier to read. We changed the store from Bookorama to StickersXYZ. As a result, we updated the database and values to reflect the change from books to stickers. This included adjusting database variable to fit the new product. Other changes to the program included:
<ul>
  <li>Changed images<br>
     &nbsp &nbsp &nbspWe added SVG images for each product</li>
  <li>Changed buttons<br>
      &nbsp &nbsp&nbspWe changed all buttons from image links to <input type=button> and add hover CSS styling</li>
  <li>Added navigation bar<br>
      &nbsp &nbsp&nbspDisplays a drop-down menu of sticker categories and About Us page</li>
  <li>Added random sticker generator<br>
        &nbsp &nbsp&nbspUsed on the home and about us page</li>
  <li>Added about us page<br>
     &nbsp &nbsp &nbspWe linked an about us page that includes the project description and team members</li>
  <li>Added db_vars file<br>
   &nbsp &nbsp &nbspWe moved sensitive information like username and password to an external file for security reasons.</li>
  <li>Added external CSS style sheet</li>
  <li>Added receipt<br>
    &nbsp &nbsp&nbspWe added more information to the final output in the final checking out process.php page. We included billing information, order date, shipping details, and payment method as output to the user after payment has processed</li>
</ul>


# Video Walkthrough
Users can:
  <ul>
    <li>Visit different categories of stickers and view product information</li>
    <li>Add and update shopping cart</li>
    <li>Checkout and add billing, shipping, and payment information</li>
    <li>View order information after purchase</li>
  </ul>

# Tech/Framework
<ul>
  <li><a href="https://www.php.net/">PHP</a></li>
  <li><a href="https://www.linux.org/pages/download/">Linux</a></li>
  <li><a href="https://httpd.apache.org/">Apache</a></li>
  <li><a href="https://mariadb.org/download/?t=mariadb&p=mariadb&r=10.11.0&os=windows&cpu=x86_64&pkg=msi&m=gigenet">MariaDB</a></li>
  <li><a href="https://www.apachefriends.org/">XAMPP</a></li>
</ul>

# Contributors
  <ul>
  <li>Gabriela Liera</li>
  <li>Jonathan Ebeung</li>
  <li>Karlos Valles</li>
  </ul>

# Notes
This project involved improving the legacy code from a hypnotical e-commerce website using a LAMP( Linux, Apache, MariaDB, and PHP). We reviewed all the files and learned how they interact in this application. I will not add new features to this application as I plan to continue working on new projects.
