<?php

namespace app\enum\task;

enum Action: string
{
    case ACTION_CANCEL = 'cancel';   // отменить (заказчик)
    case ACTION_REPLY = 'reply';  // откликнуться (исполнитель)
    case ACTION_APPROVE_WORKER = 'approve_worker';   // выбрать(принять) исполнителя для задачи (заказчик)
    case ACTION_ACCEPT = 'accept';  // принять работу (заказчик)
    case ACTION_REJECT = 'reject';  // отказаться (исполнитель)

    /**
     * Метод для возврата «карты» действий в виде ассоциативного массива.
     * @return array массив [ключ — внутреннее имя, а значение — названия статуса на русском]
     */
    public static function getTranslateActionMap(): array
    {
        return [
            self::ACTION_CANCEL->value => 'отменить', // отменить задание (заказчик)
            self::ACTION_REPLY->value => 'откликнуться', // откликнуться на задание (исполнитель)
            self::ACTION_APPROVE_WORKER->value => 'выбрать исполнителя',  // ???? выбрать(принять) исполнителя для задания (заказчик)
            self::ACTION_ACCEPT->value => 'принять', // принять задание-работу (заказчик)
            self::ACTION_REJECT->value => 'отказаться', // отказаться от задания (исполнитель)
        ];
    }
}

//проверка
$action = Action::getTranslateActionMap();
var_dump($action);
