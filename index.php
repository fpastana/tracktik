<?php

include 'contracts/ElectronicItemInterface.php';

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

$wiredController[0] = new Controller();
$wiredController[0]->setPrice(10);
$wiredController[0]->setWired(true);

$wiredController[1] = new Controller();
$wiredController[1]->setPrice(15);
$wiredController[1]->setWired(true);

$remoteController[0] = new Controller();
$remoteController[0]->setPrice(20);
$remoteController[0]->setWired(false);

$remoteController[1] = new Controller();
$remoteController[1]->setPrice(25);
$remoteController[1]->setWired(false);

$remoteController[2] = new Controller();
$remoteController[2]->setPrice(30);
$remoteController[2]->setWired(false);
//$remoteController[2]->setExtras($remoteController[1]);

$items[0] = new Console();
$items[0]->setPrice(399);
$items[0]->setWired(true);
$items[0]->setExtras($remoteController[0]);
$items[0]->setExtras($remoteController[1]);
$items[0]->setExtras($wiredController[0]);
$items[0]->setExtras($wiredController[1]);
//$items[0]->setExtras($remoteController[2]);

$items[1] = new Television();
$items[1]->setPrice(999);
$items[1]->setWired(true);
$items[1]->setExtras($remoteController[0]);
$items[1]->setExtras($remoteController[1]);

$items[2] = new Television();
$items[2]->setPrice(899);
$items[2]->setWired(true);
$items[2]->setExtras($remoteController[0]);

$items[3] = new Microwave();
$items[3]->setPrice(399);
$items[3]->setWired(true);
//$items[3]->setExtras($remoteController[0]);
//$items[3]->setExtras($remoteController[1]);

$electronicItems = new ElectronicItems($items);
$sortedItems = $electronicItems->getSortedItems();

echo '<pre>';
echo "1 console, 2 televisions with different prices and 1 microwave
The console and televisions have extras; those extras are controllers. The console has 2 remote controllers and 2 wired controllers. The TV #1 has 2 remote controllers and the TV #2 has 1 remote controller.
Sort the items by price and output the total pricing:<br>";
print_r($sortedItems);

echo "<br>That person's friend saw her with her new purchase and asked her how much the console and its controllers had cost her. Give the answer:<br>";
$itemsByType = $electronicItems->getItemsByType('aaa');
print_r($itemsByType);