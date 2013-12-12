<?php

namespace DI;

class RegistrationFilter
{
    protected $values;
    protected $messages = array();

    /**
     * Checks if the values are valid. Returns true if they
     * are, false otherwise.
     *
     * @return boolean
     */
    public function isValid()
    {
        // validation username
        $result = $this->validateUsername();

        // validation for password
        $result = $result && $this->validatePassword();

        return $result;
    }

    /**
     * Validates the username. Returns true if it is
     * valid, false otherwise.
     *
     * @return boolean
     */
    public function validateUsername()
    {
        // Username is required
        if (!isset($this->values['username'])) {
            $this->addMessage(
                'username',
                'Username is required'
            );

            return false;
        }

        $valid = true;
        if (strlen($this->values['username']) < 2) {
            $valid = false;
            $this->addMessage(
                'username',
                'Username must be at least 2 characters'
            );
        }

        if (strlen($this->values['username']) > 40) {
            $valid = false;
            $this->addMessage(
                'username',
                'Username must be less than 40 characters'
            );
        }

        if (preg_match('/[^a-z\d_-]/i', $this->values['username'])) {
            $valid = false;
            $this->addMessage(
                'username',
                'Username contains invalid characters'
            );
        }
        $this->values['username'] = strtolower($this->values['username']);

        return $valid;
    }

    public function validatePassword()
    {
        if (!isset($this->values['password'])) {
            $this->addMessage('password', 'Password is required');
            return false;
        }

        $valid = true;
        if (strlen($this->getValue('password')) < 8) {
            $this->addMessage(
                'password',
                'Password must be at least 8 characters'
            );
            $valid = false;
        }

        if (preg_match('/
        ((?P<upper>[A-Z])| # upper case
        (?P<lower>[a-z])|  # lower case
        (?P<digits>[\d])|  # digits
        (?P<symbols>[^A-Za-z0-9]) # symbols
        )+/x',
            $this->getValue('password'),
            $matches)
        ) {
            $counter = 0;
            $groupKeys = array(
                'upper', 'lower', 'digits', 'symbols'
            );
            foreach ($groupKeys as $key) {
                if (isset($matches[$key]) && $matches[$key] !== '') {
                    $counter++;
                }
            }

            if ($counter < 3) {
                $valid = false;
                $this->addMessage(
                    'password',
                    'Password complexity is too low'
                );
            }
        }
        return $valid;
    }

    /**
     * @param mixed $values
     *
     * @return static
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Adds an error message to our array of messages
     *
     * @param string $field   The field this message is about
     * @param string $message What is wrong with the field
     *
     * @return static
     */
    public function addMessage($field, $message)
    {
        $this->messages[$field][] = $message;

        return $this;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function getValue($field)
    {
        return $this->values[$field];
    }
} 