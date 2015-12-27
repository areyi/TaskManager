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
    
    public function asList(){
        print_r($this->_data);
        if(isset($this->_data->projects)){
            $format_placeholder = Config::get('taskmanager.list_project_format');
            foreach($this->_data->projects as $project){
                echo $this->replace($project, $format_placeholder);
            }     
        }else{
            $format_placeholder = Config::get('taskmanager.list_tasks_format');
            foreach($this->_data->tasks as $task){
                echo $this->replace($task, $format_placeholder);
            }     
        }
        
    }

    public function replace($data, $format_placeholder){
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
        $i = str_replace(':delete_url', $this->config['delete_url'], $i);
        $i = str_replace(':done_url', $this->config['done_url'], $i);
        $i = str_replace(':id', $data['id'], $i);
        return $i;
    }
}