<?php

class Television extends ElectronicItem
{
    private $maxExtras = -1;
    private $type;

    public function __construct()
    {
        $this->setType('television');
    }

    public function maxExtras(): int
    {
        return $this->maxExtras;
    }
}