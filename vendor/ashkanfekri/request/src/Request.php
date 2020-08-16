<?php

namespace Ashkanfekri\dodo;

class Request
{
  /**
   * @return string
   */
  public static function url()
  {
    return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  }

  /**
   * @return mixed
   */
  public static function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }
}
