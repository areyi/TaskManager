<?php

// GET taskmanager
Route::get('taskmanager', function() {
    Notification::container('panel')->panel_infoInstant(Notification::message('You got an info')->position(1));
    return TaskManager::getAll();
});