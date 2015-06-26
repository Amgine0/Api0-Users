<?php namespace Amgine0\Api0\Users;

/*
 * User.php
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

/**
 * class: User
 **
 * Value object for a user.
 **/
class User {
    /**
     * Unique user identifier
     **
     * @var string $key
     **/
    private $key;
    /**
     * User's hashing secret
     **
     * @var string $secret
     **/
    private $secret;

    /**
     * method: __construct
     **
     * Constructor, sets initial property values.
     **
     * @param string $key Unique user identifier
     * @param string $secret User's hashing secret
     * @return void
     **/
    public function __construct( $key, $secret ){
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * method: getKey
     **
     * Retrieves key if set, false if not.
     **/
    public function getKey() {
        if ( isset( $this->key ) ) {
            return $this->key;
        }
        return false;
    }

    /**
     * method: getSecret
     **
     * Returns secret if set, false if not.
     **/
    public function getSecret() {
        if ( isset( $this->secret ) ) {
            return $this->secret;
        }
        return false;
    }
}
