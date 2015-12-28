<?php
namespace Areyi\TaskManager\Formatter;


use Config;

class Formatter
{
    protected $_data;
    
    
    public function __construct($_data){
        $this->_data = $_data;
        $this->config = Config::get('taskmanager');
        
    }
    
    public function loadResources(){
        include(__DIR__.'/../resources/ajax.php');
    }
    
    /**
     * !!TODO!! need rework
     * 
     */
    public function asList(){
        if(isset($this->_data->projects)){
            $type = 'p';
            $format_placeholder = Config::get('taskmanager.list_project_format');
            foreach($this->_data->projects as $project){
                echo $this->replace($type, $project, $format_placeholder);
            }     
        }else{
            $type = 't';
            $format_placeholder = Config::get('taskmanager.list_tasks_format');
            foreach($this->_data->tasks as $task){
                echo $this->replace($type, $task, $format_placeholder);
            }     
        }
        $this->loadResources();
    }


    /**
     * !!TODO!! need rework
     * 
     */
    public function replace($type, $data, $format_placeholder){
        if(!isset($data['owner'])){
            $data['owner'] = $data['author'];
        }
        $i = str_replace(':name', $data['name'], $format_placeholder);
        $i = str_replace(':username', $data['owner'], $i);
        $i = str_replace(':done_task_button', $this->config['done_task_button'], $i);
        $i = str_replace(':view_button', $this->config['view_button'], $i);
        $i = str_replace(':edit_button', $this->config['edit_button'], $i);
        $i = str_replace(':delete_button', $this->config['delete_button'], $i);
        $i = str_replace(':view_url', $this->config['view_url'], $i);
        $i = str_replace(':edit_url', $this->config['edit_url'], $i);
        
        if($type == 'p'){
            $i = str_replace(':delete_url', $this->config['delete_project_url'], $i);
        }else if($type == 't'){
            $i = str_replace(':delete_url', $this->config['delete_task_button'], $i);
        }
        
        $i = str_replace(':done_url', $this->config['done_url'], $i);
        $i = str_replace(':id', $data['id'], $i);
        return $i;
    }
}