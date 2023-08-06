<?php

use App\Models\Session;

define('SERVER_ERROR', 'Server Error! Please try again.');
define('ENTRY_CREATED', 'The record was created successfully.');
define('ENTRY_UPDATED', 'The record was updated successfully.');
define('PAGINATION', 50);


if (!function_exists('currentSession')) {
  function currentSession()
  {
    $session = Session::select('session')->latest()->first();

    return $session->session ?? null;
  }
}