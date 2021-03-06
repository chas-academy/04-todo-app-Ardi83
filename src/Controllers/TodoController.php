<?php

use Todo\Controller;
use Todo\Database;
use Todo\TodoItem;

class TodoController extends Controller {
    
    public function get()
    {
        $todos = TodoItem::findAll();
        return $this->view('index', ['todos' => $todos]);
    }

    public function error()
    {
      echo "<h1>Todo item should not be empty</h1>";
    }

    public function add()
    {
        $body = filter_body();
        $title = $body['title'];
        if (!isset($title) || empty($title)) {
          $this->redirect('/error');
      } 
      
        $result = TodoItem::createTodo(htmlspecialchars($title, ENT_QUOTES, 'UTF-8'));
        if ($result) {
          $this->redirect('/');
        }
    }

    public function update($urlParams)
    {
        $body = filter_body(); // gives you the body of the request (the "envelope" contents)
        $todoId = $urlParams['id']; // the id of the todo we're trying to update
        $completed = isset($body['status']) ? 1 : 0; // whether or not the todo has been checked or not

        $result = TodoItem::updateTodo($todoId, $body['title'], $completed);

        if ($result) {
          $this->redirect('/');
        } else {
          // otherwise, throw an exception or show an error message
          throw new \Exception("Request for redirect failed!.");
        }
    }

    public function delete($urlParams)
    {
      $result = TodoItem::deleteTodo($urlParams['id']);

        if ($result) {
          $this->redirect('/');
        } else {
          // otherwise, throw an exception or show an error message
          throw new \Exception("Request for redirect failed!.");
          }
    }

    public function toggle()
    { 
      $completed = $_POST['checking-all'];

      $result = TodoItem::toggleTodos($completed);
      if ($result) {
        $this->redirect('/');
      } else {
        // (OPTIONAL) TODO: This action should toggle all todos to completed, or not completed.
        throw new \Exception("Request for redirect failed!.");
        }
    }
  
    // public function undo()
    // {
    //   $result = TodoItem::undoToggleTodos();
    //   if ($result) {
    //     $this->redirect('/');
    //   } else {
    //     // (OPTIONAL) TODO: This action should toggle all todos to completed, or not completed.
    //     throw new \Exception("Request for redirect failed!.");
    //     }
    // }

    public function clear()
    {
      $result = TodoItem::clearCompletedTodos();

      if ($result) {
        $this->redirect('/');
        } else {
          // (OPTIONAL) TODO: This action should remove all completed todos from the table.
          throw new \Exception("Request for redirect failed!.");
          }
    }
      
}
