<?php
echo (shell_exec('whoami 2>&1'));
echo '<br>';
system("touch exec_is_enabled");
die("Check for file 'exec_is_enabled' in the current directory.");
