<?php
class Genres extends Controller
{
   public function __construct()
   {
      $this->genreModel = $this->model('Genre');
      $this->userModel = $this->model('User');
   }

   public function index()
   {
      $genres = $this->genreModel->getAll();
      $data = [
         'genres' => $genres
      ];
      $this->view('pages/genres', $data);
   }


   public function add()
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data = [
            'name' => trim($_POST['name'])
         ];

         // Make sure no errors
         if (!empty($data['name'])) {
            if ($this->genreModel->add($data)) {
               flash('genres_message', 'Genre successfully added');
               redirect('pages/genres');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load the view
            $this->view('genres/add', $data);
         }
      } else {
         $data = [
            'name' => ''
         ];
         $this->view('genres/add', $data);
      }
   }

   public function edit($id)
   {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         if (!isset($_SESSION['user_id'])) {
            redirect('pages/genres');
         }
         // Sanitize POST Array
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         $data = [
            'id' => $id,
            'name' => trim($_POST['name'])
         ];

         // Make sure no errors
         if (!empty($data['id']) && !empty($data['name'])) {

            // Validated
            if ($this->genreModel->put($data)) {
               flash('genres_message', 'Genre successfully updated');
               redirect('pages/genres');
            } else {
               die('Something went wrong');
            }
         } else {
            // Load the view
            $this->view('genres/edit', $data);
         }
      } else {
         // Get existing genre from model
         $genre = $this->genreModel->get($id);

         $data = [
            'id' => $genre->id,
            'name' => $genre->name
         ];
         $this->view('genres/edit', $data);
      }
   }

   public function delete($id)
   {
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
         //Check if user logged
         if (!isset($_SESSION['user_id'])) {
            redirect('pages/genres');
         }
         if ($this->genreModel->delete($id)) {
            flash('genres_message', 'Genre successfully removed');
            redirect('pages/genres');
         } else {
            die('Something went wrong');
         }
      } else {
         redirect('genres');
      }
   }
}
