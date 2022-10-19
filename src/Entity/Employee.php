<?php

namespace App\Entity;

/**
 * An employee, currently linked only to Contact entity, can be reused later
 * @package App\Entity
 */
class Employee
{
    private string $id;
    private string $name;
    private ?string $surname;
    private string $email;
    private string $photoUrl;
    private ?string $phone;
    private ?string $linkedin;

    public function __construct(
        string $id,
        string $name,
        ?string $username,
        string $email,
        string $photoUrl,
        ?string $phone,
        ?string $linkedIn
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->photoUrl = $photoUrl;
        $this->phone = $phone;
        $this->linkedin = $linkedIn;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }
}
