# TaskManager
A simple task manager for Laravel
  - Simple and extensible
  - Method chaining
  - Formatter (alpha)

TaskManager is a Laravel package which allows you to create projects, and create tasks. The package is in **development stage** for time being, and not ready for production uses.

----

### Version
0.3.1

### Requirements

Dillinger uses a number of open source projects to work properly:

* Laravel - version 5 (version 4 <= untested, need help here). 
* PHP - version => 5.3

----

### Installation

Download the package as a zip, and then put it on /vendor folder. 

Add the following line on your **composer.json** file, under the psr-4:

```
"psr-4": {
    ...
    "Areyi\\TaskManager\\": "vendor/areyi/taskmanager/src"
}
```

After that, register the TaskManagerServiceProvider in the /config/app.php file, under the **providers** array:
```php
'Areyi\TaskManager\Laravel\TaskManagerServiceProvider'
```

And in the same file, put the TaskManager alias under the **aliases** array:
```php
'TaskManager' => 'Areyi\TaskManager\Facades\TaskManager'
```

And finally, run all the migration files
```sh
php artisan migrate --path=vendor/areyi/taskmanager/src/database/migrations
```

----

## Usage

First, you must supply with the user_id (which you can get from your favourite authentication managers). This will make sure projects and tasks belongs to the right user.

```php
$user_id = 1; // get from your login manager
TaskManager::setUserId($user_id);
```

### 1. To create a new project:
Try this:
```sh
$project_details = [
    'name' => 'New Project',
    'name' => 'new_project', //optional
];

TaskManager::addProject($project_details);
```

which will return:
```
Areyi\TaskManager\Base Object
(
    [userID] => 1
    [result] => 1
    [project_id] => 77
)
```

### 2. To create a new task:
You can straightaway creating a task without supplying the project_id if you have created a project before
```php
$task_details = [
    'name' => 'New Task'
];

TaskManager::addTask($task_details);
```

or you can also chain them to create multiple tasks:
```php
TaskManager::addTask($task_details)->addTask($task2_details)->addTask($task3_details);
```

which will return:

```
Areyi\TaskManager\Base Object
(
    [userID] => 1
    [result] => 1
    [project_id] => 79
    [task_id] => Array
        (
            [0] => 75
            [1] => 76
            [2] => 77
        )
)
```

and you can also create project and add tasks to it at the same time:
```php
TaskManager::addProject($project_details)->addTask($task_details)->addTask($task_details);
```

### 3. Get all projects:
To get all existing projects:
```php
TaskManager::getProjects();
```
which will returns straightaway:
```
Areyi\TaskManager\Base Object
(
    [userID] => 1
    [projects] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Web Development Project
                    [slug] => webdev
                    [owner_id] => 1
                    [owner] => admin
                    [created_at] => 2015-12-26 01:00:55
                    [updated_at] => 2015-12-26 01:00:55
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => New Project
                    [slug] => new_project
                    [owner_id] => 2
                    [owner] => staff
                    [created_at] => 2015-12-26 01:43:38
                    [updated_at] => 2015-12-26 01:43:38
                )
        )
)
```

### 4. Get all tasks with specified project_id

To get all tasks assign to a project:
```php
$project_id = 1;
TaskManager::getProject($project_id)->getTasks();
```
which returns:

```
Areyi\TaskManager\Base Object
(
    [userID] => 1
    [id] => 1
    [name] => Web Development Project
    [slug] => webdev
    [owner_id] => 1
    [owner] => admin
    [created_at] => 2015-12-26 01:43:38
    [updated_at] => 2015-12-26 01:43:38
    [tasks] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Buy a milk
                    [slug] => 
                    [author_id] => 1
                    [author] => admin
                    [completed] => 0
                    [description] => 
                    [created_at] => 2015-12-26 01:43:38
                    [updated_at] => 2015-12-26 01:43:38
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => Buy a book
                    [slug] => 
                    [author_id] => 1
                    [author] => admin
                    [completed] => 0
                    [description] => 
                    [created_at] => 2015-12-26 01:43:38
                    [updated_at] => 2015-12-26 01:43:38
                )

        )

)
```

#### 5. Get the whole thing
You can also get all projects along with their tasks:
```php
TaskManager::getAll();
```

#### 6. Delete a project
To delete a project (this will also delete all tasks under the same project):
```php
$projectId = 1;
TaskManager::deleteProject($projectId);
```

#### 7. Delete a task
To delete a task:
```php
$task_id = 1;
TaskManager::deleteTask($task_id);
```


#### 8. Mark a complete a task 
To mark a task as completed:
```php
TaskManager::completeTask($task_id)
```

----

### List of available routes
These are the available routes in the package:

| Route                                        | Uses                                     |
|----------------------------------------------|------------------------------------------|
| GET /taskmanager/list/all                    | List all projects and tasks              |
| GET /taskmanager/list/projects               | List all projects                        |
| GET /taskmanager/list/project/{project_id}   | Get a project with the given project id  |
| GET /taskmanager/list/tasks/{project_id}     | Get tasks associated with the project id |
| GET /taskmanager/delete/project/{project_id} | Delete the project                       |
| GET /taskmanager/delete/task/{task_id}       | Delete the task                          |
| GET /taskmanager/complete/task/{task_id}     | Mark the task as completed               |

----

### List of avaiable methods
These are the methods in the package:

| Method                                     | Uses                                         |
|--------------------------------------------|----------------------------------------------|
| TaskManager::setUserId($userId);           | Set the ownership for all projects and tasks |
| TaskManager::addProject($project_details); | Create a new project                         |
| TaskManager::addTask($task_details);       | Add a new task                               |
| TaskManager::getProjects();                | Get all projects                             |
| TaskManager::getProject($project_id);      | Get a project by given project_id            |
| TaskManager::getTasks();                   | Get all tasks                                |
| TaskManager::getTask($project_id);         | Get a task by given project_id               |
| TaskManager::getAll();                     | Get all projects and their tasks             |
| TaskManager::projectDelete();              | (todo)                                       |
| TaskManager::taskDone();                   | (todo)                                       |
| TaskManager::taskDelete();                 | (todo)                                       |
| TaskManager::format();                     | (todo)                                       |

----

### Todos

 - Task done method (50%)
 - Delete task method (50%)
 - Formatter (50%)

----

### License

BSD 3-Clause

### Contributions

Feel free to contribute to the project! It will be much appriciated! And most importantly, its a **Free Software, Hell Yeah!**


