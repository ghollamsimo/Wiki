<?php
session_start();

class Home extends Controller {
    private $wikiDAO;
    private $userDAO;

    public function __construct() {
        $this->wikiDAO = new WikiDAO();
        $this->userDAO = new UserDAO();
        $this->category = new CategoryDAO();
    }

    public function index(...$param) {
        $wikis = $this->wikiDAO->ReadWiki();

        if (isset($_SESSION['iduser'])) {
            $this->userDAO->getUser()->setId($_SESSION['iduser']);
            $user = $this->userDAO->getUserInfo($this->userDAO->getUser());
        }

        if (isset($_POST['submit'])){
            $wiki = new Wiki();
            $wiki->setTitle($_POST['title']);
            $wiki->setImage($_POST['img']);
            $wiki->setTag($_POST['tag']);
            $wiki->setCategory($_POST['cat']);
            $wiki->setDescreption($_POST['desc']);
            $wiki->getUserId()->setUserId($_POST['userid']);
            $this->wikiDAO->CreateWiki($wiki);
            $wiki->setId($_GET['idwiki']);
        }

        $categorys = $this->category->ReadCategory();
        $this->view('home', ['wiki' => $wikis ,'category' => $categorys]);
    }

    public function Singlewiki($id): void{
        if ($id){
            $idWiki = $id;
            $wiki = new Wiki();
            $wiki->setId($idWiki);
            $wikis = $this->wikiDAO->ReadOneWiki($wiki);
            $wiki->setTitle($wikis["Title"]);
            $this->view('singlewiki' ,['wiki' => $wiki] );
        }

    }
    public function login() {
        if (isset($_POST['login'])) {
            $user = new UserDAO;
            $user->getUser()->setEmail(trim($_POST['email']));
            $user->getUser()->setPassword($_POST['password']);

            $authenticatedUser = $user->verifyUser($user->getUser());

            if ($authenticatedUser !== false) {
                $_SESSION['iduser'] = $authenticatedUser['iduser'];
                $_SESSION['Nom'] = $authenticatedUser['Nom'];
                $_SESSION['Email'] = $authenticatedUser['Email'];
                $_SESSION['image'] = $authenticatedUser['image'];
                $_SESSION['role'] = $authenticatedUser['role'];

                if ($_SESSION['role'] === 'Admin') {
                    header('Location: /wiki/public/dashboard/index');
                    exit;
                } else {
                    header('Location: /wiki/public/home/index');
                    exit;
                }
            } else {
                echo 'User not found or incorrect password';
            }
        }

        $this->view('login');
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('location:/wiki/public/home/login');
    }
    public function Register() {
        if (isset($_POST["submit"])) {
            $user = new UserDAO();

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

            $image = isset($_POST['image']) ? 'This Image Already Exists!!' : '';

            if ($email_error == '' && $name_error == '' && $password_error == '') {
                $user->getUser()->setName(trim(isset($_POST['username']) ? trim($_POST['username']) : ''));
                $user->getUser()->setEmail(trim(isset($_POST['email']) ? trim($_POST['email']) : ''));
                $user->getUser()->setPassword(isset($_POST['password']) ? trim($_POST['password']) : '');
                $user->getUser()->setRole(isset($_POST['role']) ? trim($_POST['role']) : '');

                if ($user->CreateUser($user->getUser()) === true) {
                    $rowUser = $user->selectLastUser();
                    $_SESSION['iduser'] = $rowUser['iduser'];
                    $_SESSION['Nom'] = $rowUser['Nom'];
                    $_SESSION['Email'] = $rowUser['Email'];
                    $_SESSION['image'] = $rowUser['image'];
                    $_SESSION['role'] = $rowUser['role'];

                    header('location: /wiki/public/home/login');
                    exit;
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
                $this->view('Rigester', $error_user);
            }
        }
        $error_user = [
            'email_error' => '',
            'name_error' => '',
            'password_error' => ''
        ];
        $this->view('Rigester', $error_user);
    }
}
