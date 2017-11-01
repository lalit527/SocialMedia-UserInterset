<?php

  include("test_ip.php"); // Must include this

  // ip must be of the form "192.168.1.100"
  // you may load this from a database
  $ip = "202.142.75.27";
  echo "Your IP Address is: " . $ip . "<br />";

  echo "Your Country is: ";
  // returns country code by default
  echo getCountryFromIP($ip);
  echo "<br />\n";

  // optionally, you can specify the return type
  // type can be "code" (default), "abbr", "name"

  echo "Your Country Code is: ";
  echo getCountryFromIP($ip, "code");
  echo "<br />\n";

  // print country abbreviation - case insensitive
  echo "Your Country Abbreviation is: ";
  echo getCountryFromIP($ip, "AbBr");
  echo "<br />\n";
  echo getCityFromIP($ip, "");
  // full name of country - spaces are trimmed
  echo "Your Country Name is: ";
  echo getCountryFromIP($ip, " NamE ");
  echo "<br />\n";

?>