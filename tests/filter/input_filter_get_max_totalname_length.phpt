--TEST--
suhosin input filter (suhosin.get.max_totalname_length)
--INI--
suhosin.log.syslog=0
suhosin.log.sapi=0
suhosin.log.stdout=255
suhosin.log.script=0
suhosin.request.max_totalname_length=0
suhosin.get.max_totalname_length=7
--SKIPIF--
<?php include('skipif.inc'); ?>
--COOKIE--
--GET--
var=0&var1=1&var2[]=2&var3[xxx]=3&var04=4&var05[]=5&var06[xxx]=6&
--POST--
--FILE--
<?php
var_dump($_GET);
?>
--EXPECTF--
array(5) {
  ["var"]=>
  string(1) "0"
  ["var1"]=>
  string(1) "1"
  ["var2"]=>
  array(1) {
    [0]=>
    string(1) "2"
  }
  ["var04"]=>
  string(1) "4"
  ["var05"]=>
  array(1) {
    [0]=>
    string(1) "5"
  }
}
ALERT - configured GET variable total name length limit exceeded - dropped variable 'var3[xxx]' (attacker 'REMOTE_ADDR not set', file '%s')
ALERT - configured GET variable total name length limit exceeded - dropped variable 'var06[xxx]' (attacker 'REMOTE_ADDR not set', file '%s')
ALERT - dropped 2 request variables - (2 in GET, 0 in POST, 0 in COOKIE) (attacker 'REMOTE_ADDR not set', file '%s')

