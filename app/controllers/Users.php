<?php


class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        // Only for admin user
        if (!isAdmin()) {
            redirect('pages/index');
        }
        $users = $this->userModel->getUsers();
        $data = [
            'users' => $users
        ];
        return $this->view('users/index', $data);
    }

    public function register()
    {
        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please inform your email';
            } else {
                // Check email
                if ($this->userModel->getUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email is already in use. Choose another one!';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please inform your name';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please inform your password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please inform your password';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_error'] = 'Password does not match!';
            }

            //Make sure errors are empty
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are now registered!', 'alert alert-sucess');
                    $this->login();
                } else {
                    die('Something wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please inform your email';
            } else if (!$this->userModel->getUserByEmail($data['email'])) {
                // User not found
                $data['email_error'] = 'No user found!';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please inform your password';
            }

            //Make sure are empty
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // Validated
                // Check and set logged in user
                $userAuthenticated = $this->userModel->login($data['email'], $data['password']);
                if ($userAuthenticated) {
                    // Create session
                    $this->createUserSession($userAuthenticated);
                } else {
                    $data = [
                        'email' => trim($_POST['email']),
                        'password' => '',
                        'email_error' => 'Email or Password are incorrect',
                        'password_error' => 'Email or Password are incorrect',
                    ];
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            // Load view
            $this->view('users/login', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_mail']);
        unset($_SESSION['user_name']);
        unset($_SESSION['is_admin']);
        session_destroy();
        redirect('users/login');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['is_admin'] = $user->isadmin;
        redirect('pages/index');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        // Only for logged user
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'email' => $_SESSION['user_email'],
                'password_old' => trim($_POST['password_old']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'password_old_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate Password Old
            if (empty($data['password_old'])) {
                $data['password_old_error'] = 'Please inform your old password';
            } elseif (strlen($data['password_old']) < 6) {
                $data['password_old_error'] = 'Password old must be at least 6 characters';
            } else if (!$this->userModel->checkPassword($data['email'], $data['password_old'])) {
                $data['password_old_error'] = 'Your old password is wrong!';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please inform your password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm your password';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_error'] = 'Password does not match!';
            }

            //Make sure errors are empty
            if (empty($data['password_old_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->updatePassword($data)) {
                    flash('register_success', 'Password updated!', 'alert alert-sucess');
                    redirect('users');
                } else {
                    die('Something wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/changepassword', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => $_SESSION['user_email'],
                'password_old' => '',
                'password' => '',
                'confirm_password' => '',
                'password_old_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/changepassword', $data);
        }
    }

    public function add()
    {
        // Only for admin user
        if (!isAdmin()) {
            redirect('pages/index');
        }
        //Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter an email';
            } else {
                // Check email
                if ($this->userModel->getUserByEmail($data['email'])) {
                    $data['email_error'] = 'This email already exists in the database.';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter a username';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter a password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please enter a password';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_error'] = 'Password does not match!';
            }

            // Check if there is no errors and continue
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->addUser($data)) {
                    flash('user_message', 'User created with success!', 'alert alert-success');
                    redirect('users/index');
                } else {
                    die('Something wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/add', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/add', $data);
        }
    }

    public function delete($id)
    {
        // Only for admin user
        if (!isAdmin()) {
            redirect('pages/index');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Get existing post from model
            $user = $this->userModel->getUserById($id);
            //Check if the user is logged and same as one for delete
            if ($user->id == $_SESSION['user_id']) {

                flash('user_message', 'You cannot delete your own user!', 'alert alert-danger');
                redirect('users');
            } else {
                if ($this->userModel->deleteUser($id)) {
                    flash('user_message', 'The user was removed with success!', 'alert alert-success');
                    redirect('users');
                } else {
                    flash('user_message', 'An error ocurred when delete user', 'alert alert-danger');
                    redirect('users');
                }
            }
        }
    }
}
