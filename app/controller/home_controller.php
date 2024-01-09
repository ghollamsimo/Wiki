<?php

class Home extends Controller{
    private $wikiDAO;
    private $userDAO;

    public function __construct(){
        $this->wikiDAO = new WikiDAO();
        $this->userDAO = new UserDAO();
    }

    public function index(...$param){
        $wikis = $this->wikiDAO->ReadWiki();
        if (isset($_SESSION['iduser'])){
            $this->userDAO->getUser()->setId($_SESSION['iduser']);
            $this->userDAO->getUserInfo($this->userDAO->getUser());
        }
        $this->view('home' , ['wiki' => $wikis]);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $user = $this->userDAO;
            $user->getUser()->setEmail(trim($_POST['email']));
            $user->getUser()->setPassword($_POST['password']);

            $user = $user->VerifyUser($user->getUser()); // Fix typo

            if ($user != false) {
                $_SESSION['iduser'] = $user['iduser'];
                $_SESSION['Nom'] = $user['Nom'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['image'] = $user['image'];
                $_SESSION['role'] = $user['role'];

                if ($_SESSION['role'] == 'Admin') {
                    header('location:/wiki/public/dashboard/index');
                } elseif ($_SESSION['role'] == 'Auteur') {
                    header('location:/wiki/public/home/index'); // Corrected line
                }
            } else {
                echo 'user not found';
            }
        }

        $this->view('login');
    }


    public function Rigester()
    {
        if (isset($_POST["submit"])) {
            $user = new UserDAO();

            // Validate name
            if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['username'])) {
                $name_error = 'Invalid name format';
            } else {
                $name_error = '';
            }

            // Validate email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email_error = 'Invalid email address';
            } else {
                $email_error = '';
            }

            // Validate password
            if ($_POST['password'] == '') {
                $password_error = 'Invalid password format';
            } else {
                $password_error = '';
            }

            // Validate image (consider reviewing this part)
            $image = isset($_POST['image']) ? 'This Image Already Exists!!' : '';

            // If all validations pass, proceed with user registration
            if ($email_error == '' && $name_error == '' && $password_error == '') {
                $user->getUser()->setName(trim(isset($_POST['username']) ? trim($_POST['username']) : ''));
                $user->getUser()->setEmail(trim(isset($_POST['email']) ? trim($_POST['email']) : ''));
                $user->getUser()->setPassword(isset($_POST['password']) ? trim($_POST['password']) : '');
                $user->getUser()->setRole(isset($_POST['role']) ? trim($_POST['role']) : '');


                if ($user->CreateUser($user->getUser()) == true) {
                    $rowUser = $user->selectLastUser();
                    $_SESSION['iduser'] = $rowUser['iduser'];
                    $_SESSION['Nom'] = $rowUser['Nom'];
                    $_SESSION['Email'] = $rowUser['Email'];
                    $_SESSION['image'] = $rowUser['image'];
                    $_SESSION['role'] = $rowUser['role'];

                    header('location:/wiki/public/home/login');
                } else {
                    $error_user = [
                        'email_error' => 'This email exists',
                        'name_error' => $name_error,
                        'password_error' => $password_error,
                        'image' => $image
                    ];
                    $this->view('Rigester', $error_user);
                }
            } else {
                $error_user = [
                    'email_error' => $email_error,
                    'name_error' => $name_error,
                    'password_error' => $password_error,
                    'image' => $image
                ];
                $this->view('Rigester', $error_user); // Fix typo
            }
        }
        $error_user = [
            'email_error' => '',
            'name_error' => '',
            'password_error' => ''
        ];
        $this->view('Rigester', $error_user); // Fix typo
    }

}
