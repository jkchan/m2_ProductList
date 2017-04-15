# Ecommistry ListProduct

## Description
This module was built to display any products for Logged In Users, this is only accessible if the customer is signed in.

## Functionalities

This module creates:
	- Customer Product Listing link and page
	- Custom product attribute for handling the display of items

This module checks:
	- If the user is logged in, this is only accessible through the My Accounts page.
	- If the user is not logged in, they would be redirected to the sign up/login page.

To display the products on the customer listing page:
	- You have to set the custom attribute of a product to Yes
	- Products has to be In Stock
	- Products must be enabled
	- Limit is not set on the admin configuration of the module.
	- If there are no products to display, it will display "There are no products matching the selection."

Customer Product Listing Page:
	- You can sort items by Ascending or Descending Order
	- You can sort by position, name or price
	- You can change the view from grid to list
	- You can limit how many it shows per page
	- You can add to cart from the page
	- Shows how many items are on the page

Admin Product Listing Configutation
	- Login to the admin page
	- Go to Stores > Configuration > Ecommistry >ProductList
	- You can enable and disable the plugin from here
	- You can change the limit from this configuration
	- Limit is set to blank or 0 will display all the products
	- Limit is set to any number greater than 0 will display the number of products.

##Installation

	1. Download or Clone the Files inside app/code/local/Ecommistry/ or if you prefer other Vendor Names app/code/local/VendorName/
	2. move the layout file layout/ecommistry_productlist.xml inside the folder to design/frontend/base/default/layout/
	3. move the template folder ecommistry to design/frontend/base/default/template/
	4. move the module file Ecommistry_ProductList.xml to app/etc/modules/
	5. If there was a change in the VendorName or ModuleName, please change accordingly inside the registration.php, config.xml, module.xml
	6. Run setup:upgrade, clear cache, reindex
	7. Check if the attribute is installed.
	8. Check if the module is successfully installed.

##Sample Data

	URL:http://139.59.246.60/
	*Use the sample account on the Login Page

	Admin URL:http://139.59.246.60/index.php/admin
	Username: admin
	Password: passw0rd

Happy Coding!



