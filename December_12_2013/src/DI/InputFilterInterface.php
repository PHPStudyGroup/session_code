<?php
namespace DI;


interface InputFilterInterface
{
    /**
     * Sets the value to validate
     *
     * @param mixed $value Value to validate
     *
     * @return static
     */
    public function setValue($value);

    /**
     * Returns error messages for whatever went wrong
     *
     * @return array
     */
    public function getMessages();

    /**
     * Determines if the input filter is valid
     *
     * @return boolean
     */
    public function isValid();
}