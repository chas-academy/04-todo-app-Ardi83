<?php

namespace Todo;
use \Exception;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch

    public static function createTodo($title)
    {
        if (!isset($title) || empty($title)) {
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
        $query = "UPDATE " . static::TABLENAME . " SET 
        title = :title,
        completed = :completed WHERE id = :id ";

        self::$db->query($query);

        self::$db->bind(":id", $todoId);
        self::$db->bind(":title", $title);
        self::$db->bind(":completed", $completed);
        
        $result = self::$db->execute([
        'id' => $todoId,
        'title' => $title,
        'completed' => $completed
        ]);

            if (!$result) {
                throw new Exception("Can not update title!.");
            }
            return $result;
        // Update a specific todo
    }

    public static function deleteTodo($todoId)
    {
        // TODO: Implement me!
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id = :id";
        self::$db->query($query);
        self::$db->bind(':id', $todoId);
        
        $result = self::$db->execute(['id' => $todoId]);

        if (!$result) {
            throw new Exception("Can not update title!.");
        }
        return $result;
        // Delete a specific todo
    }
    
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
