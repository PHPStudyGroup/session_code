<?php
require_once 'Position.php';
require_once 'Shooter.php';

class Tank
{
    /** @var Shooter */
    protected $gun;

    protected $position;
    protected $ammo;
    protected $tankDirection;
    protected $aimDirection;
    protected $aimInclination;
    protected $intact;
    protected $speed;

    public function __construct()
    {
        $this->position = new Position(0, 0);
        $this->ammo = 100;
        $this->aimDirection = 0;
        $this->aimInclination = 0;
        $this->intact = true;
    }

    /**
     * @param mixed $aimDirection
     *
     * @return static
     */
    public function setAimDirection($aimDirection)
    {
        $this->aimDirection = $aimDirection;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAimDirection()
    {
        return $this->aimDirection;
    }

    /**
     * @param mixed $aimInclination
     *
     * @return static
     */
    public function setAimInclination($aimInclination)
    {
        $this->aimInclination = $aimInclination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAimInclination()
    {
        return $this->aimInclination;
    }

    /**
     * @param mixed $ammo
     *
     * @return static
     */
    public function setAmmo($ammo)
    {
        $this->ammo = $ammo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmmo()
    {
        return $this->ammo;
    }

    /**
     * @param mixed $intact
     *
     * @return static
     */
    public function setIntact($intact)
    {
        $this->intact = $intact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntact()
    {
        return $this->intact;
    }

    /**
     * @param mixed $position
     *
     * @return static
     */
    public function setPosition(Position $position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $tankDirection
     *
     * @return static
     */
    public function setTankDirection($tankDirection)
    {
        $this->tankDirection = $tankDirection;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTankDirection()
    {
        return $this->tankDirection;
    }

    /**
     * @param mixed $speed
     *
     * @return static
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    public function rotate($degrees)
    {
        $this->tankDirection+= $degrees;
        $this->tankDirection %= 360;

        return $this;
    }

    public function shoot()
    {
        if (!$this->intact) {
            return;
        }

        $bullets = $this->getGun()->shoot();

        $this->ammo -= $bullets;
    }

    public function selfDestruct()
    {
        echo "Self destruct in ...\n";
        for($i = 3; $i > 0; $i--) {
            echo "$i ...\n";
            sleep(1);
        }
        echo "KABLOOIE!\n";

        $this->intact = false;
    }

    /**
     * @param \Shooter $gun
     *
     * @return static
     */
    public function setGun($gun)
    {
        $this->gun = $gun;
        return $this;
    }

    /**
     * @return \Shooter
     */
    public function getGun()
    {
        return $this->gun;
    }

    // move
    // shoot
    // aim
    // self destruct
} 