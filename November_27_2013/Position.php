<?php
class Position
{
    protected $x;
    protected $y;

    /**
     * @param mixed $x
     *
     * @return static
     */
    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $y
     *
     * @return static
     */
    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

} 