<?php
declare(strict_types=1);

require_once '../models/Task.php';
require_once '../models/Status.php';
require_once '../models/Action.php';

$task = new Task('new',2, 1);
assert($task->getNextStatus('cancel') === Status::STATUS_CANCEL->value, 'cancel');
assert($task->getNextStatus('response') === null, null);
assert($task->getNextStatus('approve_worker') === Status::STATUS_ACTIVE->value, 'active');
assert($task->getNextStatus('accept') === Status::STATUS_READY->value, 'ready');
assert($task->getNextStatus('reject') === Status::STATUS_FAILED->value, 'failed');
// ожидается 'cancel'
assert($task->getNextStatus('1') !== Status::STATUS_CANCEL, 'cancel');
assert($task->getNextStatus((string)null) !== Status::STATUS_ACTIVE, 'active');

assert($task->getActionsByStatus('new') === [Action::ACTION_CANCEL->value, Action::ACTION_APPROVE_WORKER->value], "Ожидает массив ['cancel', 'approve_worker']");
assert($task->getActionsByStatus('cancel') === [], "Ожидает пустой []");
assert($task->getActionsByStatus('active') === [Action::ACTION_ACCEPT->value, Action::ACTION_REJECT->value], "Ожидает массив ['accept', 'reject']");
assert($task->getActionsByStatus('ready') === [], "Ожидает пустой []");
assert($task->getActionsByStatus('failed') === [], "Ожидает пустой []");
// ожидается 'cancel'
assert($task->getActionsByStatus('') === []);
var_dump($task->getActionMap());
var_dump($task->getStatusMap());