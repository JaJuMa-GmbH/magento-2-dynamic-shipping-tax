# Dynamic Shipping Tax for Magento 2 by [JaJuMa](https://www.jajuma.de/)

<img align="right" width="300" height="300" src="https://www.jajuma.de/sites/default/files/ckfinder/userfiles/images/jajuma-develop/dynamic-shipping-tax-magento/Dynamic-Shpping-Tax-Module-Magento-2-large.png">

Dynamic Shipping Tax extension by [JaJuMa](https://www.jajuma.de/en) allows dynamic shipping tax calculation for Magento 2 sites.
  
## Further Info, Extension Description & Manual

* [Extension Website EN](https://www.jajuma.de/en/jajuma-develop/extensions/dynamic-shipping-tax-extension-for-magento-2)
* [Extension Website DE](https://www.jajuma.de/de/jajuma-develop/extensions/dynamic-shipping-tax-extension-fuer-magento-2)

## Demos

* [Dynamic Shipping Tax Demo on Luma Theme](https://www.jajuma.de/en/jajuma-shop/demo-shop-with-magento-2)
* [Dynamic Shipping Tax Demo on Hyvä Theme](https://www.jajuma.de/en/jajuma-shop/demo-shop-with-magento-2-and-hyva-themes)

## Installation

Install via composer as any other Magento extension from github:
```
composer require jajuma/dynamicshippingtax
```

## Using dynamic shipping tax rates in Magento with JaJuMa "Dynamic Shipping Tax" module

Go to **JaJuMa -> Dynamic Shipping Tax -> Configuration -> Tax Classes**  
And find the **"Dynamic Shipping Tax Class"** configuration which provides 3 options:

1. No dynamic shipping tax calculation  
   -> Magento default config "Tax Class for Shipping" will be used for calculating shipping tax</li>
2. Use the highest product tax  
   -> The highest product tax rate in cart will be used for calculating shipping tax  
3. Use highest amount tax  
-> Tax rate applicable to highest amount in cart will be used for calculating shipping tax  

Examples for "Use the highest product tax":  
```
All Products in Cart have tax class = 7%
-> Shipping tax = 7%

All Products in Cart have tax class = 19%
-> Shipping tax = 19%

Some Product in Cart have 7%, some have 19%
-> Shipping tax = 19%
```

Examples for "Use highest amount tax":  
```
Example 1
Cart Total 100
		Books (Tax 7%)	60 €
		CDs   (Tax 19%)	40 €
		Shipping Tax -> 7%

Example 2
Cart Total 100
		Books (Tax 7%)	40 €
		CDs   (Tax 19%)	60 €
		Shipping Tax -> 19%
```

## License

The code is licensed under the [MIT License (MIT)](https://github.com/JaJuMa/AwesomeHyva/blob/master/LICENSE)

## Other [Magento 2 Extensions](ttps://www.jajuma.de/en/jajuma-develop/magento-extensions) by [JaJuMa](https://www.jajuma.de/)

  * :framed_picture: Performance & UX:<br>[WebP Optimized Images for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/webp-optimized-images-extension-for-magento-2#portfolio-content)<br>
  The #1 WebP Images Solution for Magento 2
   
  * :see_no_evil: SEO:<br>[PRG Pattern Link Masking for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/prg-pattern-link-masking-for-magento-2)<br>
  Link Masking for Layered Navigation
  
  * :cop: User Experience:<br>[Shariff Social Share for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/shariff-social-share-buttons-extension-for-magento-2)<br>
  GDPR compliant and customizable Sharing Buttons
  
  * :ok_man: User Experience:<br>[Customer Navigation Manager for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/customer-navigation-manager-extension-for-magento-2)<br>
  Easily manage the links in your Customer Account
  
  * :movie_camera: Content Management:<br>[Video Widget for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/video-widget-gdpr-extension-for-magento-2)<br>
  Embedding YouTube videos, GDPR compliant with auto preview image & fully responsive
  
  * :rocket: Performance & UX:<br>[Page Preload for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/page-preload-extension-for-magento-2)<br>
  Faster faster page transitions and subsequent page-loads by preloading / prefetching

  * :chart_with_upwards_trend: Marketing:<br>[Matomo Analytics for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/honey-spam-anti-spam-extension-for-magento-2)<br>
  Web Analytics - GDPR Compliant

  * :honey_pot: Site Optimization:<br>[Honey Spam Anti-Spam for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/honey-spam-anti-spam-extension-for-magento-2)<br>
  Spam Protection - Reliable & GDPR Compliant

  * :bell: Marketing:<br>[Customer Registration Reminder & Cleanup for Magento 2](https://www.jajuma.de/en/jajuma-develop/extensions/customer-registration-reminder-and-cleanup-extension-for-magento-2)<br>
  Increase Your Customer Engangement & Cleanup your Customer Account Data Automatically
  
  * :triangular_flag_on_post: UI & UX:<br>[Awesome Hyvä for Hyvä Themes](https://www.jajuma.de/en/jajuma-develop/extensions/font-awesome-icons-for-hyva-themes-extension)<br>
  Font Awesome 5 & 6 Icons for your [Hyvä Themes](https://www.jajuma.de/de/jajuma-shop/online-shop-mit-magento-2-und-hyva-themes) Store  

## Other [Services](https://www.jajuma.de/en/jajuma/company-magento-ecommerce-agency-stuttgart) by [JaJuMa](https://www.jajuma.de/)

  * :shopping: [JaJuMa-Market: Marketplace Software](https://www.jajuma.de/en/jajuma-market)<br>
   Complete Online Marketplace Software Solution. For Professional Demands. Feature Rich. Flexibly Customizable.
   
  * :shopping_cart: [JaJuMa-Shop](https://www.jajuma.de/en/jajuma-shop)<br>
   Customized Magento Shop Solutions.

  * :rocket: [JaJuMa-Shop: Hyvä Magento Shop Development](https://www.jajuma.de/de/jajuma-shop/online-shop-mit-magento-2-und-hyva-themes)<br>
   Hyvä Magento Shop Development.
   
  * :orange_book: [JaJuMa-Shop: Magento Handbuch in Deutsch](https://www.jajuma.de/de/jajuma-shop/magento-2-handbuch/)<br>
   Magento Handbuch in Deutsch.    
   
  * :card_index_dividers: [JaJuMa-PIM](https://www.jajuma.de/en/jajuma-pim)<br>
   Product Information Management. Simple. Better.

  * :heavy_plus_sign: [JaJuMa-Develop: Magento 2 Extensions](https://www.jajuma.de/en/jajuma-develop/magento-extensions)<br>
   Individual Solutions For Your Business Case.    
   
  * :paintbrush: [JaJuMa-Design](https://www.jajuma.de/en/jajuma-design)<br>
   Designs That Inspire.  
   
  * :necktie: [JaJuMa-Consult](https://www.jajuma.de/en/jajuma-consult)<br>
   We Show You New Perspectives.  

© JaJuMa GmbH | [www.jajuma.de](www.jajuma.de)