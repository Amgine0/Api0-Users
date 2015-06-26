<?php
/*
 * UserTest.php
 *
 * Copyright 2015 Amgine <amgine@saewyc.ca>
 *
 * This program is free software. It comes without any warranty, to the extent
 * permitted by applicable law. You can redistribute it and/or modify it under
 * the terms of the Do What The Fuck You Want To Public License, Version 2, as
 * published by Sam Hocevar. See http://www.wtfpl.net/ for more details.
 *
 *
 */

class UserTest extends \PHPUnit_Framework_TestCase {

    protected $user;

    /**
     * method: setUp
     **
     * Create the world.
     **/
    public function setUp() {
        $this->user = new Amgine0\Api0\Users\User( 'testKey', 'testSecret' );
    }

    /** @test **/
    public function testClass() {
        $this->assertTrue(
            class_exists( 'Amgine0\Api0\Users\User' ),
            'testClass: 00: Class does not exist.'
        );
        $this->assertTrue(
            property_exists( 'Amgine0\Api0\Users\User', 'key' ),
            'testClass: 01: Class property "key" does not exist.'
        );
        $this->assertTrue(
            property_exists( 'Amgine0\Api0\Users\User', 'secret' ),
            'testClass: 02: Class property "secret" does not exist.'
        );

        $this->assertTrue(
            method_exists( 'Amgine0\Api0\Users\User', 'getKey' ),
            'testClass: 03: Class method "getKey" does not exist.'
        );
        $this->assertTrue(
            method_exists( 'Amgine0\Api0\Users\User', 'getSecret' ),
            'testClass: 04: Class method "getSecret" does not exist.'
        );
    }

    /** @test **/
    public function testInstantiation() {
        $this->assertInstanceOf(
            'Amgine0\Api0\Users\User',
            $this->user,
            'testInstantiation: 00: Object not instance of Amgine0\Users\User.'
        );
    }

    /** @test **/
    public function testGetKey() {
        $this->assertNotEquals(
            'nonexistentKey',
            $this->user->getKey(),
            'testGetKey: 00: False positive - incorrect key returned.'
        );
        $this->assertEquals(
            'testKey',
            $this->user->getKey(),
            'testGetKey: 01: Incorrect key returned.'
        );
    }

    /** @test **/
    public function testGetSecret() {
        $this->assertNotEquals(
            'someSecret',
            $this->user->getSecret(),
            'testGetSecret: 00: False positive - incorrect key returned.'
        );
        $this->assertEquals(
            'testSecret',
            $this->user->getSecret(),
            'testGetSecret: 01: Incorrect key returned.'
        );
    }
}
