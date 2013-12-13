<?php

namespace DI;

class RequiredFilter implements InputFilterInterface
{
    protected $value;
    protected $messages = array();
    protected $isValidated = false;

    /**
     * Sets the value to validate
     *
     * @param mixed $value Value to validate
     *
     * @return static
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->isValidated = false;
        $this->clearMessages();
        return $this;
    }

    /**
     * Returns error messages for whatever went wrong
     *
     * @return array
     */
    public function getMessages()
    {
        if (!$this->isValidated) {
            throw new \RuntimeException('You must call isValid first');
        }
        return $this->messages;
    }

    /**
     * Determines if the input filter is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        $this->clearMessages();
        $this->isValidated = true;
        if (is_null($this->value) || $this->value === '') {
            $this->messages[] = 'Value is required';
            return false;
        }

        return true;
    }

    /**
     * Clears out the messages
     *
     * @return void
     */
    protected function clearMessages()
    {
        $this->messages = array();
    }
}