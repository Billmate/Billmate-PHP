# Billmate PHP class for communication with Billmate API version 2
By Billmate AB - [https://billmate.se](https://billmate.se/ "billmate.se")

Documentation regarding the API used in this class file can be found [here](http://billmate.se/api-integration).

## Description

This is the Billmate PHP Class file that is intended to used in PHP projects that use the Billmate Payment Gateway.
Billmate handles invoice payments, part payments, Card transactions (Mastercard & Visa) and Direct Payments.
To be able to use Billmate you need an id & secret. You get this by creating an account [here](http://billmate.se/anslut-webbshop/).

## Example

In the folder Example an example implementation can be found. It serves the purpose of being an example implementation of the Billmate.php class file.
It's your own resposibility to make sure your application works according to the Billmate API specification, see [http://billmate.se/api-integration](http://billmate.se/api-integration).


## Changelog

### 2.1.6 (2015-01-29)
* Language is added as an optional paramater in credentials, version_compare is added for Curl setup

### 2.1.5 (2015-01-22)
* Will make a utf8_decode before it returns the result

### 2.1.4 (2015-01-15)
* verify_hash is improved. The serverdata is added instead of useragent

### 2.1.2 (2015-01-12)
* verify_hash function is added.

### 2.1.1 (2014-12-18)
* If response can not be json_decoded, will return actual response

### 2.1.0 (2014-12-15)
* Unnecessary variables are removed

### 2.0.9 (2014-12-04)
* Returns array and verifies the data is safe

### 2.0.8 (2014-11-25)
* Url is updated. Some variables are updated

### 2.0 (2014-06-252)
* Second Version
