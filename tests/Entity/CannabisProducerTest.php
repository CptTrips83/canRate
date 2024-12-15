<?php

namespace App\Tests\Entity;

use App\Entity\CannabisProducer;
use App\Tools\Tests\AbstractKernelTestCase;
use PHPUnit\Framework\TestCase;

class CannabisProducerTest extends AbstractKernelTestCase
{
    public function testProducerCreation()
    {
        $assertProducer = new CannabisProducer();
        $assertProducer->setName('Test');

        $this->entityManager->persist($assertProducer);
        $this->entityManager->flush();

        $producer = $this->entityManager->getRepository(CannabisProducer::class)->findOneBy(['name' => 'Test']);
        $this->assertEquals('Test', $producer->getName());
    }
}
