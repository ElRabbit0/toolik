<?php
session_start();
require('../node/vars.php');

$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);
echo "hi";
$mysql->close();
// friend, bestfriend, partner, subscriber, following
?>