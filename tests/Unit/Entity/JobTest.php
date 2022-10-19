<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Contact;
use App\Entity\Education;
use App\Entity\Employee;
use App\Entity\Employment;
use App\Entity\Job;
use App\Entity\Personalist;
use App\Entity\Salary;
use App\Entity\WorkField;
use PHPUnit\Framework\TestCase;

/**
 * @package Tests\Entity
 */
final class JobTest extends TestCase
{
    public function testJobCreatedWithBasicData(): void
    {
        $job = new Job(
            '1',
            null,
            true,
            false,
            'Test title',
            'Test description',
            12345,
            '2022-10-15 12:00:00',
            '2022-10-01 12:00:00',
            [new WorkField(1, 'Test work'), new WorkField(2, 'Test work 1')],
            [new Education(1, 'Test Education')],
            [new Salary(20.50, 26.50, 'EUR', 'hour', true)],
            [new Employment(1, 'Test employment')],
            new Personalist(1, 'Test Personalist'),
            new Contact('Contact', 'test@test.com', '+4210123', null)
        );

        $this->assertEquals('1', $job->getJobId());
        $this->assertNull($job->getPublicId());
        $this->assertTrue($job->isDraft());
        $this->assertFalse($job->isActive());
        $this->assertEquals('Test title', $job->getTitle());
        $this->assertEquals('Test description', $job->getDescription());
        $this->assertEquals(12345, $job->getClosedDuration());
        $this->assertEquals('2022-10-15 12:00:00', $job->getLastUpdate());
        $this->assertEquals('2022-10-01 12:00:00', $job->getDateCreated());
        $this->assertCount(2, $job->getWorkFields());
        $this->assertCount(1, $job->getEducation());
        $this->assertCount(1, $job->getSalary());
        $this->assertInstanceOf(Personalist::class, $job->getPersonalist());
        $this->assertInstanceOf(Contact::class, $job->getContact());
        $this->assertNull($job->getContact()->getEmployee());
    }

    public function testJobCreatedWithExtendedData(): void
    {
        $employee = new Employee(
            '23',
            'Test name',
            null,
            'test@test.com',
            '/media/photo_1.jpg',
            null,
            null
        );

        $job = new Job(
            '1',
            '2',
            false,
            true,
            'Test title',
            'Test description',
            12345,
            '2022-10-15 12:00:00',
            '2022-10-01 12:00:00',
            [new WorkField(1, 'Test work'), new WorkField(2, 'Test work 1')],
            [new Education(1, 'Test Education')],
            [new Salary(20.50, 26.50, 'EUR', 'hour', true)],
            [new Employment(1, 'Test employment')],
            new Personalist(1, 'Test Personalist'),
            new Contact('Contact', 'test@test.com', '+4210123', $employee)
        );

        $this->assertEquals('1', $job->getJobId());
        $this->assertEquals('2', $job->getPublicId());
        $this->assertFalse($job->isDraft());
        $this->assertTrue($job->isActive());
        $this->assertEquals('Test title', $job->getTitle());
        $this->assertEquals('Test description', $job->getDescription());
        $this->assertEquals(12345, $job->getClosedDuration());
        $this->assertEquals('2022-10-15 12:00:00', $job->getLastUpdate());
        $this->assertEquals('2022-10-01 12:00:00', $job->getDateCreated());
        $this->assertCount(2, $job->getWorkFields());
        $this->assertCount(1, $job->getEducation());
        $this->assertCount(1, $job->getSalary());
        $this->assertInstanceOf(Personalist::class, $job->getPersonalist());
        $this->assertInstanceOf(Contact::class, $job->getContact());
        $this->assertSame($employee, $job->getContact()->getEmployee());
    }
}
