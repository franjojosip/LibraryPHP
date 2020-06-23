<?php
class Books extends Controller
{
   public function __construct()
   {
      $this->bookModel = $this->model('Book');
      $this->authorModel = $this->model('Author');
      $this->genreModel = $this->model('Genre');
   }

   public function index()
   {
      $genres = $this->genreModel->getAll();
      $authors = $this->authorModel->getAll();
      $data = [
         'genres' => $genres,
         'authors' => $authors
      ];
      $this->view('pages/books', $data);
   }


   public function add()
   {
      // Only logged users can add new books
      if (!isset($_SESSION['user_id'])) {
         redirect('pages/books');
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data = [
            'name' => trim($_POST['name']),
         ];

         // Load ids for selected genre and author
         $genre = $this->genreModel->getGenreId($_POST['genre']);
         $author = $this->authorModel->getAuthorId($_POST['author']);
         $data['genreID'] = $genre->id;
         $data['authorID'] = $author->id;

         if ($this->bookModel->add($data)) {
            flash('books_message', 'Book successfully added', 'alert alert-success');
            redirect('pages/books');
         } else {
            die('Something went wrong');
         }
      } else {
         // Load data for page
         $genres = $this->genreModel->getAll();
         $authors = $this->authorModel->getAll();
         $data = [
            'name' => '',
            'author' => '',
            'genre' => '',
            'genres' => $genres,
            'authors' => $authors
         ];
         $this->view('books/add', $data);
      }
   }

   public function edit($id)
   {
      // Only logged users can edit books
      if (!isset($_SESSION['user_id'])) {
         redirect('pages/books');
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
         ];

         if (!empty($data['id'])) {

            // Load ids for selected genre and author
            $genre = $this->genreModel->getGenreId($_POST['genre']);
            $author = $this->authorModel->getAuthorId($_POST['author']);
            $data['genreID'] = $genre->id;
            $data['authorID'] = $author->id;

            if ($this->bookModel->put($data)) {
               flash('books_message', 'Book successfully updated');
               redirect('pages/books');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load the view
            $this->view('books/edit', $data);
         }
      } else {
         // Get existing book from model
         $book = $this->bookModel->get($id);
         $genres = $this->genreModel->getAll();
         $authors = $this->authorModel->getAll();
         $data = [
            'id' => $book->id,
            'name' => $book->name,
            'authorID' => $book->authorid,
            'genreID' => $book->genreid,
            'genres' => $genres,
            'authors' => $authors
         ];
         $this->view('books/edit', $data);
      }
   }


   public function delete($id)
   {
      //Check if user logged
      if (!isset($_SESSION['user_id'])) {
         redirect('pages/books');
      }

      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         if ($this->bookModel->delete($id)) {
            flash('books_message', 'Book successfully removed');
            redirect('pages/books');
         } else {
            die('Something went wrong');
         }
      } else {
         redirect('books');
      }
   }
}
