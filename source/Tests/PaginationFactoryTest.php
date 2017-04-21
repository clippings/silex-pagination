<?php

namespace Kilte\Silex\Pagination\Tests;

use Kilte\Silex\Pagination\PaginationFactory;

/**
 * @coversDefaultClass Kilte\Silex\Pagination\PaginationFactory
 */
class PaginationFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getPerPage
     * @covers ::getNeighbours
     */
    public function testConstructor()
    {
        $perPage = 5;
        $neighbours = 4;
        $factory = new PaginationFactory($perPage, $neighbours);
        $this->assertEquals($perPage, $factory->getPerPage());
        $this->assertEquals($neighbours, $factory->getNeighbours());
    }

    /**
     * @covers ::getPerPage
     * @covers ::setPerPage
     */
    public function testGetAndSetPerPage()
    {
        $perPage = 5;
        $factory = new PaginationFactory($perPage, 0);
        $this->assertEquals($perPage, $factory->getPerPage());
        $newPerPage = 6;
        $factory->setPerPage($newPerPage);
        $this->assertEquals($newPerPage, $factory->getPerPage());
    }

    /**
     * @covers ::getNeighbours
     * @covers ::setNeighbours
     */
    public function testGetAndSetNeighbours()
    {
        $neighbours = 5;
        $factory = new PaginationFactory(0, $neighbours);
        $this->assertEquals($neighbours, $factory->getNeighbours());
        $newNeighbours = 6;
        $factory->setNeighbours($newNeighbours);
        $this->assertEquals($newNeighbours, $factory->getNeighbours());
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $factory = new PaginationFactory(5, 4);
        $pagination = $factory->create(100, 4);
        $this->assertEquals([
            1 => 'previous',
            2 => 'previous',
            3 => 'previous',
            4 => 'current',
            5 => 'next',
            6 => 'next',
            7 => 'next',
            8 => 'next',
            9 => 'more',
            20 => 'last',
        ], $pagination->build());
    }

    /**
     * @covers ::create
     */
    public function testCreateCanOverrideDefaults()
    {
        $factory = new PaginationFactory(5, 4);

        $pagination = $factory->create(100, 4, 10, 12);
        $this->assertEquals([
            1 => 'previous',
            2 => 'previous',
            3 => 'previous',
            4 => 'current',
            5 => 'next',
            6 => 'next',
            7 => 'next',
            8 => 'next',
            9 => 'next',
            10 => 'next',
        ], $pagination->build());
    }
}
