<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 */
class People
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     * min=2,
     * max=50,
     * minMessage = "Votre nom doit faire au moins {{ limit }} characters",)
     * maxMessage = "Votre nom doit faire au plus {{ limit }} characters",)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Choice({-1, 0, 1})
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     * min=2,
     * max=50,
     * minMessage = "Votre prénom doit faire au moins {{ limit }} characters",)
     * maxMessage = "Votre prénom doit faire au plus {{ limit }} characters",)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex(
     *  pattern = "/(\(?\+[0-9]{1,3}\)? ?-?(([0-9]? ?-?){9}))|(0? ?-?(([0-9]? ?-?){9}))/",
     *  message="Un vrai tel stp"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type={"bool"})
     */
    private $news;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCivilite(): ?int
    {
        return $this->civilite;
    }

    public function setCivilite(?int $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNews(): ?bool
    {
        return $this->news;
    }

    public function setNews(bool $news): self
    {
        $this->news = $news;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
    
}
