<?php

return array(
    
    /**
     * 
     * Default formatting, list format and table format.
     * 
     */
    'list_project_format' => '<li id="taskmanager_project:id"> :name (by :username) :delete_button </li>',
    'list_tasks_format' => '<li id="taskmanager_task:id"> :name :complete_button </li>',
    
    /**
     * 
     * 
     */
    'view_url' => 'taskmanager/view',
    'edit_url' => 'taskmanager/edit',
    'delete_project_url' => 'taskmanager/delete/project/',
    'delete_task_url' => 'taskmanager/delete/task/',
    'complete_url' => 'taskmanager/complete/task/',

    /**
     * 
     * Default button formatting
     * 
     */
    'view_button' => '<a href=":view_url/:id" class="btn btn-success">View</a>',  
    'edit_button' => '<a href=":edit_url/:id" class="btn btn-primary">Edit</a>',  
    'delete_button' => '<a href="#" onclick="change(\':type\', :id, \':delete_url\'); return false" class="btn btn-danger">Delete</a>',  
    'complete_button' => '<a href="#" onclick="change(\':type\', :id, \':complete_url\'); return false" class="btn btn-success">Complete</a>', 
    
);
