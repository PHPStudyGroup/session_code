<?php

class Dwarf
{
    protected $name;

    /**
     * @param mixed $name
     *
     * @return static
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        if (is_null($this->name)) {
            throw new MissingNameException('You must have a name!');
        }
        return $this->name;
    }

    public function __toString()
    {
        try {
            $name = $this->getName();
        } catch (MissingNameException $e) {
            $name = 'None of your business';
        }

        return "Hello, my name is {$name}";
    }
}

class MissingNameException extends Exception
{}

$dwarf = new Dwarf();
//$dwarf->setName('Sleepy');

$words = (string) $dwarf;

echo $words, "\n";