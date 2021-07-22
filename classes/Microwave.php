<?php

class Microwave extends ElectronicItem
{
    private $maxExtras = 0;
    private $type;

    public function __construct()
    {
        $this->setType('microwave');
    }

    public function maxExtras(): int
    {
        return $this->maxExtras;
    }
}