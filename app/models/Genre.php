<?php


class Genre
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM genres ORDER BY ID ASC');
        return $this->db->resultSet();
    }

    public function get($id)
    {
        $this->db->query('SELECT * FROM genres WHERE ID = :id');
        // Bind values
        $this->db->bind(':id', $id);
        return $this->db->get();
    }

    public function getGenreId($genre)
    {
        $this->db->query('SELECT * FROM genres WHERE name = :genre');
        // Bind values
        $this->db->bind(':genre', $genre);
        return $this->db->get();
    }

    public function add($data)
    {
        $this->db->query('INSERT INTO genres (name, dateCreated) VALUES (:name, now())');
        // Bind values
        $this->db->bind(':name', $data['name']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function put($data)
    {
        $this->db->query('UPDATE genres SET name = :name WHERE ID = :id');
        // Bind values
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
        $this->db->query('DELETE FROM genres WHERE ID = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
