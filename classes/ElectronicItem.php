<?php

use contracts\ElectronicItemInterface;

abstract class ElectronicItem implements ElectronicItemInterface
{
    /**
     * @var float
     */
    public $price;
    public $totalPrice;

    /**
     * @var string
     */
    private $type;
    public $wired;

    /**
     * @var array
     */
    private $extras;

    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    private static $types = array(self::ELECTRONIC_ITEM_CONSOLE,
                                    self::ELECTRONIC_ITEM_MICROWAVE, 
                                    self::ELECTRONIC_ITEM_TELEVISION,
                                    self::ELECTRONIC_ITEM_CONTROLLER);

    public static function getTypes(): array
    {
        return static::$types;
    }
                                    
    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWired(): bool
    {
        return $this->wired;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
        $this->setTotalPrice($this->getPrice());
    }

    public function setTotalPrice(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setWired(bool $wired)
    {
        $this->wired = $wired;
    }

    abstract public function maxExtras(): int;

    public function setExtras(object $extras)
    {
        if($this->maxExtras() === -1) {
            $this->extras[] = $extras;
        } else if($this->maxExtras() === 0){
            throw new Exception('You can only have ' . $this->maxExtras() . ' extras items for ' . $this->getType());
        } else if(
            (!is_array($this->getExtras())) 
            or 
            (count($this->getExtras()) < $this->maxExtras())
        ){
            $this->extras[] = $extras;
        } else {
            throw new Exception('You can only have ' . $this->maxExtras() . ' extras items for ' . $this->getType());
        }

        if(is_array($this->getExtras())){
            $prices = array_column($this->getExtras(), 'price');
            $totalPrice = array_sum($prices);

            $this->setTotalPrice($this->getPrice() + $totalPrice);
        }
    }

    // We have a problem before PHP 8.0 for type-hint. Please, consider here like : array|null
    public function getExtras()
    {
        return $this->extras;
    }
}