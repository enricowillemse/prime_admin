<?php

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
use PRIME\Models\Users;
use PRIME\Models\SecurityGroup;
use PRIME\Models\Dashboards;

class Elements extends Phalcon\Mvc\User\Component
{

    private $_adminMenu = array(
            'index' => array(
                'caption' => 'Settings',
                'action' => 'index',
                'icon' =>'fa-cogs'
            ),
            'dashboard' => array(
                'caption' => 'Dashboards',
                'action' => 'index',
                'icon' =>'fa-tachometer'
            ),
            'process' => array(
                'caption' => 'Processes',
                'action' => 'index',
                'icon' =>'fa-line-chart'
            ),
             'users' => array(
                'caption' => 'Users',
                'action' => 'index',
                'icon' =>'fa-users'
            ),
            'computer' => array(
                'caption' => 'Computers',
                'action' => 'index',
                'icon' =>'fa-desktop'
            ),
            'security_group' => array(
                'caption' => 'Access Control',
                'action' => 'index',
                'icon' =>'fa-lock'
            ),
            'database_explorer' => array(
                'caption' => 'Database Explorer',
                'action' => 'index',
                'icon' =>'fa-database'
            ),
            'theme_creator' => array(
                'caption' => 'Theme Creator',
                'action' => 'index',
                'icon' =>'fa fa-file-text-o'
            ),
            'virtual_machine' => array(
                'caption' => 'VM Manager',
                'action' => 'index',
                'icon' =>'fa fa-file-text-o'
            )
            
    );
    

    
    private $_superviserMenu = array(
        'index' => array(
            'caption' => 'Home',
            'action' => 'supervior',
            'icon' =>'icon-custom-home'
        ),
        'report' => array(
            'caption' => 'Report',
            'action' => 'index',
            'icon' =>'fa fa-file-text-o'
        ),
        'calendar' => array(
            'caption' => 'Calendar',
            'action' => 'index',
            'icon' =>'fa fa-calendar-o'
        ),
        'profile' => array(
            'caption' => 'Profile',
            'action' => 'edit',
            'icon' =>'fa fa-user'
        ),
        'support' => array(
            'caption' => 'Support',
            'action' => 'index',
            'icon' =>'fa fa-envelope'
        )
);
    
    private $_userMenu = array(
            
    );

    

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
        
        $menu = array();
        

        
        $auth = $this->session->get('auth');
        
        $email = $auth['email'];
        
        $user = Users::findFirstByemail($email);

        $security_groups = $user->SecurityGroup;

        $user_dashboards = array();

        foreach($security_groups as $security_group)
        {
           $dashboards = $security_group->Dashboard;
           $user_dashboards =array_merge ($user_dashboards,$dashboards->ToArray());
        }

        
        foreach($user_dashboards as $dashboard)
        {    
            $newMenuLink =  array (
            'link' => "/dashboards/".$dashboard['type']."/render/".$dashboard['id']."/dashboard",
            'title' => $dashboard['title'],
            'icon' => $dashboard['icon'],
            'selected' => 'false'
            );
            
            array_push($menu,$newMenuLink);
        }
       
        
        if ($auth) {

            if($auth['role']=='User')
            {   
                foreach ($this->_userMenu as $controller => $option) {
                    
                    $newMenuLink =  array (
                    'link' => '/'.$controller.'/'.$option['action'],
                    'title' => $option['caption'],
                    'icon' => $option['icon'],
                    'selected' => 'false'
                    );
                    
                    array_push($menu,$newMenuLink);
                }
                
            }
            
            elseif($auth['role']=='Admin')   
            {
                foreach ($this->_adminMenu as $controller => $option) {
                    
                    $newMenuLink =  array (
                    'link' => '/'.$controller.'/'.$option['action'],
                    'title' => $option['caption'],
                    'icon' => $option['icon'],
                    'selected' => 'false'
                    );
                    
                    array_push($menu,$newMenuLink);
                }
            }
            
            elseif($auth['role']=='Supervisor')   
            {
                foreach ($this->_supervisorMenu as $controller => $option) {
                    
                    $newMenuLink =  array (
                    'link' => '/'.$controller.'/'.$option['action'],
                    'title' => $option['caption'],
                    'icon' => $option['icon'],
                    'selected' => 'false'
                    );
                    
                    array_push($menu,$newMenuLink);
                    
                }
            }
        }
        
        
        
        
        
        
        return $menu;
        
    }

}
