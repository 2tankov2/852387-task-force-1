<?php

require_once 'Status.php';
enum Action: string
{
    case ACTION_CANCEL = 'cancel';   // отменить (заказчик)
    case ACTION_RESPONSE = 'response';  // откликнуться (исполнитель)
    case ACTION_APPROVE_WORKER = 'approve_worker';   // выбрать(принять) исполнителя для задачи (заказчик)
    case ACTION_ACCEPT = 'accept';  // принять работу (заказчик)
    case ACTION_REJECT = 'reject';  // отказаться (исполнитель)

    /**
     * Метод возвращает названия действия на русском языке
    **/
    public function translateAction(): string
    {
        return match($this) {
            self::ACTION_CANCEL => 'отменить', // отменить задание (заказчик)
            self::ACTION_RESPONSE => 'откликнуться', // откликнуться на задание (исполнитель)
            self::ACTION_APPROVE_WORKER => 'выбрать исполнителя',  // ???? выбрать(принять) исполнителя для задания (заказчик)
            self::ACTION_ACCEPT => 'принять', // принять задание-работу (заказчик)
            self::ACTION_REJECT => 'отказаться', // отказаться от задания (исполнитель)
        };
    }

    public static function getTranslateActionMap(): array
    {
        return [
            self::ACTION_CANCEL->value => 'отменить', // отменить задание (заказчик)
            self::ACTION_RESPONSE->value => 'откликнуться', // откликнуться на задание (исполнитель)
            self::ACTION_APPROVE_WORKER->value => 'выбрать исполнителя',  // ???? выбрать(принять) исполнителя для задания (заказчик)
            self::ACTION_ACCEPT->value => 'принять', // принять задание-работу (заказчик)
            self::ACTION_REJECT->value => 'отказаться', // отказаться от задания (исполнитель)
        ];
    }
}

//проверка
$action = Action::getTranslateActionMap();
var_dump($action);
