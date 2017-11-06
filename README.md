coinwidget.com
==============

*The Bitcoin, Litecoin and Dashcoin Donation Button*

CoinWidget was created by http://scotty.cc/ visit http://coinwidget.com/ for full documentation, demo, and a link code wizard.
Dashcoin support added by https://github.com/SoulisTech/coinwidget.com

Released under the Open Source **MIT License** (see **LICENSE** file for details).

Please help keep this project alive! Tell someone about this widget! 

Donations are welcome and will go towards further development of this project as well as other crypto related projects. Use the wallet addresses below to donate. 

	BTC: 34tCGYAz3nhVHrR2mVghX1CmzCRn42Xjnd
	LTC: LiQx6gwLwXM8C1EHVAF7DqVdNFvgHgojmj

*Thank you for your support and generosity!*


Installation
==============
A. Grab the latest version from GitHub: https://github.com/chezinut/coinwidget.com

B. Open **widget/coin.js** and find:
	source: 'http://coinwidget.com/widget/'
   Change the URL portion of this line to your own server/path.

C. Include *js* and *css* in the head of the page.

	<script type="text/javascript" src="./res/coin.js"></script>

D. Paste this code where you want to see the button

```html
<script type="text/javascript">
	CoinWidgetCom.go({
		wallet_address: "34tCGYAz3nhVHrR2mVghX1CmzCRn42Xjnd"
		, currency: "bitcoin"
		, counter: "count"
		, alignment: "bl"
		, qrcode: false
		, auto_show: false
		, auto_show: true
		, lbl_button: "buy me a beer"
		, lbl_address: "Donate Bitcoin to this Address:"
		, lbl_count: "donations"
		, lbl_amount: "BTC"
	});
</script>
```

E. __Customize!__

| Option      | Default Value         | Acceptable Values | Description                                                                                                                                 |
|-------------|-----------------------|-------------------|---------------------------------------------------------------------------------------------------------------------------------------------|
| qrcode      | true                  | true - false      | Set to true if you want to show the QR code generator that appears at the bottom left of the window. Set to false to hide the QR code icon. |
| auto_show   | false                 | true - false      | Set to true if you want the window to auto appear as soon as the counter finishes loading.                                                  |
| lbl_button  | Donate Bitcoin      | (anything)        | Change the text of the label on the main button.                                                                                            |
| lbl_address | My Bitcoin Address: | (anything)        | The text that appears above your wallet address within the window.                                                                          |
| onShow      | null                  | function          | Execute a function when the window opens.                                                                                                   |
| onHide      | null                  | function          | Execute a function when the window closes.                       

F. (optional) Open **lookup.php** and consider implementing a caching method based on your own style and preference.


Example Code
==============

See the file: **code-sample.html**

The complete list of the options and acceptable values can be found on http://coinwidget.com/.

You can also use the wizard on http://coinwidget.com/ to generate linking codes, just be sure to change: `<script src="http://coinwidget.com/widget/coin.js"></script>` to use your own hosted copy of coin.js.

