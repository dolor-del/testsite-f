<?php

namespace application\controllers;

use application\core\Controller;

class AdminUsersController extends Controller
{

    public function mainAction()
    {
        $this->view->layout = 'admin';

        $res = $this->model->getAllUsers();

        $vars = [
            'users' => $res,
            'flag' => $this->model->flag,
            'info' => $this->model->info,

        ];

        $this->view->render('Управление пользователями', $vars);
    }

    public function addAction()
    {
        $this->view->layout = 'admin';

        $res = $this->model->addUser();

        if ($res) {
            header('Location: /admin/users');
            exit;
        }

        $vars = [
            'errors' => $this->model->errors,

        ];

        $this->view->render('Добавление пользователя', $vars);
    }

    public function editAction()
    {
        $this->view->layout = 'admin';

        $res = $this->model->editUser();

        $vars = [
            'user' => $res,
            'errors' => $this->model->errors,

        ];

        $this->view->render('Добавление пользователя', $vars);
    }

}