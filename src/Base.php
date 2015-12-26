<?php 

namespace Areyi\TaskManager;
use DB;
use Illuminate\Database\Eloquent\Model;

class Base {

  public function __construct(){
    
  }

  public function getProject($projectId){
    $project = DB::table('projects')
      ->where('users.id', $projectId)
      ->join('users', 'users.id', '=', 'projects.owner')
      ->first(['projects.id', 'projects.name', 'projects.slug', 'users.username as owner', 'projects.created_at', 'projects.updated_at']);
    foreach($project as $key => $value){
      $this->$key = $value;
    }
    return $this;
  }
  
  public function getTasks(){
    $tasks = DB::table('tasks')
      ->where('project_id', $this->id)
      ->join('users', 'users.id', '=', 'tasks.author')
      ->get(['tasks.id', 'tasks.name', 'tasks.slug', 'users.username as author', 'tasks.completed', 'tasks.description', 'tasks.created_at', 'tasks.updated_at']);
    foreach($tasks as $task){
      $this->tasks[] = (array) $task;
    }
    return $this;
  }
  
  public function getTask($taskId){
    $this->task= (array) DB::table('tasks')
      ->where('project_id', $this->id)
      ->where('tasks.id', $taskId)
      ->join('users', 'users.id', '=', 'tasks.author')
      ->first(['tasks.id', 'tasks.name', 'tasks.slug', 'users.username as author', 'tasks.completed', 'tasks.description', 'tasks.created_at', 'tasks.updated_at']);
    return $this;
  }
 
}