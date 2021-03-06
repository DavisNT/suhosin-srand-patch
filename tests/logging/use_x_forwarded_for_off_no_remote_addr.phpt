--TEST--
Testing: suhosin.log.use-x-forwarded-for=Off (without REMOTE_ADDR set)
--SKIPIF--
<?php include "../skipifnotcli.inc"; ?>
--INI--
suhosin.log.sapi=0
suhosin.log.stdout=255
suhosin.log.script=0
suhosin.log.syslog=0
suhosin.executor.func.blacklist=max
suhosin.log.use-x-forwarded-for=Off
--FILE--
<?php
	max(1,2);
?>
--EXPECTF--
Warning: max() has been disabled for security reasons in %s on line 2
ALERT - function within blacklist called: max() (attacker 'REMOTE_ADDR not set', file '%s', line 2)