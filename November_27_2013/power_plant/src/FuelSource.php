<?php
interface FuelSource
{
    /**
     * Returns a fuel thing for to be getting the energies all out of
     *
     * @return FuelThing
     */
    public function getFuel();
}