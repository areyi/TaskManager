<?php

Route::get('taskmanager/list/all', function() {
    return TaskManager::getAll();
});

Route::get('taskmanager/list/projects', function() {
    return TaskManager::getProjects();
});

Route::get('taskmanager/list/project/{project_id}', function($project_id) {
    return TaskManager::getProject($project_id);
});

Route::get('taskmanager/list/tasks/{project_id}', function($project_id) {
    return TaskManager::getTasks($project_id);
});

Route::get('taskmanager/delete/project/{project_id}', function($project_id) {
    return TaskManager::deleteProject($project_id);
});

Route::get('taskmanager/delete/task/{task_id}', function($task_id) {
    return TaskManager::deleteTask($task_id);
});

Route::get('taskmanager/complete/task/{task_id}', function($task_id) {
    return TaskManager::completeTask($task_id);
});