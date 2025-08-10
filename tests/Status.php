<?php
declare(strict_types=1);

namespace TaskForce\Tests;

require_once "../vendor/autoload.php";

use app\models\Task;
use app\models\Status;

$task = new Task('new',2, 1);
assert($task->getNextStatus('cancel') === Status::STATUS_CANCEL->value, 'cancel');
assert($task->getNextStatus('response') === null, null);
assert($task->getNextStatus('approve_worker') === Status::STATUS_ACTIVE->value, 'active');
assert($task->getNextStatus('accept') === Status::STATUS_READY->value, 'ready');
assert($task->getNextStatus('reject') === Status::STATUS_FAILED->value, 'failed');
// ожидается 'cancel'
assert($task->getNextStatus('1') !== Status::STATUS_CANCEL, 'cancel');
assert($task->getNextStatus((string)null) !== Status::STATUS_ACTIVE, 'active');

var_dump($task->getStatusMap());