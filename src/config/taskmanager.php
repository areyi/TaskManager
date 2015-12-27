<?php

return array(
    
    /**
     * 
     * Default formatting, list format and table format.
     * 
     */
    'list_project_format' => '<li> :name (by :username) :view_button :edit_button :delete_button </li>',
    'table_project_format' => '<tr>
                                <td>:name</td>
                                <td>:author</td>
                                <td></td>
                                <td></td>
                               </tr>',
    'list_tasks_format' => '<li> :name :done_task_button </li>',
    
    /**
     * 
     * View, edit and delete urls
     * (please note there is NO trailing slash /)
     * 
     */
    'view_url' => 'taskmanager/view',
    'edit_url' => 'taskmanager/edit',
    'delete_url' => 'taskmanager/delete',
    'done_url' => 'taskmanager/done',

    /**
     * 
     * Default button formatting
     * 
     */
    'view_button' => '<a href=":view_url/:id" class="btn btn-success">View</a>',  
    'edit_button' => '<a href=":edit_url/:id" class="btn btn-primary">Edit</a>',  
    'delete_button' => '<a href=":delete_url/:id" class="btn btn-danger">Delete</a>',  
    'done_task_button' => '<a href=":done_url/:id" class="btn btn-success">Done</a>', 
    
);
