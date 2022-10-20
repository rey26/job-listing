<?php

namespace App\Entity;

/**
 * This is the main entity for job containing many properties.
 * Some of the properties has been omitted for the sake of this task and are listed in TODO part of README
 * @package App\Entity
 */
class Job
{
    private string $jobId;
    private ?string $publicId;
    private bool $draft;
    private bool $active;
    private string $title;
    private string $description;
    private ?int $closedDuration;
    private string $lastUpdate;
    private string $dateCreated;
    private array $workFields;
    private array $education;
    private array $salary;
    private Employment $employment;
    private Personalist $personalist;
    private Contact $contact;

    public function __construct(
        string $jobId,
        ?string $publicId,
        bool $draft,
        bool $active,
        string $title,
        string $description,
        ?int $closedDuration,
        string $lastUpdate,
        string $dateCreated,
        array $workFields,
        array $education,
        array $salary,
        Employment $employment,
        Personalist $personalist,
        Contact $contact
    ) {
        $this->jobId = $jobId;
        $this->publicId = $publicId;
        $this->draft = $draft;
        $this->active = $active;
        $this->title = $title;
        $this->description = $description;
        $this->closedDuration = $closedDuration;
        $this->lastUpdate = $lastUpdate;
        $this->dateCreated = $dateCreated;
        $this->workFields = $workFields;
        $this->education = $education;
        $this->salary = $salary;
        $this->employment = $employment;
        $this->personalist = $personalist;
        $this->contact = $contact;
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }

    public function getPublicId(): ?string
    {
        return $this->publicId;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getClosedDuration(): ?int
    {
        return $this->closedDuration;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    public function getWorkFields(): array
    {
        return $this->workFields;
    }

    public function getEducation(): array
    {
        return $this->education;
    }

    public function getSalary(): array
    {
        return $this->salary;
    }

    public function getEmployment(): Employment
    {
        return $this->employment;
    }

    public function getPersonalist(): Personalist
    {
        return $this->personalist;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }
}
