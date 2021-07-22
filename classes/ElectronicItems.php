<?php

class ElectronicItems
{
    private $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested
     * 
     * @return array
     */
    public function getSortedItems(): array
    {
        $items = $this->items;
        $price = array_column($items, 'totalPrice');
        array_multisort($price, SORT_ASC, $items);

        return [
            'items' => $items,
            'total_price' => array_sum(array_column($items, 'price')),
            'total_price_extras' => array_sum(array_column($items, 'totalPrice'))
        ];
    }

    /**
     * @param string $type
     * @return array
     */
    public function getItemsByType($type): array
    {
        if(in_array($type, ElectronicItem::getTypes())){
            $callback = function($item) use ($type) {
                return $item->getType() == $type;
            };

            $items = array_filter($this->items, $callback);
        } else {
            throw new Exception('This item does not exist in the list of allowed items');
        }

        return [
            'items' => $items,
            'total_price' => array_sum(array_column($items, 'price')),
            'total_price_extras' => array_sum(array_column($items, 'totalPrice'))
        ];
    }
}