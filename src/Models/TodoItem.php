<?php

namespace Todo;
use \Exception;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        if (!isset($title)) {
            throw new Exception("Parameter is required");
        }
        // TODO: Implement me!
        $query = "INSERT INTO " . static::TABLENAME . " (title) VALUES (:title)";
        self::$db->query($query);

        self::$db->bind(":title", $title);
        
        $result = self::$db->execute(['title' => $title]);    

        if (!$result) {
            throw new Exception("Could not create title!");
        }

        return $result;
        // Create a new todo
    }

    public static function updateTodo($todoId, $title, $completed = null)
    {
        // TODO: Implement me!
        
        // Update a specific todo
    }

    // public static function deleteTodo($todoId)
    // {
    //     // TODO: Implement me!
    //     // Delete a specific todo
    // }
    
    // (Optional bonus methods below)
    // public static function toggleTodos($completed)
    // {
    //     // TODO: Implement me!
    //     // This is to toggle all todos either as completed or not completed
    // }

    // public static function clearCompletedTodos()
    // {
    //     // TODO: Implement me!
    //     // This is to delete all the completed todos from the database
    // }

}
