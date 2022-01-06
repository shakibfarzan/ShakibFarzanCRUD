<?php

namespace CRUD\Controller;

use CRUD\Model\Actions;
use CRUD\Model\Person;
use CRUD\Helper\PersonHelper;

class PersonController
{
    public function switcher($uri, $request)
    {
        switch ($uri) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $date = date_create();
        $person = new Person();
        $person->setId(date_timestamp_get($date));
        $person->setFirstName($request['firstName']);
        $person->setLastName($request['lastName']);
        $person->setUsername($request['username']);
        if (PersonHelper::getInstance()->insert($person)) {
            http_response_code(200);
        } else {
            http_response_code(400);
        }
    }

    public function updateAction($request)
    {
        $person = new Person();
        $person->setId($request['id']);
        $person->setFirstName($request['firstName']);
        $person->setLastName($request['lastName']);
        $person->setUsername($request['username']);
        if (PersonHelper::getInstance()->update($person)) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
    }

    public function readAction($request)
    {
        PersonHelper::getInstance()->fetch($request['id']);
    }
    public function readAllAction($request)
    {
        PersonHelper::getInstance()->fetchAll();
    }

    public function deleteAction($request)
    {
        if (PersonHelper::getInstance()->delete($request['id'])) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
    }
}
