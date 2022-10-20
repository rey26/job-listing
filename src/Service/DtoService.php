<?php

namespace App\Service;

use App\Entity\Contact;
use App\Entity\Education;
use App\Entity\Employee;
use App\Entity\Employment;
use App\Entity\Job;
use App\Entity\Personalist;
use App\Entity\Salary;
use App\Entity\WorkField;

class DtoService
{
    private RecruitisService $recruitisService;

    public function __construct(RecruitisService $recruitisService)
    {
        $this->recruitisService = $recruitisService;
    }

    public function getJobList(): array
    {
        $jobList = [];
        $responseData = $this->recruitisService->retrieveJobs();

        foreach ($responseData['payload'] as $jobData) {
            $jobList[] = new Job(
                $jobData['job_id'],
                $jobData['public_id'],
                $jobData['draft'],
                $jobData['active'],
                $jobData['title'],
                $jobData['description'],
                $jobData['closed_duration'],
                $jobData['last_update'],
                $jobData['date_created'],
                $this->getWorkFields($jobData['workfields']),
                $this->getEducation($jobData['education']),
                $this->getSalaries($jobData['salary']),
                $this->getEmployments($jobData['employment']),
                $this->getPersonalist($jobData['personalist']),
                $this->getContact($jobData['contact'])
            );
        }

        return $jobList;
    }

    public function getWorkFields(array $workFieldsData): array
    {
        $workFieldsArray = [];

        foreach ($workFieldsData as $workFieldData) {
            $workFieldsArray[] = new WorkField($workFieldData['id'], $workFieldData['name']);
        }

        return $workFieldsArray;
    }

    /**
     * Education was described as array of object in API documentation
     */
    public function getEducation(array $education): array
    {
        return [new Education($education['id'], $education['name'])];
    }

    public function getSalaries(?array $salary): array
    {
        if ($salary === null) {
            return [];
        }
        return [new Salary(
            $salary['min'],
            $salary['max'],
            $salary['currency'],
            $salary['unit'],
            $salary['visible']
        )];
    }

    /**
     * Employment was described as array of object in API documentation
     */
    public function getEmployments(array $employment): Employment
    {
        return new Employment($employment['id'], $employment['name']);
    }

    public function getPersonalist(array $personalistData): Personalist
    {
        return new Personalist($personalistData['id'], $personalistData['name']);
    }

    public function getContact(array $contact): Contact
    {
        $employee = $contact['employee'];

        return new Contact(
            $contact['name'],
            $contact['email'],
            $contact['phone'],
            new Employee(
                $employee['id'],
                $employee['name'],
                $employee['surname'],
                $employee['email'],
                $employee['photo_url'],
                $employee['phone'],
                $employee['linkedin']
            )
        );
    }
}
