<?php


class Pages extends Controller
{

   public function index()
   {
      $this->view('pages/index');
   }

   public function books()
   {
      // Load model and get all books for view
      $this->bookModel = $this->model('Book');
      $books = $this->bookModel->getAll();
      $data = [
         'books' => $books
      ];
      $this->view('pages/books', $data);
   }

   public function genres()
   {
      // Load model and get all genres for view
      $this->genreModel = $this->model('Genre');
      $genres = $this->genreModel->getAll();
      $data = [
         'genres' => $genres
      ];
      $this->view('pages/genres', $data);
   }

   public function authors()
   {
      // Load model and get all authors for view
      $this->authorModel = $this->model('Author');
      $authors = $this->authorModel->getAll();
      $data = [
         'authors' => $authors
      ];
      $this->view('pages/authors', $data);
   }
}
