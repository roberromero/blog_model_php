<?php

namespace Core;

class ValidationException extends \Exception
{
    protected $errors = [];
    protected $oldFormData = [];

    public static function throw($errors, $oldFormData)
    {
        //Creation of an own instance
        $instance = new static;
        //Creation of two properties
        $instance->errors= $errors;
        $instance->oldFormData= $oldFormData;

        throw $instance;
    }

    public function errors()
    {
        return $this->errors;
    }
    public function oldFormData()
    {
        return $this->oldFormData;
    }
}