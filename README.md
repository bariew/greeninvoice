Greeninvoice API client.
===================

Description
-----------
Generates invoices for your business


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bariew/greeninvoice
```

or add

```
"bariew/greeninvoice": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

```
$invoiceId = Api::instance(<your greeninvoice ID>, <you greeninvoice secret>, "https://api.greeninvoice.co.il/api/v1")
->createInvoice("Invoice Description", "Client Name", "Client Email", "Item Name", "Item Price", 'en', 'USD');
```
