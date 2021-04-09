<?php

namespace App;

/**
 * Class ItemFactory
 * @package App
 *
 * Always good practice to use factories but ideally I'd rather with with a DI container and configure a type of service
 * To be injected into other classes. Main advantage is unit testing / mocking / spies etc
 *
 * @see https://designpatternsphp.readthedocs.io/en/latest/Creational/FactoryMethod/README.html
 */
final class ItemFactory
{
    public static function create(string $name, int $quality, int $sellIn): ItemBridge
    {
        return new ItemBridge(new Item($name, $quality, $sellIn));
    }
}
