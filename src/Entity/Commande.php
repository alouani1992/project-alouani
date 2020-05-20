<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *
    * @ORM\Column(type="date")
    */
        private $date;
    /**
     *
     * @ORM\Column(type="integer")
     */
    private $numberProduct;

    /**
     *
     * @ORM\Column(type="text")
     */
    private $description;
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getNumberProduct()
    {
        return $this->numberProduct;
    }

    /**
     * @param mixed $numberProduct
     */
    public function setNumberProduct($numberProduct): void
    {
        $this->numberProduct = $numberProduct;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }


}
