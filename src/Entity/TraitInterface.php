<?php


namespace App\Entity;


interface TraitInterface
{
    public function getName(): ?string;

    public function getEffect(): ?string;
}