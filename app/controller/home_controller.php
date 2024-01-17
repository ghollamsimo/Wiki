<?php
session_start();

class Home extends Controller {
    private $wikiDAO;
    private $userDAO;
    private $wikitag;
    private $TagDAO;

    public function __construct() {
        $this->wikiDAO = new WikiDAO();
        $this->userDAO = new UserDAO();
        $this->category = new CategoryDAO();
        $this->wikitag = new WikiTagDAO();
        $this->TagDAO = new TagDAO();
    }

    public function index(...$param) {
        $tags = $this->TagDAO->ReadTag();
        $wikis = $this->wikiDAO->ReadLastWiki();
        $wiki = new Wiki();

        if (isset($_SESSION['iduser'])) {
            $this->userDAO->getUser()->setId($_SESSION['iduser']);
            $user = $this->userDAO->getUserInfo($this->userDAO->getUser());
        }
        if (isset($_POST['submit'])) {
            try {
                $wiki->setUserId($_POST['iduser']);
                $wiki->setTitle($_POST['title']);
                $wiki->setCategory($_POST['cat']);
                $wiki->setDescreption($_POST['desc']);
                $wiki->setEtat($_POST['etat']);
                $tmp_name = $_FILES['img']['tmp_name'];
                $imageName = file_get_contents($tmp_name);
                $wiki->setImage($imageName);

                $insertedWikiId = $this->wikiDAO->CreateWiki($wiki);
                foreach ($_POST['tag'] as $tagId) {
                    $wikitag = new WikiTag();
                    $wikitag->setIdTag($tagId);
                    $wikitag->setIdWiki($insertedWikiId);

                    $insertedWikiTagId = $this->wikitag->CreateWikiTag($wikitag);
                    echo 'Inserted WikiTag ID: ' . $insertedWikiTagId;
                }
                $_SESSION['success_message'] = 'Wiki created successfully.';
                header('Location: /wiki/public/home/index');
                exit();

            } catch (Exception $e) {
                $_SESSION['error_message'] = 'Error creating wiki: ' . $e->getMessage();
            }
        }

        $categorys = $this->category->ReadLastCategory();
        $categories = $this->category->ReadCategory();
        $this->view('home', ['wiki' => $wikis, 'category' => $categorys, 'categories' => $categories, 'tag' => $tags ]);
    }

    public function Singlewiki( $id = null ){

        $tags = $this->TagDAO->ReadTag();
        $categories = $this->category->ReadCategory();
        $wikitag = $this->wikitag->ReadTag();
        $wiki = new Wiki();

        if ($id){
            $idWiki = $id;
            $wiki->setId($idWiki);
            $wikis = $this->wikiDAO->ReadOneWiki($wiki);
            $wiki->setId($wikis['idwiki']);


            $wiki->setTitle($wikis["Title"]);
            $wiki->setEtat($wikis['etat']);
            $wiki->setDescreption($wikis['Descreption']);
            $wiki->setImage($wikis['image']);
            $wiki->setNameCtaegory($wikis['namecategory']);
        }

        if (isset($_POST['delete'])) {
            $idwiki = isset($_POST['idwiki']) ? htmlspecialchars($_POST['idwiki']) : '';
            $wiki->setId($idwiki);
            $this->wikiDAO->DeleteWiki($wiki);
            header('location: /wiki/public/home/index');
            exit();
        }

        if (isset($_POST['edit'])){

            $wiki->setId($_POST['id']);
            $wiki->setTitle($_POST['title']);
            $wiki->setCategory($_POST['cat']);
            $wiki->setDescreption($_POST['desc']);
            $tmp_name = $_FILES['img']['tmp_name'];
            $imageName = file_get_contents($tmp_name);
            $wiki->setImage($imageName);

            $insertedWikiId = $this->wikiDAO->EditeWiki($wiki);
            $insertedWikiTagId = $this->wikitag->EditWikiTag($_POST['id']);
            foreach ((array)$_POST['tag'] as $tagId) {

                if (!empty($tagId)) {
                    //$wikitag = new WikiTag();

                    //$wikitag->setIdTag($tagId);
                    //$wikitag->setIdWiki($insertedWikiId);

                    $insertedWikiTagId = $this->wikitag->InsertWikiTag($tagId,$_POST['id']);
                    echo 'Inserted WikiTag ID: ' . $insertedWikiTagId;
                }
            }
            $_SESSION['success_message'] = 'Wiki created successfully.';
            header('location: /wiki/public/home/index');
            exit();
        }

        $this->view('singlewiki', ['wiki' => $wiki, 'categories' => $categories ,'tag' => $tags , 'wikitag' => $wikitag]);
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
    public function search()
    {
        extract($_POST);
        $wikis = $this->wikiDAO->SearchWikiByTitleAndCategory($searchKey, $searchKey);
        echo json_encode($wikis);


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
public function multipleWikis($id){
        if ($id){
            $idcategory = $id;
            $category = new Category();
            $category->setId($idcategory);
            $categories = $this->category->ReadOneCategory($category);
            $category->setId($categories['idcategory']);
            $this->view('singlecategory');
        }

}
public function wikis(){
    $wikis = $this->wikiDAO->ReadWiki();

    $this->view('wikipage' , ['wiki' => $wikis]);
}
public function categories(){
    $categorys = $this->category->ReadCategory();

    $this->view('categoryPage' , ['category' => $categorys]);
}
}