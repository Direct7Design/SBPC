<?php

/**
*
*   ####################################################
*   RolesController.php 
*   ####################################################
*
*   DESCRIPTION
*
*   This controller manages all role related functions
*   This includes CRUD.
*   
*   TABLE OF CONTENTS
*   
*   1)  index
*   2)  add
*   3)  edit
*   4)  delete
*   
*   
* @copyright  Copyright (c) 20011 XereoNet and SpaceBukkit (http://spacebukkit.xereo.net)
* @version    Last edited by Antariano
* @since      File available since Release 1.0
*
*
*/

class RolesController extends AppController {

    public function index() {
        $this->redirect(array('controller' => 'dash', 'action' => 'index'));
    }

    function add() {

        include APP . 'configuration.php';

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $pages = 0;
            $global = 0;
            $dash = 0;
            $users = 0;
            $plugins = 0;
            $worlds = 0;
            $servers = 0;
            $servertools = 0;
            $console = 0;

            foreach ($permissions["pages"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $pages = $pages+($bit*$multi);
            }
            /*
            foreach ($permissions["global"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $global = $global+($bit*$multi);
            }

            foreach ($permissions["dash"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $dash = $dash+($bit*$multi);
            }

            foreach ($permissions["users"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $users = $users+($bit*$multi);
            }

            foreach ($permissions["plugins"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $plugins = $plugins+($bit*$multi);
            }

            foreach ($permissions["worlds"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $worlds = $worlds+($bit*$multi);
            }

            foreach ($permissions["servers"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $servers = $servers+($bit*$multi);
            }

            foreach ($permissions["settings"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $settings = $settings+($bit*$multi);
            }*/
            $result = array(

                "title" => $data["rolename"],
                "pages" => $pages,
                "global" => $global,
                "dash" => $dash,
                "users" => $users,
                "plugins" => $plugins,
                "worlds" => $worlds,
                "servers" => $servers,
                "servertools" => $servertools,
                "console" => $console

                );

                $this->Role->create();
            if ($this->Role->save($result)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('controller' => 'tsettings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }

        }

        $this->set("permissions", $permissions);
        $this->layout = 'popup';

    }

    public function edit($id = null) {
        include APP . 'configuration.php';

        $this->Role->id = $id;
        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            $data = $this->request->data;

            $pages = 0;
            $global = 0;
            $dash = 0;
            $users = 0;
            $plugins = 0;
            $worlds = 0;
            $servers = 0;
            $servertools = 0;
            $console = 0;

            foreach ($permissions["pages"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data[$role];
                $pages = $pages+($bit*$multi);
            }
            /*
            foreach ($permissions["global"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $global = $global+($bit*$multi);
            }

            foreach ($permissions["dash"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $dash = $dash+($bit*$multi);
            }

            foreach ($permissions["users"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $users = $users+($bit*$multi);
            }

            foreach ($permissions["plugins"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $plugins = $plugins+($bit*$multi);
            }

            foreach ($permissions["worlds"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $worlds = $worlds+($bit*$multi);
            }

            foreach ($permissions["servers"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $servers = $servers+($bit*$multi);
            }

            foreach ($permissions["settings"] as $role => $value) {
                $bit = (int)$value;
                $multi = (int)$data["Role"][$role];
                $settings = $settings+($bit*$multi);
            }*/
            $result = array(

                "title" => $data["rolename"],
                "pages" => $pages,
                "global" => $global,
                "dash" => $dash,
                "users" => $users,
                "plugins" => $plugins,
                "worlds" => $worlds,
                "servers" => $servers,
                "servertools" => $servertools,
                "console" => $console
                );

            if ($this->Role->save($result)) {
                $this->Session->setFlash(__('The role has been saved'));
                $this->redirect(array('controller' => 'tsettings', 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('The role could not be saved. Please, try again.'));
            }
        } else {

            $this->request->data = $this->Role->read(null, $id);
            $data = $this->Role->findById($id);

            $cst = array();

            $cst['title'] = $data['Role']['title'];

            if ($data["Role"]['pages'] & $permissions['pages']['dash']) { $cst['dash'] = "checked"; } else {$cst['dash'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['users']) { $cst['users'] = "checked"; } else {$cst['users'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['plugins']) { $cst['plugins'] = "checked"; } else {$cst['plugins'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['worlds']) { $cst['worlds'] = "checked"; } else {$cst['worlds'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['server']) { $cst['server'] = "checked"; } else {$cst['server'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['servertools']) { $cst['servertools'] = "checked"; } else {$cst['servertools'] = ""; }
            if ($data["Role"]['pages'] & $permissions['pages']['console']) { $cst['console'] = "checked"; } else {$cst['console'] = ""; }

            $this->set("cst", $cst);

            $this->set("permissions", $permissions);
        }
        $default = $this->Role->data;

        $this->layout = 'popup';


    }

    function delete($id = null) {
      
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        $data = $this->request->data;

        $this->Role->id = $data['id'];

        if (!$this->Role->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $default = $this->Role->data;
   
        if ($this->Role->delete()) {
            $this->Session->setFlash(__('Role deleted'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Role was not deleted'));
        $this->redirect($this->referer());
    }

}