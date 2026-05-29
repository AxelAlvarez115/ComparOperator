<?php
require_once __DIR__ . '/../../utils/session.php';

destroySession();

header('Location: /ComparOperator/index.php');
exit;
