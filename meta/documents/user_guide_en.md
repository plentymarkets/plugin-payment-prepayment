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
<caption>Table 1: Carrying out settings for the payment method</caption>
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
				Select a language. Other settings, such as name, info page, etc., will be saved depending on the selected language.
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
		<!--tr>
			<td>
				<b>Infoseite</b>
			</td>
			<td>
				Als <a href="https://www.plentymarkets.eu/handbuch/payment/bankdaten-verwalten/#2-2"><strong>Information zur Zahlungsart</strong></a> eine Kategorieseite vom Typ <strong>Content</strong> anlegen oder die URL einer Webseite eingeben.
			</td>
		</tr-->
		<tr>
			<td>
				<b>Logo</b>
			</td>
			<td>
			Select either no logo, <strong>Default logo</strong> or <strong>Logo URL</strong>.<br /><strong>Default logo:</strong> Display the default logo of the payment method in the checkout.<br /><strong>Logo URL:</strong> Enter a HTTPS URL that leads to the logo. Valid file formats are .gif, .jpg or .png. The image may not exceed a maximum size of 190 pixels in width and 60 pixels in height.
			</td>
		</tr>
        <tr>
			<td>
				<b>Surcharge (domestic)</b>
			</td>
			<td>
Enter a flat rate. The value that is entered will be taken into consideration for those orders that correspond to the system country. Once the customer has selected the payment method, these costs will be added to the particular order in the order process. The amount will be added to the total in the order and will not be displayed individually.
		</tr>
		<tr>
			<td>
				<b>Surcharge (foreign countries)</b>
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
        <tr>
			<td colspan="2" class="th">Display data</td>  
		</tr>
		<tr>
			<td>
				<b>Designated use</b>
			</td>  
			<td>
			Enter the designated use for this payment method.
			</td>
		</tr>
		<tr>
			<td>
				<b>Show designated use</b>
			</td>  
			<td>
			Activate to display the designated use on the order confirmation page. This information must be linked with the respective <a href="#10."><strong>template container</strong></a>.
			</td>
		</tr>
		<tr>
			<td>
				<b>Show bank details</b>
			</td>  
			<td>
			Activate to display the bank details on the order confirmation page. Go to <strong>Settings » Basic settings » Bank</strong> to save bank details.
			</td>
		</tr>
	</tbody>
</table>

## Displaying the logo of the payment method on the homepage

The template plugin **Ceres** allows you to display the logo of your payment method on the homepage by using template containers. Proceed as described below to link the logo of the payment method.

##### Linking the logo with a template container:

1. Go to **Plugins » Content**.
3. Go to the **Cash in advance icon** area. 
4. Activate the container **Homepage: Payment method container**. 
5. **Save** the settings.<br />→ The logo of the payment method will be displayed on the homepage of the online store.

## Displaying the bank details on the order confirmation page <a id="10." name="10."></a>

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

1. Go to **Plugins » Content**.
3. Go to the **Cash in advance bank details** area. 
4. Activate the container **Order confirmation: Additional payment information**. 
5. **Save** the settings.<br />→ The bank details will be displayed on the order confirmation page.

## Reinitialising the payment

You can offer your customers to reinitialise the payment. To do so, proceed as follows.

##### Reinitialising the payment:

1. Go to **Plugins » Content**.
2. Go to **PrePayment Reinitialise Payment (PrePayment)**.
3. Activate the container **My account: Additional payment information**.<br />→ The customer can reinitialise the payment in the order history in the **My Account** area. 
3. Activate the container **Order confirmation: Additional payment information**.<br />→ The customer can reinitialise the payment on the order confirmation page.
4. Go to **PrePayment Reinitialise Payment Script (PrePayment)**.
5. Activate the container **Script loader: Register/load JS**.
6. **Save** the settings.

The customer can now reinitialise the payment either in the order history in the **My Account** area or on the order confirmation page. For Cash in advance, this means accessing once more the bank data saved in the backend.

## License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE. – find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-payment-prepayment/blob/master/LICENSE.md).
