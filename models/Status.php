<?php

require_once 'Action.php';
enum Status: string
{
    case STATUS_NEW = 'new';   // новое задание (заказчик)
    case STATUS_CANCEL = 'cancel';  // отменено, отменил заказчик
    case STATUS_ACTIVE = 'active';   // в работе, заказчик выбрал исполнителя, если откликнулись
    case STATUS_READY = 'ready';    // выполнено, принято заказчиком
    case STATUS_FAILED = 'failed';   // провалено, отказался исполнитель

    /**
     * Метод возвращает названия статуса на русском языке
    **/
    public function translateStatus(): string
    {
        return match($this) {
            self::STATUS_NEW => 'новое',  // новое
            self::STATUS_CANCEL => 'отменено', // отменено, отменил заказчик
            self::STATUS_ACTIVE => 'в работе', // в работе
            self::STATUS_READY => 'выполнено',  // выполнено, принято заказчиком
            self::STATUS_FAILED => 'провалено', // провалено, отказался исполнитель
        };
    }

    public static function getTranslateStatusMap(): array
    {
        return [
            self::STATUS_NEW->value => 'новое',
            self::STATUS_CANCEL->value => 'отменено',
            self::STATUS_ACTIVE->value => 'в работе',
            self::STATUS_READY->value => 'выполнено',
            self::STATUS_FAILED->value => 'провалено',
        ];
    }
}

// проверка
$status = Status::getTranslateStatusMap();
var_dump($status);