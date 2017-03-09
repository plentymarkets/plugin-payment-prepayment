# plentymarkets Payment – Cash in advance

With this plugin, you integrate the payment method **Cash in advance** into your online store.

## Setting up a payment method

In order to make this payment method available in your online store, you have to carry out the settings in the plentymarkets back end.

##### Setting up a payment method:

1. Go to **Settings&nbsp;» Orders&nbsp;» Cash in advance**. 
2. Select a Client (store). 
3. Carry out the settings. Pay attention to the information given in table 1. 
4. **Save** the settings.

<table>
<caption>Table 1: Carrying out settings for this payment method</caption>
	<thead>
		<th>
			Setting
		</th>
		<th>
			Explanation
		</th>
	</thead>
	<tbody>
        <tr>
			<td>
				<b>Language</b>
			</td>
			<td>
				Select a language. Other settings, such as name, info page, etc. will be saved depending on the selected language.
			</td>
		</tr>
        <tr>
			<td>
				<b>Name</b>
			</td>
			<td>
				The name of the payment method that will be displayed in the overview of payment methods in the checkout.
			</td>
		</tr>
		<tr>
			<td>
				<b>Info page</b>
			</td>
			<td>
				Select a category page of the type <strong>content</strong> or enter the URL of a website to provide <strong><a href="https://www.plentymarkets.eu/handbuch/payment/bankdaten-verwalten/#2-2">information about the payment method</a></strong>.
			</td>
		</tr>
		<tr>
			<td>
				<b>Logo</b>
			</td>
			<td>
			A HTTPS URL that leads to the logo. Valid file formats are .gif, .jpg or .png. The image may not exceed a maximum size of 190 pixels in width and 60 pixels in height.
			</td>
		</tr>
        <tr>
			<td>
				<b>Surcharge (domestic)</b>:
			</td>
			<td>
Enter a flat rate. The value that is entered will be taken into consideration for those orders that correspond to the system country. Once the customer has selected the payment method, these costs will be added to the particular order in the order process. The amount will be added to the total in the order and will not be displayed individually.
		</tr>
		<tr>
			<td>
				<b>Surcharge (foreign countries)</b>:
			</td>
			<td>
Enter a flat rate. The value that is entered will be taken into consideration for those orders that correspond to a foreign country. Once the customer has selected the payment method, these costs will be added to the particular order in the order process. The amount will be added to the total in the order and will not be displayed individually.
		</tr>
		<tr>
			<td>
				<b>Countries of delivery</b>
			</td>
			<td>
				This payment method is active only for the countries in this list.
			</td>
		</tr>
	</tbody>
</table>

## Displaying the logo of the payment method on the homepage

The template plugin **Ceres** allows you to display the logo of your payment method on the homepage by using template containers. Proceed as described below to link the logo of the payment method.

##### Linking the logo with a template container:

1. Click on **Start&nbsp;» Plugins**. 
2. Click on the **Content** tab. 
3. Go to the **Prepayment icon** area. 
4. Activate the container **Homepage: Payment method container**. 
5. **Save** the settings.<br />→ The logo of the payment method will be displayed on the homepage of the online store.

## Displaying the bank details on the order confirmation page

Proceed as follows to display the bank details that are saved in the system as well as a designated use on the order confirmation page.

##### Displaying bank details:

1. Go to **Settings&nbsp;» Orders&nbsp;» Cash in advance**. 
2. Select a Client (store). 
3. Enter the **Designated use** in the **Display data** area. 
4. Activate the option **Show designated use**. 
5. Activate the option **Show bank details**. 
6. **Save** the settings.

After these settings, link the bank details with a template container.

##### Linking the bank details with a template container:

1. Click on **Start&nbsp;» Plugins**. 
2. Click on the **Content** tab. 
3. Go to the **Prepayment bank details** area. 
4. Activate the container **Order confirmation: Additional payment information**. 
5. **Save** the settings.<br />→ The bank details will be displayed on the order confirmation page.
