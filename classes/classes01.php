<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../utils/index.php');

/**
 * You are designing an e-commerce application that handles
 * purchases through your website. You have given a class cart
 * to begin your adventure.
 */
class Cart
{
}

/**
 * Perform tests here, don't change anything here beyond this point.
 */
$items = [
    ['item' => 'Macbook Pro with Gold', 'amount' => 123000.25],
    ['item' => 'iPhone 8s', 'amount' => 49552.25],
    ['item' => 'Fidget Spinner', 'amount' => 59.25],
    ['item' => 'Power Bank 29000MaH', 'amount' => 2341.50],
];

$invoice = new Cart($items);

a($invoice->getItemTotalCount(), 4);
a($invoice->getItemTotalAmount(), 174953.25);

$invoice->removeItemFromCart(0);

a($invoice->getItemTotalCount(), 3);
a($invoice->getItemTotalAmount(), (float) 51953);

$invoice->addItem(['item' => 'Mouse', 'amount' => 500.25]);
$invoice->addItem(['item' => 'Keyboard', 'amount' => 10245.75]);
$invoice->addItem(['item' => 'DELL Alienware X510', 'amount' => 55275.65]);
$invoice->addItem(['item' => 'Yu-Gi-Oh! Deck', 'amount' => 1200]);

a($invoice->getItemTotalCount(), 7);
a($invoice->getItemTotalAmount(), 119174.65);

