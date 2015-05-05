<?php

class UserController extends Controller
{
    public function process($parameters)
    {
        $this->data = array(
            'users' => array()
        );

        $userManager = new UserManager();
        $user = $userManager->getUserByNick($parameters[1]);

        $this->head = array
        (
            'title' => 'Profil uživatele ' . $user['nickname'],
            'description' => 'Profil uživatele blogu.'
        );
        $this->data['user'] = $user;
        $this->view = 'user';
    }

    public function processAdmin($parameters)
    {
        $this->checkUser(true);

        $this->data = array(
            'users' => array(),
            'admin' => true
        );

        $userManager = new UserManager();

        if (!empty($parameters[3]))
        {
            if($parameters[3] == Url::getCommand('remove-from-admin')){
                $userManager->removeFromAdmin($parameters[2]);
            }else if($parameters[3] == Url::getCommand('add-to-admin')){
                $userManager->addToAdmin($parameters[2]);
            }
            $this->redirect(Url::getAlias('admin') . '/' . Url::getAlias('users'));
        }

        $users = $userManager->getUsers();

        $this->head = array
        (
            'title' => 'Výpis uživatelů',
            'description' => 'Výpis všech článků na webu podle data.'
        );

        $this->data['users'] = $users;
        $this->view = 'users';
    }

}