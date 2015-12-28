<?php

return array(
    
    /**
     * 
     * Default formatting, list format and table format.
     * 
     */
    'list_project_format' => '<li id="taskmanager:id"> :name (by :username) :delete_button </li>',
    'list_tasks_format' => '<li id="taskmanager:id"> :name :done_task_button </li>',
    
    /**
     * 
     * 
     */
    'view_url' => 'taskmanager/view',
    'edit_url' => 'taskmanager/edit',
    'delete_project_url' => 'taskmanager/delete/project/',
    'delete_task_url' => 'taskmanager/delete/task/',
    'done_url' => 'taskmanager/done',

    /**
     * 
     * Default button formatting
     * 
     */
    'view_button' => '<a href=":view_url/:id" class="btn btn-success">View</a>',  
    'edit_button' => '<a href=":edit_url/:id" class="btn btn-primary">Edit</a>',  
    'delete_button' => '<a href="#" onclick="changeProject(:id, \':delete_url\'); return false" class="btn btn-danger">Delete</a>',  
    'done_task_button' => '<a href=":done_url/:id" class="btn btn-success">Done</a>', 
    
);
