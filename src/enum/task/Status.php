<?php

namespace app\enum\task;

enum Status: string
{
    case STATUS_NEW = 'new';   // новое задание (заказчик)
    case STATUS_CANCEL = 'cancel';  // отменено, отменил заказчик
    case STATUS_ACTIVE = 'active';   // в работе, заказчик выбрал исполнителя, если откликнулись
    case STATUS_READY = 'ready';    // выполнено, принято заказчиком
    case STATUS_FAILED = 'failed';   // провалено, отказался исполнитель

    /**
     * Метод для возврата «карты» статусов в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
     **/
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