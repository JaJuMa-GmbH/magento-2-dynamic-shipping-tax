# Dynamic Shipping Tax for Magento 2 by [JaJuMa](https://www.jajuma.de/)

<img align="right" width="300" height="auto" src="https://www.jajuma.de/media/wysiwyg/jajuma-develop/dynamic-shipping-tax-extension-for-magento-2/Dynamic-Shpping-Tax-Module-Magento-2-large.png">  

Dynamic Shipping Tax extension by [JaJuMa](https://www.jajuma.de/en) allows  
dynamic shipping tax calculation for Magento 2 sites.

> **Note**  
> Looking for [proportional/pro-rata shipping tax calculation - Click Here!](https://www.jajuma.de/en/jajuma-develop/magento-extensions/proportional-pro-rata-dynamic-shipping-tax-plus-extension-for-magento-2)?
>

## Compatible with  

<td>
    <table>
     <tr>
        <td><b>Hyvä Themes</b></td>
        <td><b>Mage-OS</b></td>
        <td><b>Magento</b></td>
     </tr>
     <tr>
       <td><a href="https://www.jajuma.de/en/jajuma-shop/online-shop-with-magento-2-and-hyva-themes"><img align="left" width="80" src="https://www.jajuma.de/media/wysiwyg/jajuma-shop/magento-with-hyva/JaJuMa-Hyvanaut-small.png"></a></td>
       <td><a href="https://www.jajuma.de/en/jajuma-shop/demo-shop-with-mage-os-and-hyva-themes"><img align="left" width="80" src="https://www.jajuma.de/media/wysiwyg/jajuma-develop/Mage-OS-Compatible.svg"></a></td>
       <td><a href="https://www.jajuma.de/en/jajuma-shop"><img align="left" height="60" src="https://www.jajuma.de/media/wysiwyg/jajuma-develop/magento-icon.svg"></a></td>
    </tr>
    </table>
</td>

## Further Info, Extension Description & Manual

* [Extension Website EN](https://www.jajuma.de/en/jajuma-develop/magento-extensions/dynamic-shipping-tax-extension-for-magento-2)
* [Extension Website DE](https://www.jajuma.de/de/jajuma-develop/magento-extensions/dynamic-shipping-tax-extension-fuer-magento-2)

## Demos

* [Dynamic Shipping Tax Demo on Luma Theme](https://www.jajuma.de/en/jajuma-shop/demo-shop-with-magento-2)
* [Dynamic Shipping Tax Demo on Hyvä Theme](https://www.jajuma.de/en/jajuma-shop/demo-shop-with-magento-2-and-hyva-themes)
* [Dynamic Shipping Tax Demo on Mage-OS](https://www.jajuma.de/en/jajuma-shop/demo-shop-with-mage-os-and-hyva-themes)

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

> :bangbang: **Note**  
> :bangbang: Looking for [proportional/pro-rata shipping tax calculation - Click Here!](https://www.jajuma.de/en/jajuma-develop/magento-extensions/proportional-pro-rata-dynamic-shipping-tax-plus-extension-for-magento-2)?

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

> :bangbang: **Note**  
> :bangbang: Looking for [proportional/pro-rata shipping tax calculation - Click Here!](https://www.jajuma.de/en/jajuma-develop/magento-extensions/proportional-pro-rata-dynamic-shipping-tax-plus-extension-for-magento-2)?

## License

The code is licensed under the [MIT License (MIT)](https://github.com/JaJuMa/AwesomeHyva/blob/master/LICENSE)

## Other [Magento 2 Extensions](ttps://www.jajuma.de/en/jajuma-develop/magento-extensions) by [JaJuMa](https://www.jajuma.de/)

* :framed_picture: Performance & UX:<br>[Ultimate Image Optimizer for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/ultimate-image-optimizer-extension-for-magento-2)<br>
  AVIF & WebP Images, Lazy Loading, High-Resolution / Retina images

* :framed_picture: Performance & UX:<br>[WebP Optimized Images for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/webp-optimized-images-extension-for-magento-2#portfolio-content)<br>
  The #1 WebP Images Solution for Magento 2

* :see_no_evil: SEO:<br>[PRG Pattern Link Masking for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/prg-pattern-link-masking-for-magento-2)<br>
  Link Masking for Layered Navigation

* :cop: User Experience:<br>[Shariff Social Share for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/shariff-social-share-buttons-extension-for-magento-2)<br>
  GDPR compliant and customizable Sharing Buttons

* :movie_camera: Content Management:<br>[Video Widget for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/video-widget-gdpr-extension-for-magento-2)<br>
  Embedding YouTube videos, GDPR compliant with auto preview image & fully responsive

* :rocket: Performance & UX:<br>[Page Preload for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/page-preload-extension-for-magento-2)<br>
  Faster faster page transitions and subsequent page-loads by preloading / prefetching

* :chart_with_upwards_trend: Marketing:<br>[Matomo Analytics for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/honey-spam-anti-spam-extension-for-magento-2)<br>
  Web Analytics - GDPR Compliant

* :honey_pot: Site Optimization:<br>[Honey Spam Anti-Spam for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/honey-spam-anti-spam-extension-for-magento-2)<br>
  Spam Protection - Reliable & GDPR Compliant

* :bell: Marketing:<br>[Customer Registration Reminder & Cleanup for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/customer-registration-reminder-and-cleanup-extension-for-magento-2)<br>
  Increase Your Customer Engangement & Cleanup your Customer Account Data Automatically

* :mega: UX & Marketing:<br>[Category Grid Callouts for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/category-grid-callouts-extension-for-magento-2)<br>
  Enrich Your Category Grids With Eye-Catching Callouts

* :thought_balloon: UX & Marketing:<br>[Customer Satisfaction Feedback for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/category-grid-callouts-extension-for-magento-2)<br>
  Collect Valuable Feedback From Your Customers & Understand How To Satisfy Your Customers

* :sparkler: UX:<br>[Auto Select Options for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/auto-select-options-extension-for-magento-2)<br>
  Automatically Select Configurable & Custom Options Based On Your Customer's Preferences

* :left_right_arrow: UX & Performance:<br>[Back Forward Cache - bfcache for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/back-forward-cache-extension-for-magento-2)<br>
  Enable bfcache for Magento 2 for improved UX & Core Web Vitals

* :heavy_division_sign: Accounting:<br>[Dynamic Shipping Tax Plus for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/proportional-pro-rata-dynamic-shipping-tax-plus-extension-for-magento-2)<br>
  Dynamic Shipping Tax Calculation incl. pro-rata/proportional tax rates

* :mag: Search:<br>[MySQL Search for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/magento-without-elasticsearch-mysql-search-extension-for-magento-2)<br>
  MySQL Search for Magento 2 without Elasticsearch

* :bangbang: Performance:<br>[Preload Critical Resources & Assets](https://www.jajuma.de/en/jajuma-develop/magento-extensions/resource-hints-preload-critical-resources-assets-extension-for-magento-2)<br>
  Resource Hints for preloading important and critical resources

* :octocat: Content Management:<br>[git 4 Page Builder](https://www.jajuma.de/en/jajuma-develop/magento-extensions/git-4-page-builder-extension-for-magento-2)<br>
  Manage & deploy Magento 2 Page Builder content via git

* :rocket: Performance:<br>[Hyvä Inline CSS](https://www.jajuma.de/en/jajuma-develop/magento-extensions/hyva-inline-css-extension-for-magento-with-hyva-themes)<br>
  Run Magento 2 without CSS file by inline all CSS

* :man_technologist: :free: Content Management:<br>[Syntax Highlighter 4 Page Builder](https://www.jajuma.de/en/jajuma-develop/magento-extensions/syntax-highlighter-4-page-builder-extension-for-magento-2)<br>
  Syntax Highlighting and more for Magento 2 Page Builder

* :triangular_flag_on_post: :free: UI & UX:<br>[Awesome Hyvä for Hyvä Themes](https://www.jajuma.de/en/jajuma-develop/magento-extensions/font-awesome-icons-for-hyva-themes-extension)<br>
  Font Awesome 5 & 6 Icons for your [Hyvä Themes](https://www.jajuma.de/de/jajuma-shop/online-shop-mit-magento-2-und-hyva-themes) Store

* :triangular_flag_on_post: :free: UI & UX:<br>[Hyvä Flags for Hyvä Themes](https://www.jajuma.de/en/jajuma-develop/magento-extensions/country-language-flag-icons-for-hyva-themes-extension)<br>
  Country & Language Flag Icons for your [Hyvä Themes](https://www.jajuma.de/de/jajuma-shop/online-shop-mit-magento-2-und-hyva-themes) Store

* :ok_man: :free: User Experience:<br>[Customer Navigation Manager for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/customer-navigation-manager-extension-for-magento-2)<br>
  Easily manage the links in your Customer Account

* :heavy_division_sign: :free: Accounting:<br>[Dynamic Shipping Tax for Magento 2](https://www.jajuma.de/en/jajuma-develop/magento-extensions/dynamic-shipping-tax-extension-for-magento-2)<br>
  Dynamic Shipping Tax Calculation

* :question: :free: Content:<br>[Hyvä FAQ Widget for Hyvä Themes](https://www.jajuma.de/en/jajuma-develop/magento-extensions/hyva-faq-widget-extension-for-hyva-themes)<br>
  FAQ Widget for your [Hyvä Themes](https://www.jajuma.de/de/jajuma-shop/online-shop-mit-magento-2-und-hyva-themes) Store

* :question: :free: Admin Tools:<br>[Magento Power Toys](https://www.jajuma.de/en/jajuma-develop/magento-extensions/power-toys-for-magento-2)<br>
  Tools and helpers, a.k.a "Toys", for Magento Admins

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