<?php
class PowerPlant
{
    protected $generator;
    protected $powerSource;
    protected $turbine;
    protected $coolingStation;
    protected $pressureManagement;
    protected $temperatureControls;

    public function startPowerGeneration()
    {
        $fuel = $this->getPowerSource()->getFuel();
        $energy = $fuel->burn();
        $this->getTurbine()->injectEnergy($energy);
        $spinningness = $this->getTurbine()->getSpinningness();

        while ($this->getPressureManagement()->getPressure()
            != PressureManagement::CRITICAL) {
            if ($spinningness > 100) {
                $tempControls = $this->getTemperatureControls();
                $tempControls->lowerTemperature();
                $tempDelta = $tempControls->getTempDelta();

                $pressureManagement = $this->getPressureManagement();
                $pressureManagement->tryToLowerPressure($tempDelta);

                $pressure = $pressureManagement->getPressure();
                $this->getTurbine()->setSpinnyPressure($pressure);
            } else {
                $tempControls = $this->getTemperatureControls();
                $tempControls->raiseTemperature();
                $tempDelta = $tempControls->getTempDelta();

                $pressureManagement = $this->getPressureManagement();
                $pressureManagement->tryToRaisePressure($tempDelta);

                $pressure = $pressureManagement->getPressure();
                $this->getTurbine()->setSpinnyPressure($pressure);
            }
        }

        echo "Your face asplode!\n";

    }

    /**
     * @param mixed $coolingStation
     *
     * @return static
     */
    public function setCoolingStation($coolingStation)
    {
        $this->coolingStation = $coolingStation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoolingStation()
    {
        return $this->coolingStation;
    }

    /**
     * @param mixed $pressureManagement
     *
     * @return static
     */
    public function setPressureManagement(PressureManagement $pressureManagement)
    {
        $this->pressureManagement = $pressureManagement;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPressureManagement()
    {
        return $this->pressureManagement;
    }

    /**
     * @param mixed $temperatureControls
     *
     * @return static
     */
    public function setTemperatureControls(TemperatureControls $temperatureControls)
    {
        $this->temperatureControls = $temperatureControls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemperatureControls()
    {
        return $this->temperatureControls;
    }

    /**
     * @param mixed $turbine
     *
     * @return static
     */
    public function setTurbine(Turbine $turbine)
    {
        $this->turbine = $turbine;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTurbine()
    {
        return $this->turbine;
    }

    /**
     * @param mixed $generator
     *
     * @return static
     */
    public function setGenerator(Generator $generator)
    {
        $this->generator = $generator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenerator()
    {
        return $this->generator;
    }

    /**
     * @param mixed $powerSource
     *
     * @return static
     */
    public function setPowerSource(FuelSource $powerSource)
    {
        $this->powerSource = $powerSource;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPowerSource()
    {
        return $this->powerSource;
    }


}