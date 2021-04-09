<?php

namespace App;

/**
 * Class ItemBridge
 * @package App
 *
 * Decided to opt for the bridge pattern so I could wrap the "untouchable" Item class and create so accessors
 *
 * @see https://designpatternsphp.readthedocs.io/en/latest/Structural/Bridge/README.html
 *
 * @todo Add specific tests
 */
class ItemBridge
{
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getName(): string
    {
        return $this->item->name;
    }

    public function getSellIn(): int
    {
        return $this->item->sellIn;
    }

    public function getQuality(): int
    {
        return $this->item->quality;
    }

    public function setQuality(int $quality): self
    {
        $this->item->quality = $quality;
        return $this;
    }

    public function increaseQuality(): self
    {
        $this->item->quality++;
        return $this;
    }

    /**
     * Potentially a todo. Introduce an arg to dictate an arbitrary number to decrease by possibly? Or is this over engineering
     */
    public function decreaseQuality(): self
    {
        $this->item->quality--;
        return $this;
    }

    public function decreaseSellIn(): self
    {
        $this->item->sellIn--;
        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->item;
    }
}
