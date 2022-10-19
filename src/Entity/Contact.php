<?php

namespace App\Entity;

/**
 * A contact person for the listed job
 * @package App\Entity
 */
class Contact
{
    private string $name;
    private string $email;
    private string $phone;
    private ?Employee $employee;

    public function __construct(
        string $name,
        string $email,
        string $phone,
        ?Employee $employee
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->employee = $employee;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }
}
