<?php
class Authors extends Controller
{
   public function __construct()
   {
      $this->authorModel = $this->model('Author');
      $this->bookModel = $this->model('Book');
   }

   public function index()
   {
      $authors = $this->authorModel->getAll();
      $data = [
         'authors' => $authors
      ];
      $this->view('pages/authors', $data);
   }


   public function add()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         // Only registered users are allowed to make changes on table
         if (!isset($_SESSION['user_id'])) {
            redirect('pages/authors');
         }

         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data = [
            'name' => trim($_POST['name'])
         ];

         // Check post variable
         $count = $this->authorModel->checkRecord($data['name']);
         if (!empty($data['name'])) {
            if ($count->total > 0) {
               flash('authors_message', 'Author with the same name already exists', 'alert alert-warning');
               $this->view('authors/add', $data);
            } else {
               if ($this->authorModel->add($data)) {
                  flash('authors_message', 'Author successfully added');
                  redirect('pages/authors');
               } else {
                  die('Something went wrong');
               }
            }
         } else {
            // Load the view
            $this->view('authors/add', $data);
         }
      } else {
         $data = [
            'name' => ''
         ];
         $this->view('authors/add', $data);
      }
   }

   public function edit($id)
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         // Only registered users are allowed to make changes on table
         if (!isset($_SESSION['user_id'])) {
            redirect('pages/authors');
         }

         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'id' => $id,
            'name' => trim($_POST['name'])
         ];

         // Check post variables
         if (!empty($data['id']) && !empty($data['name'])) {

            // Validated
            if ($this->authorModel->put($data)) {
               flash('authors_message', 'Author successfully updated');
               redirect('pages/authors');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load the view
            $this->view('authors/edit', $data);
         }
      } else {
         // Get existing author from model
         $author = $this->authorModel->get($id);

         $data = [
            'id' => $author->id,
            'name' => $author->name
         ];
         $this->view('authors/edit', $data);
      }
   }


   public function delete($id)
   {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {

         // Only registered users are allowed to make changes on table
         if (!isset($_SESSION['user_id'])) {
            redirect('pages/authors');
         }

         // Delete only if id isn't foreign key for any record in books table
         $count = $this->bookModel->countAuthors($id);
         if ($count->total > 0) {
            flash('authors_message', 'Selected author is connected with a record from Book table.', 'alert alert-warning');
            redirect('pages/authors');
         } else {
            // Call delete method on db
            if ($this->authorModel->delete($id)) {
               flash('authors_message', 'Author successfully removed');
               redirect('pages/authors');
            } else {
               die('Something went wrong');
            }
         }
      } else {
         redirect('authors');
      }
   }
}
