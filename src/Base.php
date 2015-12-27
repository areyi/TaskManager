<?php
namespace Areyi\TaskManager;

use Illuminate\Database\Eloquent\Model;
use Areyi\TaskManager\Formatter\Formatter;
use DB;
use Carbon;
use Session;

class Base
{
    public function __construct()
    {
        $this->initialize();
    }
    
    public function initialize(){
        config([
            'project_columns' => ['projects.id', 'projects.name', 'projects.slug', 'users.id as owner_id', 'users.username as owner', 'projects.created_at', 'projects.updated_at']
        ]);
        
        config([
            'task_columns' => ['tasks.id', 'tasks.name', 'tasks.slug', 'users.id as author_id', 'users.username as author', 'tasks.completed', 'tasks.description', 'tasks.created_at', 'tasks.updated_at']
        ]);
    }
    
    /**
     * Set the user id for creating projects and tasks
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userID = $userId;
    }
    
    /**
     * Get all projects and tasks
     * @return Areyi\TaskManager
     */
    public function getAll(){
        $projects  = (array) DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.owner')
            ->get(config('project_columns'));
        
        $c = 0;
        
        foreach($projects as $project){
            $this->projects[$c] = (array) $project;
            $tasks = (array) DB::table('tasks')
                ->where('project_id', $project->id)
                ->join('users', 'users.id', '=', 'tasks.author')
                ->get(config('task_columns'));
            foreach($tasks as $task){
                $this->projects[$c]['tasks'][] = (array) $task;
            }
            $c++;
        }
        
        return $this;
    }
    
    /** 
     * Get a project with given projectId
     * 
     * @param mixed $projectId
     * @return Areyi\TaskManager
     */    
    public function getProject($projectId)
    {
        $project = DB::table('projects')
            ->where('projects.id', $projectId)
            ->join('users', 'users.id', '=', 'projects.owner')
            ->first(config('project_columns'));
        
        foreach($project as $key => $value) {
            $this->$key = $value;
        }
        


        return $this;
    }
    
    /**
     * Get whole projects
     * @return Areyi\TaskManager
     */
    public function getProjects(){
        $projects = DB::table('projects')
            ->join('users', 'users.id', '=', 'projects.owner')
            ->get(config('project_columns'));
        foreach($projects as $project) {
            $this->projects[] = (array)$project;
        }

        return $this;        
    }

    /** 
     * Get all tasks, with or without project id. Get the project ID from $this->id, 
     * which is created when chaining methods together for example: 
     * 
     * TaskManager::addProject($project_details)->addTask($task_details)
     * 
     * @return Areyi\TaskManager
     */
    public function getTasks()
    {
        
        if(isset($this->id)){
            $tasks = DB::table('tasks')
                ->where('project_id', $this->id)
                ->join('users', 'users.id', '=', 'tasks.author')
                ->get(config('task_columns'));
            foreach($tasks as $task) {
                $this->tasks[] = (array)$task;
            }    
        }else{
            $tasks = DB::table('tasks')
                ->join('users', 'users.id', '=', 'tasks.author')
                ->get(config('task_columns'));
            foreach($tasks as $task) {
                $this->tasks[] = (array)$task;
            }
        }
        

        return $this;
    }

    /**
     * Get a specific task by task id
     * 
     * @param mixed $taskId
     * @return Areyi\TaskManager
     */
    public function getTask($taskId)
    {
        $this->task = (array)DB::table('tasks')
            ->where('project_id', $this->id)
            ->where('tasks.id', $taskId)->join('users', 'users.id', '=', 'tasks.author')
            ->first(config('task_columns'));
        return $this;
    }
    
    /**
     * Create a project
     * 
     * @param array $details
     * @return Areyi\TaskManager
     */
    public function addProject(array $details)
    {
        
        if(!isset($details['slug']))
        {
            $details['slug'] = '';    
        }
        
        $this->result = DB::table('projects')->insert(
            [
                'name' => $details['name'], 
                'slug' => $details['slug'], 
                'owner' => $this->userID, 
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ]
        );

        $this->project_id = $this->getLastInsertId();
        Session::set('last_project_id', $this->project_id);

        return $this;
    }

    /**
     * Create a task
     * 
     * @param array $details
     * @return Areyi\TaskManager
     */    
    public function addTask(array $details)
    {
        
        // Use the default slug
        if(!isset($details['slug']))
        {
            $details['slug'] = '';    
        }
        
        // Use the default description
        if(!isset($details['description']))
        {
            $details['description'] = '';    
        }
        
        // Use the newest created project_id
        if(!isset($details['project_id']))
        {
            if(!isset($this->project_id))
            {
                //todo
                $details['project_id'] = Session::get('last_project_id');
            }
            else
            {
                $details['project_id'] = $this->project_id;
            }
            
        }

        $this->result = DB::table('tasks')->insert(
            [
                'project_id' => $details['project_id'],
                'name' => $details['name'], 
                'slug' => $details['slug'], 
                'author' => $this->userID,
                'completed' => 0,
                'description' => $details['description'],
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ]
        );
        
        $this->task_id[] = $this->getLastInsertId();
        
        return $this;
    }
    
    public function format(){
        return $formatter = new Formatter($this);
    }
    
    /**
     * !!TODO!!
     * Helper method to get the last insert id
     */
    private function getLastInsertId(){
        $lid = json_decode(json_encode(DB::select('SELECT LAST_INSERT_ID()')), true);
        $lastInsertId = $lid[0]['LAST_INSERT_ID()'];
        return $lastInsertId;
    }
}