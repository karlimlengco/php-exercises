<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');

/**
 * You are designing an e-commerce application that handles
 * purchases through your website. You have given a class cart
 * to begin your adventure.
 */
class Cart
{
    protected $items = [];

    /**
     * New instance of invoice
     *
     * @param array $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Add item to your cart
     * @param array $item
     */
    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * Removes the item from the cart according to the index
     *
     * @return void
     */
    public function removeItemFromCart($index)
    {
        unset($this->items[$index]);
    }

    /**
     * Returns the total amount of items in the invoice
     *
     * @return float
     */
    public function getItemTotalAmount()
    {
        return array_reduce($this->items, function($carry, $item) {
            return $carry + $item['amount'];
        }, 0);
    }

    /**
     * Return the total item count
     *
     * @return integer
     */
    public function getItemTotalCount()
    {
        return count($this->items);
    }
}

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

