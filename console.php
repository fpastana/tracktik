<?php

include 'contracts/ElectronicItemInterface.php';

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});

parse_str(implode('&', array_slice($argv, 1)), $_GET);

function Question($question)
{
    echo $question. ': ';
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);

    return $line;
}

function initClass($answer)
{
    if($answer != ''){
        $answer = ucfirst(trim($answer));
        $items = new $answer;
    }

    return $items;
}

function setExtras($object)
{
    $answer = Question('Do you want to add Extra Items to ' . end($object)->getType().'?');
    if(trim($answer) === 'yes'){
        $answer = Question('Type the index of the item you would like to attach');
        end($object)->setExtras($object[trim($answer)]);

        setExtras($object);
    }

    return $object;
}

function afterQuestions($object = null)
{
    $answer = Question('Type the name of the product you would like to initiate');
    $object[] = initClass($answer);
    $answer = Question('Type the value of the product');
    end($object)->setPrice(trim($answer));
    $answer = Question('Type 1 for wired and 0 for remote');
    end($object)->setWired(trim($answer));

    setExtras($object);

    $answer = Question('Do you want to register more products?');
    if(trim($answer) === 'yes'){
        $object = afterQuestions($object);
    }

    return $object;
}

$items = afterQuestions();

$electronicItems = new ElectronicItems($items);
$sortedItems = $electronicItems->getSortedItems();

print_r($sortedItems);
