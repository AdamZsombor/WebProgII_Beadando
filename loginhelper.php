<?php
include_once('./database.php');
function getLoggedInUser()
    {
    if(!isset($_COOKIE["_session"]))
    {
        return null;
    }

    $sessionId = $_COOKIE["_session"];
    //$loggedIn = [];
    $loggedIn = get_record_list("SELECT username, ID FROM users WHERE session = '$sessionId'");

    if(count($loggedIn) == 0)
    {
        return null;
    }

    return $loggedIn[0];
    }
function login($username, $password)
    {
      $session = generate_session_id();
      update_record("users", [ "username" => $username, "password" => $password ], [ "session" => $session ]);
      setcookie("_session", $session, time() + (30 * 60) /* fél óra */, "/" /* a domain gyökerétől érvényes a süti */);
    }
function generate_session_id()
    {
      $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $result = "";
      for($i = 0; $i < 20; $i ++)
      {
        $result .= $charset[rand(0, strlen($charset))];
      }
    
      return $result;
    }
?>