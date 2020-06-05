# Release Notes for Cash in advance

## 3.0.2 (2020-05-27)

### Changed
- Added Icon for the backend

## 3.0.1 (2020-03-24)

### Changed
- Some texts have been adapted
- Added methods for the backend visibility and backend name

## 3.0.0 (2019-11-18)
 
### Note 
- The settings for the Cash in advance plugin have been transferred to an assistant in the **Setup » Assistants » Payment** menu.

### Changed
- The description and the name of the payment method is now also maintained via **CMS » Multilingualism**.


## 2.1.0 (2019-07-01)

### Fixed

- The button for "Show bank details" is now correctly displayed for the cash in advance payment methods.

## 2.0.13 (2019-06-27)

### Fixed

- A Javascript error that could occur on the order confirmation page has been fixed.

## 2.0.12 (2019-02-24)

### Changed

- The settings for shipping countries have been optimized.

## 2.0.11 (2018-10-23)

### Fixed

- A possible problem with deploying the plugin has been fixed.

## 2.0.10 (2018-10-04)

### Changed

- Update Support informations

## 2.0.9 (2018-08-07)

### Changed

- The plugin user guide has been updated.

## 2.0.8 (2018-08-06)

### Added

- More languages for the plugin UI have been added.

### Changed

- Language-dependent texts can now be edited via the multilingualism interface.

## 2.0.5 (2018-07-30)

### Fixed

- Problems with displaying and saving multi-client settings in the Plugin-UI have been fixed.

## 2.0.4 (2018-06-13)

### Fixed

- The bank data on the order confirmation page will now be displayed just once.

## 2.0.3 (2018-06-07)

### Fixed

- The display of bank data is now responsive.

## 2.0.2 (2018-06-06)

### Fixed

- Fixed a problem relating to the display of account data in My Account.

## 2.0.1 (2018-04-05)

### Fixed

- The correct path for displaying the icon of the payment method is now used.

## 2.0.0 (2018-03-29)

### Changed

- Plugin name change from **PrePayment** to **CashInAdvance**. The functionality is not affected.
- The bank details are displayed in the checkout and on the order confirmation page correct again.

## 1.3.2 (2018-01-26)

### Changed
- Expanded user guide.

## 1.3.1 (2018-01-09)

### Changed

- New menu path **System&nbsp;» Orders&nbsp;» Payment » Plugins » Cash in advance**.

## 1.3.0 (2017-11-29)

### Changed

- Ceres 2.0 compatible.

## 1.2.4 (2017-11-23)

### Fixed

- The `$MethodOfPaymentName` variable will now be displayed in the respective language in email templates.

## 1.2.3 (2017-17-22)

### Changed

- Update User guide

## 1.2.2 (2017-10-26)

### Changed

- The entry point in the system tree is now **System » Orders » Payment » PrePayment » Cash in advance**.

## 1.2.1 (2017-10-10)

### Added

- The order ID can now be displayed in the designated use. To do so, use the placeholder **%s** in the respective text area in the plugin settings.

## 1.2.0 (2017-08-31)

### Added

- The bank details are displayed in the checkout and on the order confirmation page.

### TODO

- Under **PrePayment Scripts**, the link has to be changed from **Script loader: Register/load JS** to **Script loader: After scripts loaded**.

## 1.1.0 (2017-07-31)

### Added

- Settings for **Info page** were added.
- Settings for **Description** were added.
- The functionality **Reinitialise payment** was added.

### Changed

- Removed surcharges for the payment method.

## 1.0.4 (2017-07-13)

### Added

- A method was added to determine if a customer can switch from this payment method to another payment method.
- A method was added to determine if a customer can switch to this payment method from another payment method.

## 1.0.3 (2017-06-26)

### Fixed

- The correct path for displaying the icon of the payment method is now used.

## 1.0.2 (2017-03-15)

### Fixed

- The CSS of the **Settings** in the back end has been fixed. The settings will now cover the entire width.

### Known issues

- At the moment, the **Surcharges** settings have no functionality in the price calculation of the checkout page

## 1.0.1 (2017-03-14)

### Changed

- For this payment method, the payment method ID from the system will be used

## 1.0.0 (2017-03-10)

### Features

- Payment method **Cash in advance** for plentymarkets online stores
- Display of designated use and bank details on the order confirmation page
