<?php

use App\Models\Session;

define('SERVER_ERROR', 'Server Error! Please try again.');
define('ENTRY_CREATED', 'The record was created successfully.');
define('ENTRY_UPDATED', 'The record was updated successfully.');
define('PAGINATION', 50);
define('GENDER', ['Male', 'Female']);


if (!function_exists('currentSession')) {
  function currentSession()
  {
    $session = Session::select('session')->latest()->first();

    return $session->session ?? null;
  }
}


if (!function_exists('currentSessionID')) {
  function currentSessionID()
  {
    $session = Session::select('id')->latest()->first();

    return $session->id ?? null;
  }
}


if (!function_exists('allSessions')) {
  function allSessions()
  {
    return Session::select('id', 'session')->distinct('session')->get();
  }
}


if (!function_exists('sessionFromId')) {
  function sessionFromId($sessionID)
  {
    $session = Session::select('session')->where('id', $sessionID)->first();
    
    return $session->session ?? null;
  }
}