<?php
declare(strict_types=1);

namespace app\tests;

require_once "../vendor/autoload.php";

use app\entities\ActionAccept;
use app\entities\ActionCancel;
use app\entities\ActionReject;
use app\entities\Task;
use app\enum\task\Action;


$task = new Task('ready', 2, 3);

var_dump($task->getAvailableAction('new', 3));
assert($task->getAvailableAction('new', 2) == new ActionCancel());
assert($task->getAvailableAction('cancel', 5) === null);
assert($task->getAvailableAction('active', 2) == new ActionAccept());
assert($task->getAvailableAction('ready', 3) === null);
assert($task->getAvailableAction('failed', 2) === null);
assert($task->getAvailableAction('reject', 3) === null);
assert($task->getAvailableAction('', 2) === null);
assert($task->getAvailableAction('new', 0) === null);
assert($task->getAvailableAction('active', 3) == new ActionReject());
//var_dump($task->getActionMap());