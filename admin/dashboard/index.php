<?php
echo "dashboard";
echo "<br>";
var_dump($_SERVER);
var_dump($_SERVER['REQUEST_URI']);
echo str_contains($_SERVER['REQUEST_URI'], 'dashboard');
