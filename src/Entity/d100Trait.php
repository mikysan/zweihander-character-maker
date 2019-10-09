<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait d100Trait
{
    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $minRoll;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $maxRoll;

    /**
     * @return int
     */
    public function getMinRoll(): ?int
    {
        return $this->minRoll;
    }

    /**
     * @return int
     */
    public function getMaxRoll(): ?int
    {
        return $this->maxRoll;
    }
}
