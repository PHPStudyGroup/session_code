PHP Study Group
===============

December 5, 2013
----------------

* Unit testing 
* Dependency injection

Simple Validation Class for User Registration:

* Username is required
* Must have 2-40 characters
* Allowed characters are a-z, 0-9, -, _
* Automatically lowercase input

* Password is required
* At least 8 characters
* All characters are allowed
* Requires at least 3 of the 4 character types:
	* Uppercase
	* Lowercase
	* Numbers
	* Symbols/Special Characters
	
Validation/Filtering should allow for an array of messages
to be retrieved upon validation regarding what fields had 
errors and what those errors are.

Should have an isValid method which will perform the 
validation.

-----------------------------------------------

### Notes on this week's code

I added a composer.json file that indicates that DI\ namespaced code will be autoloaded. To create the vendor directory and the autoloader, you can run 

```
composer dump-autoload
```

in this directory.

Since we don't have any requirements, we don't need to install anything, but running

```
composer install
```

will also result in the autoloader being created.

In order to install composer, if you don't have it 
already, please visit <http://getcomposer.org/download/> 
and follow the instructions there.

Composer will likely be playing a larger role in our study sessions going forward so it's a good idea to get it installed and ready.