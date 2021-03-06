<?php
 
namespace PRIME\Controllers;
use PRIME\Models\SecurityGroup;
use PRIME\Models\Dashboard;
use PRIME\Models\Variables;
use PRIME\Models\Users;
use PRIME\Models\OrgDatabase;
use PRIME\Models\OrgDatabaseTable;
use PRIME\Models\Process;
use PRIME\Models\ProcessScheduled;
use PRIME\Models\UsersHasSecurityGroup;
use PRIME\Models\SecurityGroupHasDashboard;
use PRIME\Models\SecurityGroupHasOrgDatabaseTable;
use PRIME\Models\SecurityGroupHasProcess;
use PRIME\Models\SecurityGroupHasProcessScheduled;
use PRIME\Models\SecurityGroupHasVariables;

class SecurityGroupController extends ControllerBase
{
    public $organisation_id ="";
    public function initialize()
    {   
        
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Security Groups');
        parent::initialize();
        $auth = $this->session->get("auth");
        $this->organisation_id= $auth['organisation_id'];
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $data = SecurityGroup::find("organisation_id= ".$this->organisation_id);
        $this->view->setVar("security_groups", $data);  
    }


    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->tag->setDefault("organisation_id", $this->organisation_id);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    /**
     * Edits a user
     *
     * @param string $email
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {
            $security_group = SecurityGroup::findFirstById($id);
            if (!$security_group) {
                $this->flash->error("security group was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "security_group",
                    "action" => "index"
                ));
            }

            $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $this->tag->setDefault("name", $security_group->name);
            $this->tag->setDefault("id", $security_group->id);
            $this->tag->setDefault("organisation_id", $security_group->organisation_id);
            
            $types=array();

            $types[]=$this->editType("dashboard",$security_group);
            $types[]=$this->editType("process",$security_group);
            
            $types[]=$this->editType("process_scheduled",$security_group);
            
            $types[]=$this->editType("org_database_table",$security_group);
            $types[]=$this->editType("variables",$security_group);
            $types[]=$this->editType("users",$security_group);

            $this->view->setVar("types", $types); 
            
            $this->view->setVar("security_group", $security_group->id); 
                 
        }
    }

    public function editType($type,$security_group)
    {
        
        $type_camel = str_replace('_',"",ucwords ($type,"_"));

        $data_write=array();
        $data_read=array();
        $data_disable=array();
        eval('$data_security=$security_group->Has'.$type_camel.';');
        
        if($type=="org_database_table")
        {

            $database = OrgDatabase::findFirst("organisation_id=".$security_group->organisation_id);
            $data_all = OrgDatabaseTable::find("org_database_id=".$database->id);
        }
        else
        {
            eval('$data_all = PRIME\Models\\'.$type_camel.'::find("organisation_id='.$security_group->organisation_id.'");');
        }


        if($type=="users")
        {
            $id_string_left="email";
            $id_string_right =$type."_email";
        }
        else
        {
            $id_string_left="id";
            $id_string_right =$type."_id";
        }

        foreach($data_all as $item_all)
        {
            $has_item=false;

            
            foreach ($data_security as $item) {
                if($item_all->$id_string_left == $item->$id_string_right)
                {
                    $has_item=true;
                    if($item->read_write=="true")
                    {
                        $data_write[]=$item_all;
                        break;
                    }
                    else
                    {
                        $data_read[]=$item_all;
                        break;
                    }
                }
            }
            if(!$has_item)
            {
                $data_disable[]=$item_all;
            }
        }

        $item=array();
        $item['name']=$type;
        if($type=="users")
        {
            $item['id']="email";
            $item['title']="full_name";
        }
        elseif($type=="dashboard")
        {
            $item['id']="id";
            $item['title']="title";
        }
        else
        {
            $item['id']="id";
            $item['title']="name";
        }
        
        $item['write']=$data_write;
        $item['read']=$data_read;
        $item['disable']=$data_disable;

        return $item;
    }


    public function setAction($security_group_id,$type,$action,$id)
    {
        $type_camel = str_replace('_',"",ucwords ($type,"_"));
        if($action=="read"||$action=="write")
        {

            if($type=="users")
            {
                eval('$item = new PRIME\Models\\'.$type_camel.'HasSecurityGroup();');
            }
            else
            {
                eval('$item = new PRIME\Models\SecurityGroupHas'.$type_camel.'();');
            }
            

        $item->security_group_id = $security_group_id;
        if($action=="read")
        {
            $item->read_write = 'false';
        }
        else
        {
            $item->read_write = 'true';
        }

        if($type=="users")
        {
            $id_string =$type."_email";
        }
        else
        {
            $id_string =$type."_id";
        }

        eval('$item->'.$id_string.' = "'.$id.'" ;');

        
        if (!$item->save()) {
            $this->flash->success("Something went wrong, please contact your system administrator");
        }
        else
        {
            $this->flash->success(ucfirst ($type)." was succesfully added to Security Group");
        }

        }
        else
        {

            if($type=="users")
            {
                eval('$entry=PRIME\Models\\'.$type_camel.'HasSecurityGroup::findFirst(array("security_group_id= '.$security_group_id.'","'.$type.'_email = '.$id.'"));');
            }
            else
            {
                eval('$entry=PRIME\Models\SecurityGroupHas'.$type_camel.'::findFirst(array("security_group_id= '.$security_group_id.'","'.$type.'_id = '.$id.'"));');
            }
           


        if (!$entry->delete()) {

        }

        $this->flash->success(ucfirst ($type)." was succesfully removed from Security Group");
        
        }

                return $this->dispatcher->forward(array(
                                                "namespace" => "PRIME\Controllers",
                                                "controller" => "security_group",
                                                "action"     => "index"
                                                ));

    }
    
    
    public function enable_dashboardAction($dashboard_id,$users_email)
    {

        $dashboard_has_user = new DashboardHasUsers();

        $dashboard_has_user->dashboard_id = $dashboard_id;
        $dashboard_has_user->users_email = $users_email;
        

        if (!$dashboard_has_user->save()) {

        }

        $this->flash->success("Dashboard was successfully enabled");
        return $this->dispatcher->forward(array(
                                                "namespace" => "PRIME\Controllers",
                                                "controller" => "users",
                                                "action"     => "index"
                                                ));

    }
    
    
    public function disable_dashboardAction($dashboard_id,$users_email)
    {
        $dashboard_has_user = DashboardHasUsers::findFirst(array("dashboard_id= $dashboard_id","users_email= $users_email"));
        

        if (!$dashboard_has_user->delete()) {

        }

        $this->flash->success("Dashboard was successfully disabled");
        return $this->dispatcher->forward(array(
    "namespace" => "PRIME\Controllers",
    "controller" => "users",
    "action"     => "index"
    ));

    }
    

    /**
     * Creates a new user
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "security_group",
                "action" => "index"
            ));
        }

        $security_group = new SecurityGroup();

        $security_group->name = $this->request->getPost("name");
        $security_group->description = $this->request->getPost("description");
        $security_group->organisation_id = $this->request->getPost("organisation_id");
        

        if (!$security_group->save()) {
            foreach ($security_group->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "security_group",
                        "action"     => "index"
                        ));
        }
        
        
        $this->flash->success("Security  Group was created successfully");

        return $this->dispatcher->forward(array(
            "namespace" => "PRIME\Controllers",
            "controller" => "security_group",
            "action"     => "index"
            ));
        
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $email = $this->request->getPost("email");

        $user = Users::findFirstByemail($email);
        if (!$user) {
            $this->flash->error("user does not exist " . $email);

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user->email = $this->request->getPost("email", "email");
        $user->full_name = $this->request->getPost("full_name");
        $user->image_path = $this->request->getPost("image_path");
        
        $user->role = $this->request->getPost("role");
        $user->status = $this->request->getPost("status");
        $user->organisation_id = $this->request->getPost("organisation_id");


        if($this->request->getPost("password")!=$user->password)
        {
            $user->password = sha1($this->request->getPost("password"));
        }
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "namespace" => "PRIME\Controllers",
                        "controller" => "users",
                        "action"     => "index"
                        ));
        }

        $this->flash->success("User was updated successfully");

        return $this->dispatcher->forward(array(
                    "namespace" => "PRIME\Controllers",
                    "controller" => "users",
                    "action"     => "index"
                    ));

    }

    /**
     * Deletes a user
     *
     * @param string $email
     */
    public function deleteAction()
    {
        $email=$this->request->getPost("id");

        $user = Users::findFirstByemail($email);
        if (!$user) {
            $this->flash->error("User was not found");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $this->flash->success("User was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

}
