<?php
class BobaFett
{
    protected $name = 'Boba the Fett';
    protected $myShip;
    public static $cloneCount = 0;

    public function getMyClone()
    {
        return clone $this;
    }

    public function __toString()
    {
        $ship = $this->getMyShip();
        if ($ship) {
            $serial = $ship->getSerialNumber();
            return "I'm " . $this->name .
            ', I ride in my Vette!' . " Serial number " . $serial . "\n";
        }

        return 'Generic cloned soldier.' . "\n";
    }

    /**
     * @param mixed $myShip
     *
     * @return static
     */
    public function setMyShip($myShip)
    {
        $this->myShip = $myShip;
        return $this;
    }

    /**
     * @return SlaveOne
     */
    public function getMyShip()
    {
        return $this->myShip;
    }

    protected function __clone()
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
}

class SlaveOne
{
    protected $serialNumber;

    public function __construct()
    {
        $this->serialNumber = uniqid('Slave1-', true);
    }

    /**
     * @return mixed
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    public function __clone()
    {
        $this->serialNumber = uniqid('Mini-');
    }

}

$boba = new BobaFett();
$boba->setMyShip(new SlaveOne());

$jango = $boba->getMyClone();
echo $boba;
echo $jango;

$soldiers = array();
for ($i = 0; $i < 5; $i ++ ) {
    $soldiers[] = $boba->getMyClone();
}

foreach ($soldiers as $soldier) {
    echo $soldier;
}


