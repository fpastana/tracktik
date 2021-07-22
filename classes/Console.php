<?php

class Console extends ElectronicItem
{
    private $maxExtras = 4;
    private $type;

    public function __construct()
    {
        $this->setType('console');
    }

    public function maxExtras(): int
    {
        return $this->maxExtras;
    }
}