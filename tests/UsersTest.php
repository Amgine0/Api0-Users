<?php namespace Amgine0\Api0\Users;

/*
 * UsersTest.php
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

class UsersTest extends \PHPUnit_Framework_TestCase {

    protected $users;

    public function setUp() {
        $this->users = new Users( 'tests/data/userkeys.ini' );
    }

    public function testClass() {
        $this->assertTrue(
            class_exists( 'Amgine0\Api0\Users\Users' ),
            'testClass: 00: Class does not exist.'
        );
        $this->assertTrue(
            property_exists( 'Amgine0\Api0\Users\Users', 'userKeys' ),
            'testClass: 01: Class property "userKeys" does not exist.'
        );
        $this->assertTrue(
            property_exists( 'Amgine0\Api0\Users\Users', 'keyFile' ),
            'testClass: 02: Class property "keyFile" does not exist.'
        );

    }

    /** @test **/
    public function testInstantiation() {
        $this->assertTrue(
            is_a( $this->users, 'Amgine0\Api0\Users\Users' ),
            'testInstantiation: 00: Class name invalid.'
        );
    }

    /** @test **/
    public function testGetUserObject() {
        $this->assertFalse(
            $this->users->getUser( 'nonexistentUserKey' ),
            'testGetUserObject: 00: False positive - nonexistent user key does not return false.'
        );
        $this->assertInstanceOf(
            'Amgine0\Api0\Users\User',
            $this->users->getUser( 'testKey' ),
            'testGetUserObject: 00: User class object not returned.'
        );
    }

    /** @test **/
    public function testGetUserKeys() {
        $this->assertFalse(
            $this->users->getUserKeys( 'Spaniards' ),
            'testGetUserKeys: 00: False positive - non-existent user secret does not return false.'
        );
        $results = $this->users->getUserKeys( 'Secrets' );
        $this->assertEquals(
            1,
            count( $results ),
            'testGetUserKeys: 01: Returns incorrect number of matching keys.'
        );
        $this->assertEquals(
            'moreTest',
            $results[0],
            'testGetUserKeys: 02: Returns incorrect user key in array.'
        );
    }

    /** @test **/
    public function testGetUserSecret() {
        $this->assertFalse(
            $this->users->getUserSecret( 'nonExistentUserKey' ),
            'testGetUserSecret: 00: False positive - non-existent user key does not return false.'
        );
        $this->assertEquals(
            'test Secret string',
            $this->users->getUserSecret( 'testKey' ),
            'testGetUserSecret: 01: Returns incorrect secret.'
        );
    }
}
