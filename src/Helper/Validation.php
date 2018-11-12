<?php

namespace Validation;

class Validation
{
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Validation();
        }

        return self::$instance;
    }

    public function isValidName($name)
    {
        if (empty($name)) {
            return false;
        }

        return true;
    }

    public function isValidPrice($price)
    {
        if (empty($price)) {
            return new \Exception("Price not found");
        }

        if (is_numeric($price)) {
            return new \Exception("Price should be numeric");
        }
    }

}