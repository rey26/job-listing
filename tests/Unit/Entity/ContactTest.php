<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Contact;
use App\Entity\Employee;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testContactWithBasicDataCreated(): void
    {
        $contact = new Contact('Test name', 'test@example.com', null, null);

        $this->assertEquals('Test name', $contact->getName());
        $this->assertEquals('test@example.com', $contact->getEmail());
        $this->assertNull($contact->getPhone());
        $this->assertNull($contact->getEmployee());
    }

    public function testContactWithExtendedDataCreated(): void
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
        $contact = new Contact('Test name', 'test@example.com', '+4219234', $employee);

        $this->assertEquals('Test name', $contact->getName());
        $this->assertEquals('test@example.com', $contact->getEmail());
        $this->assertEquals('+4219234', $contact->getPhone());
        $this->assertNotNull($contact->getEmployee());
    }
}
