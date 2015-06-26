<?php namespace Amgine0\Api0\Users;

/*
 * Users.php
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
 * class: Users
 **
 * User factory and registry
 **/
class Users {
    /**
     * Userkeys filename
     **
     * @var string $keyFile
     **/
    private $keyFile;
    /**
     * Array of $userkey => $secret pairs.
     **
     * @var array $userkeys
     **/
    private $userKeys = array();

    /**
     * method: __construct
     **
     * Constructor retrieves userkey pairs. Default keyFile name is userkeys.ini.
     **/
    public function __construct( $keyFile = 'userkeys.ini' ) {
        $this->keyFile = $keyFile;
        $this->userKeys = parse_ini_file( $keyFile );
    }

    /**
     * method: __destruct
     **
     * Check if userkeys file needs to be updated before ending.
     **/
     public function __destruct() {
         if( $this->userKeys !== parse_ini_file( $this->keyFile ) ){
             // copy comment lines, then dump the array
             $fh = fopen( $this->keyFile, 'r' );
             $fh2 = fopen( $this->keyfile . '.tmp', 'w' );
             while( $buffer = fgets( $fh, 4096 ) ){
                 if ( substr( $buffer, 0, 1 ) != ';' ) {
                     break;
                 }
                 fwrite( $fh2, $buffer );
             }
             foreach( $this->userKeys as $key => $value ) {
                 fwrite( $fh2, "$key = $value\n" );
             }
             fclose( $fh );
             fclose( $fh2 );
             rename( $keyFile, $keyFile . '~' );
             rename( $keyFile . '.tmp', $keyFile );
         }
     }

    /**
     * method: getUser
     **
     * User object factory.
     **
     * @param string $userKey Unique user identifier
     * @return obj Amgine0\Users\User or false
     **/
    public function getUser( $userKey ) {
        if ( array_key_exists( $userKey, $this->userKeys ) ) {
            return new User( $userKey, $this->userKeys[$userKey] );
        }
        return false;
    }

    /**
     * method: getUserKey
     **
     * Retrieve user key(s) which match a secret.
     **
     * @param string $secret User's hashing secret.
     * @return mixed bool FALSE or array of user keys
     **/
    public function getUserKeys( $secret ) {
        $keys = array_keys( $this->userKeys, $secret, true );
        if ( count( $keys ) ) {
            return $keys;
        }
        return false;
    }

    /**
     * method: getUserSecret
     **
     * Retrieve user secret with a user key.
     **
     * @param string $userKey
     * @return mixed bool FALSE or string $secret
     **/
    public function getUserSecret( $userKey ) {
        if( array_key_exists( $userKey, $this->userKeys ) ) {
            return $this->userKeys[$userKey];
        }
        return false;
    }

}
