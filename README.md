# PHPweather (2.2.2a)
This is a PHPWeather project by [Martin Geisler](http://gimpster.com/). 

It was previously developed for PHP 5, but has been updated to work with PHP 7.3. This is because some of the core PHP functions used no longer exist in PHP (it has been 15 years or more since 2.2.2 was written!).

The original library (v2.2.2) is on sourceforge here: https://sourceforge.net/projects/phpweather/

The following is noted:

* The 2.2.2 version on source forge will not work with supported versions of PHP (7.0 or higher).
* This repository is a clone with a set of fixes for the regular expression parsing to use **preg_match** instead of **ereg**.
* Some fixes to the metar decode function have been added as **empty()** (as a PHP function) seems to behave differently in PHP 7.3.
* The code is Martin's but updated to work with later versions of PHP.
* Some sample code is provided on an as-is basis in the **examples** folder.
