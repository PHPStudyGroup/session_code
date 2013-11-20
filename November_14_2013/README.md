# Study group for 11/14/2013 #


####Remaining Magic Methods####

* __sleep()
* __wakeup()
* __toString()
* __invoke()
* __set_state()
* __clone()
* __callStatic()

##When will __sleep be called?##

It gets called when an object is being serialized 

http://us2.php.net/__sleep

```
class Sleepy
{
	protected $name = "sleepy";
	protected $db;
	protected $roommates = 6;
	private $axeMaterial = 'wood';
}

$dwarf = new Sleepy();

echo serialize($dwarf), "\n";

```


## Adding file constructor

```
class Sleepy
{
	protected $name = "sleepy";
	protected $db;
	protected $roommates = 6;
	private $axeMaterial = 'wood';
	
	public function __construct()
	{
		$this->file = function()
		{
		return fopen(__DIR__ . '/sleepy_demo.php', 'r');
		}
	}
	
	public function __sleep()
	{
		return array('name', 'roommates', 'axeMaterial');
	}
}

$dwarf = new Sleepy();

echo serialize($dwarf), "\n";

```

__sleep() allows us to Serialize properties inside our object that can be serialized. 

The learn more about the output of the serialized follow the link

[More Information on output of Serialization ](http://stackoverflow.com/questions/14297926/structure-of-a-serialized-php-string)

## __wakeup() ##

When will __wakeup be called?

http://us2.php.net/__wakeup

```
class Sleepy
{
	protected $name = "sleepy";
	protected $db;
	protected $roommates = 6;
	private $axeMaterial = 'wood';
	
	public function __construct()
	{
		$this->file = function()
		{
		return fopen(__DIR__ . '/sleepy_demo.php', 'r');
		}
	}
	
	public function __sleep()
	{
		return array('name', 'roommates', 'axeMaterial');
	}
	
	public function getGreeting()
	{
		return $this->greeting;
	}
	
	public function __wakeup()
	{
		$this->name = 'Grumpy';
		$this->greeting = function()
		{
		echo 'Hello, I am '. $this->name . "\n";
		};
	}
}

$dwarf = new Sleepy();
//$greeting = $dwarf->getGreeting();
//$greeting();

$serialized = serialize($dwarf);
$newDwarf = unserialize($serialized);
$newDwarfGreeting = $newDwarf->getGreeting();
$newDrawfGreeting();


var_dump($dwarf);


```

### real world example ###
***Add into current code Structure***

```
	session_start();
	
	$_SESSION = $dwarf;
	
	if (isset($_SESSION['dwarf']))
	{
		var_dump($_SESSION['dwarf']);
	}
	
	$_SESSION['dwarf'] = $dwarf;
	
```

When saving the session in your tmp directory, the session is saved into your tmp folder with a serialized value. 


## __toString() ##

***The __toString() method allows a class to decide how it will react when it is treated like a string. For example, what echo $obj; will print. This method must return a string, as otherwise a fatal E_RECOVERABLE_ERROR level error is emitted.***


```
class Dwarf
{
	protected $name;
	
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	
	public function getName()
	{
		if(is_null($this->name))
		{
		throw new MissingNameException('you must have a name!');
		}
	}
	
	public function __toString()
	{
		return "Hello, my name is {$this->getName()}";
	}
}

$dwarf = new Dwarf();
$dwarf->setName('Sleepy');

echo $dwarf, "\n";

$words = (string) $dwarf;

echo $words, "\n";

```

## __invoke() ##

####From the PHP Documentation ####

***The __invoke() method is called when a script tries to call an object as a function.***

*Also can be used when calling a method that needs a param passed*

```
<?php

class Greeter
{
    protected $greeting;

    /**
     * @param mixed $greeting
     *
     * @return static
     */
    public function setGreeting($greeting)
    {
        $this->greeting = $greeting;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGreeting()
    {
        return $this->greeting;
    }

    protected function runMe()
    {
        echo $this->getGreeting();
    }

    public function __invoke()
    {
        return $this->runMe();
    }
}

function runThing($function)
{
    $stuff = $function();
}


$greeter = new Greeter();
$greeter->setGreeting('Hello, World!' . "\n");

runThing($greeter);


```

For more detailed information and a complete code example **[__invoke()](https://github.com/PHPStudyGroup/session_code/blob/master/November_14_2013/invokeDemo.php)**


## __set_state() ##

**This static method is called for classes exported by var_export() since PHP 5.1.0.***

***The only parameter of this method is an array containing exported properties in the form array('property' => value, ...).***

```
    public static function __set_state($stuff)
    {
        $dwarf = new static;

        $dwarf->name = $stuff['name'];
        $dwarf->greeting = function () {
            echo 'Done with __set_state';
        };
        $dwarf->roommates = $stuff['roommates'];
        $dwarf->axeMaterial = $stuff['axeMaterial'];
        return $dwarf;
    }
```
For a full example of the code and how to implement the **[__set_state()](https://github.com/PHPStudyGroup/session_code/blob/master/November_14_2013/set_state_demo.php)**


## __clone() ##

**if a __clone() method is defined, then the newly created object's __clone() method will be called, to allow any necessary properties that need to be changed, once the cloning is complete. ** 

```
 public function __clone()
    {
        if (static::$cloneCount < 1) {
            $this->name = 'Jango the Fett';
            $this->myShip = clone $this->myShip;
        } else {
            $this->name = "Clone soldier";
            $this->myShip = null;
        }
        static::$cloneCount++;
    }
```
For a full example of how the ***[__clone](https://github.com/PHPStudyGroup/session_code/blob/master/November_14_2013/clone_demo.php)*** magic method works



## __callStatic ##

** triggered when invoking inaccessible methods in a static context.**

```
   public static function __callStatic($name, $params)
    {
        if ($name == 'whereIsTheBathroom') {
            return 'upstairs';
        }
        return self::getRandomMovie();
    }

```

Check out our awesome example of the **[__callStatic()](https://github.com/PHPStudyGroup/session_code/blob/master/November_14_2013/callStaticDemo.php)**