<?php
// CRUD.php

class CRUD {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Create Record
    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $types = str_repeat('s', count($values)); // assuming all are strings
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            $_SESSION['toast_message'] = "Record created successfully!";
            $_SESSION['toast_type'] = "success";
            return $this->conn->insert_id;
        } else {
            $_SESSION['toast_message'] = "Failed to create record.";
            $_SESSION['toast_type'] = "error";
            return false;
        }
    }

    // Read Records
    public function read($table, $columns = "*", $conditions = "") {
        $sql = "SELECT $columns FROM $table $conditions";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Update Record
    public function update($table, $data, $conditions) {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
        }
        $set = rtrim($set, ", ");
        $values = array_values($data);

        $sql = "UPDATE $table SET $set WHERE $conditions";
        $stmt = $this->conn->prepare($sql);
        $types = str_repeat('s', count($values)); // assuming all are strings
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            $_SESSION['toast_message'] = "Record updated successfully!";
            $_SESSION['toast_type'] = "success";
            return true;
        } else {
            $_SESSION['toast_message'] = "Failed to update record.";
            $_SESSION['toast_type'] = "error";
            return false;
        }
    }

    // Delete Record
    public function delete($table, $conditions) {
        $sql = "DELETE FROM $table WHERE $conditions";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute()) {
            $_SESSION['toast_message'] = "Record deleted successfully!";
            $_SESSION['toast_type'] = "success";
            return true;
        } else {
            $_SESSION['toast_message'] = "Failed to delete record.";
            $_SESSION['toast_type'] = "error";
            return false;
        }
    }
}
