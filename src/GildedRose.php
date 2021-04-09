<?php

namespace App;

/**
 * Class GildedRose
 * @package App
 *
 * Attempted to refactor this to use the chain of responsibility pattern. Whereby this classes holds an array of handlers
 * and each are executed if deemed they are qualified to do so. Ideally each handler are their own class that contain all
 * the necessary domain logic / algorithms etc.
 *
 * Furthermore, perhaps each handler could could make use of strategies that wrap up the various steps required to compute
 * the sellIn and quantity? This could be a further iteration.
 *
 * @see https://designpatternsphp.readthedocs.io/en/latest/Behavioral/ChainOfResponsibilities/README.html
 */
class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    /**
     * @todo Bit of a waste of computation time having to execute each of these? i.e. if Aged Brie has been executed no
     * need to execute each of the proceeding handlers. Further refactor required
     */
    public function nextDay()
    {
        foreach ($this->items as $item) {
            $this->handleAgedBrie($item);
            $this->handleBackStagePass($item);
            $this->handleSulfurasHandOfRagnaros($item);
            $this->handleConjuredManaCake($item);
            $this->handleNormal($item);
        }
    }

    private function handleAgedBrie(ItemBridge $item)
    {
        /** @todo remove hard coded strings and use constants */
        if ($item->getName() !== 'Aged Brie') {
            return;
        }

        if ($item->getQuality() < 50) {
            $item->increaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0 && $item->getQuality() < 50) {
            $item->increaseQuality();
        }
    }

    /**
     * Possibly not required but would rather illustrate this in code as a form of documentation
     */
    private function handleSulfurasHandOfRagnaros(ItemBridge $item)
    {
        if ($item->getName() !== 'Sulfuras, Hand of Ragnaros') {
            return;
        }
    }

    /**
     * I generally go by Uncle Bob's rule of lines and max of 3 args. Could do with a clean up and possibly remove any
     * kind of nesting
     */
    private function handleBackStagePass(ItemBridge $item)
    {
        if ($item->getName() !== 'Backstage passes to a TAFKAL80ETC concert') {
            return;
        }

        if ($item->getQuality() < 50) {
            $item->increaseQuality();

            if ($item->getSellIn() < 11 && $item->getQuality() < 50) {
                $item->increaseQuality();
            }

            if ($item->getSellIn() < 6 && $item->getQuality() < 50) {
                $item->increaseQuality();
            }
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->setQuality($item->getQuality() - $item->getQuality());
        }
    }

    private function handleConjuredManaCake(ItemBridge $item)
    {
        if ($item->getName() !== 'Conjured Mana Cake') {
            return;
        }

        if ($item->getQuality() > 0) {
            $item->setQuality($item->getQuality() - 2);
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0 && $item->getQuality() > 0) {
            $item->setQuality($item->getQuality() - 2);
        }
    }

    private function handleNormal(ItemBridge $item)
    {
        if ($item->getName() !== 'normal') {
            return;
        }

        if ($item->getQuality() > 0) {
            $item->decreaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0 && $item->getQuality() > 0) {
            $item->decreaseQuality();
        }
    }
}
