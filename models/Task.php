<?php
declare(strict_types=1);

require_once 'Status.php';
require_once 'Action.php';
final class Task
{
    public int $ownerId;
    public ?int $workerId;
    public string $status;

    public function __construct(string $status, int $idOwner, ?int $idWorker)
    {
        $this->status = $status;
        $this->ownerId = $idOwner;
        $this->workerId = $idWorker;
    }

    /**
     * Метод для возврата статуса, в который перейдет задача для указанного действия
     *
     * @param string $action действие над задачей
     * @return ?string возвращает статус задачи
     */
    public function getNextStatus(string $action): ?string
    {
        $action = Action::tryFrom($action);
        return match ($action) {
            Action::ACTION_CANCEL => Status::STATUS_CANCEL->value,
            Action::ACTION_APPROVE_WORKER => Status::STATUS_ACTIVE->value,
            Action::ACTION_ACCEPT => Status::STATUS_READY->value,
            Action::ACTION_REJECT => Status::STATUS_FAILED->value,
            default => null,
        };
    }

    /**
     * Метод для получения доступных действий для указанного статуса, без учета роли пользователя(заказчик или исполнитель)
     *
     * @param string $status статус задачи
     * @return string[] возвращает возможные действия в виде массива строк // например ['cancel', 'approve_worker']
     */
    public function getActionsByStatus(string $status): array
    {
        $status = Status::tryFrom($status);
        return match ($status) {
            Status::STATUS_NEW => [Action::ACTION_CANCEL->value, Action::ACTION_APPROVE_WORKER->value], //(cancel - для исполнителя, approve_worker - для заказчика, если откликнулись исполнители)
            Status::STATUS_ACTIVE => [Action::ACTION_ACCEPT->value, Action::ACTION_REJECT->value], //  (accept - для заказчика, reject - для исполнителя)
            default => [],
        };
    }

    /**
     * Метод для возврата «карты» статусов в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
    **/
    public function getStatusMap(): array
    {
        return Status::getTranslateStatusMap();
    }

    /**
     * Метод для возврата «карты» действий в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
     */
    public function getActionMap(): array
    {
        return Action::getTranslateActionMap();
    }
}