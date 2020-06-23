<?php

class Author
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM authors ORDER BY id ASC');
        return $this->db->resultSet();
    }

    public function get($id)
    {
        $this->db->query('SELECT * FROM authors WHERE ID = :id');
        $this->db->bind(':id', $id);
        return $this->db->get();
    }

    public function getAuthorId($author)
    {
        $this->db->query('SELECT * FROM authors WHERE name = :author');
        $this->db->bind(':author', $author);
        return $this->db->get();
    }

    public function checkRecord($name)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM authors WHERE name = :name');
        $this->db->bind(':name', $name);
        return $this->db->get();
    }

    public function add($data)
    {
        print_r($data);
        $this->db->query('INSERT INTO authors (name, dateCreated) VALUES (:name, now())');
        $this->db->bind(':name', $data['name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function put($data)
    {
        $this->db->query('UPDATE authors SET name = :name WHERE ID = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM authors WHERE id = :id');
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
