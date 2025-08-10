<?php
declare(strict_types=1);

namespace app\tests;

require_once "../vendor/autoload.php";

use app\models\Task;
use app\models\Action;

$task = new Task('ready', 2, 3);
assert($task->getActionsByStatus('new') === [Action::ACTION_CANCEL->value, Action::ACTION_APPROVE_WORKER->value], "Ожидает массив ['cancel', 'approve_worker']");
assert($task->getActionsByStatus('cancel') === [], "Ожидает пустой []");
assert($task->getActionsByStatus('active') === [Action::ACTION_ACCEPT->value, Action::ACTION_REJECT->value], "Ожидает массив ['accept', 'reject']");
assert($task->getActionsByStatus('ready') === [], "Ожидает пустой []");
assert($task->getActionsByStatus('failed') === [], "Ожидает пустой []");
// ожидается 'cancel'
assert($task->getActionsByStatus('') === []);
var_dump($task->getActionMap());