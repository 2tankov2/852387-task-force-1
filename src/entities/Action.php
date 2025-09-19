<?php

namespace app\entities;
abstract class Action
{
    /**
     * Метод проверки прав
     * @param int $currentUserId ID заказчика задания
     * @param int $ownerId ID текущего пользователя
     * @param ?int $workerId ID исполнителя задания
     *
     * @return bool true/false
    **/
    abstract public static function compareId(int $currentUserId, int $ownerId, ?int $workerId): bool;

}