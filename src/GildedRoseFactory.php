<?php

namespace App;

/**
 * Class GildedRoseFactory
 * @package App
 *
 * Always good practice to use factories but ideally I'd rather with with a DI container and configure a type of service
 * To be injected into other classes. Main advantage is unit testing / mocking / spies etc
 *
 * @see https://designpatternsphp.readthedocs.io/en/latest/Creational/FactoryMethod/README.html
 */
final class GildedRoseFactory
{
    /**
     * @param ItemBridge[] $items
     * @return GildedRose
     */
    public static function create(array $items): GildedRose
    {
        return new GildedRose($items);
    }
}
