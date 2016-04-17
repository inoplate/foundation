<?php

// Public routes
// This endpoints can be accessed by anyone

$router->get('ping', ['uses' => 'AwakeKeeperController@ping']);