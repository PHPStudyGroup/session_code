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

