<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return array(
    'facebook' => array(
    	'appId' => '507070709304877',
    	'secret' => '87e9c15e71ae5d5826d40bd1585702e6'
    ),
	'db' => array(
    	'username' => 'root',
    	'password' => 'password'
    )
);
