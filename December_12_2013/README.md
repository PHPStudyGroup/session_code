PHP Study Group
===============

December 12, 2013
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
validation. It should return a boolean indicating if the
inputs are valid or not.

-----------------------------------------------

### Notes on this week's code

This week, we are starting with code from the December 5th directory. We ended last
week with some tests and working code for validation of username and password inputs
according to the requirements layed out above. This week focuses on refactoring,
dependency injection and how these tie together with unit testing.