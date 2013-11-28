<?php
interface FuelThing
{
    /**
     * Burns the fuel and return how much power we got
     *
     * @return integer
     */
    public function burn();
}