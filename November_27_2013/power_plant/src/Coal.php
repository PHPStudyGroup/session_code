<?php
class Coal implements FuelThing
{
    /**
     * Burns the fuel and return how much power we got
     *
     * @return integer
     */
    public function burn()
    {
        return 45;
    }

}