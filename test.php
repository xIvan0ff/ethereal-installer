<?php
$output = null;
$retval = null;
exec("whoami", $ouput, $result_code);
die($output);
