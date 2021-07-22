<?php

class Controller extends ElectronicItem
{
    private $maxExtras = 0;
    private $type;

    public function __construct()
    {
        $this->setType('controller');
    }

    public function maxExtras(): int
    {
        return $this->maxExtras;
    }
}