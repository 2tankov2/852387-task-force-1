<?php

namespace app\entities;

use app\entities\Action;

class ActionReply extends Action
{

    /**
     * Метод проверки прав
     * @param int $currentUserId ID заказчика задания
     * @param int $ownerId ID текущего пользователя
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
     **/
    public static function compareId(int $currentUserId, int $ownerId, ?int $workerId): bool
    {
        return $currentUserId === $workerId;
    }
}