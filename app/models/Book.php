<?php


class Book
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query('SELECT b.ID AS book_id, b.name AS book_name, a.name as author_name, g.name AS genre_name, b.dateCreated AS date_created
                                 FROM books b
                                 LEFT JOIN Genres g ON g.ID = b.genreID
                                 LEFT JOIN Authors a ON a.ID = b.authorID
                                 ORDER BY b.ID ASC');
        return $this->db->resultSet();
    }

    public function get($id)
    {
        $this->db->query('SELECT * FROM books WHERE ID = :id');
        $this->db->bind(':id', $id);
        return $this->db->get();
    }

    public function countRecords($id)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM books WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->get();
    }

    public function countAuthors($id)
    {
        $this->db->query('SELECT COUNT(*) AS total FROM books WHERE authorID = :id');
        $this->db->bind(':id', $id);
        return $this->db->get();
    }

    public function add($data)
    {
        $this->db->query('INSERT INTO books (name, authorid, genreid, dateCreated) VALUES (:name, :authorid, :genreid, now())');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':authorid', $data['authorID']);
        $this->db->bind(':genreid', $data['genreID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function put($data)
    {
        $this->db->query('UPDATE books SET name = :bookName, authorID = :authorID, genreID = :genreID where ID = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':bookName', $data['name']);
        $this->db->bind(':authorID', $data['authorID']);
        $this->db->bind(':genreID', $data['genreID']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM books WHERE id = :id');
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
