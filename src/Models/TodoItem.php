<?php

namespace Todo;
use \Exception;

class TodoItem extends Model
{
    const TABLENAME = 'todos'; // This is used by the abstract model, don't touch
    
    // Create a new todo
    public static function createTodo($title)
    {
        $query = "INSERT INTO " . static::TABLENAME . " (title) VALUES (:title)";
        self::$db->query($query);
        self::$db->bind(":title", $title);   
        $result = self::$db->execute(['title' => $title]);    

        if (!$result) {
            throw new Exception("Could not create title!");
        }
        return $result;
    }
    
    // Update a specific todo
    public static function updateTodo($todoId, $title, $completed = null)
    {
        $query = "UPDATE " . static::TABLENAME . " SET 
        title = '$title', completed = '$completed' 
        WHERE id = '$todoId' ";

        self::$db->query($query);
        // self::$db->bind(":id", $todoId);
        // self::$db->bind(":title", $title);
        // self::$db->bind(":completed", $completed);
        $result = self::$db->execute();
            if (!$result) {
                throw new Exception("Can not update title!.");
            }
            return $result;
        }
        
        // Delete a specific todo
    public static function deleteTodo($todoId)
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE id = $todoId";
        self::$db->query($query);

        $result = self::$db->execute();
        if (!$result) {
            throw new Exception("Can not update title!.");
        }
        return $result;
    }
    
    // This is to toggle all todos either as completed or not completed
    public static function toggleTodos()
    {
        $query = "UPDATE " . static::TABLENAME . " SET completed = 'true'";
        self::$db->query($query);

        $result = self::$db->execute();
        
        if (!$result) {
            throw new Exception("Can not toggle title!.");
        }
        return $result;
    }

    // This is to unselect all todos either as completed or not completed
    public static function undoToggleTodos()
    {
        $query = "UPDATE " . static::TABLENAME . " SET completed = 'false'";
        self::$db->query($query);

        $result = self::$db->execute();
        
        if (!$result) {
            throw new Exception("Can not undo title!.");
        }
        return $result;
    }

    // This is to delete all the completed todos from the database
    public static function clearCompletedTodos()
    {
        $query = "DELETE FROM " . static::TABLENAME . " WHERE completed = 'true' ";

        self::$db->query($query);
        $result = self::$db->execute();
        
        if (!$result) {
            throw new Exception("Can not update title!.");
        }
        return $result;
    }
}
