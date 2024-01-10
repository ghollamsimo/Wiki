<?php

class Dashboard extends Controller
{
    private $AdminDAO;
    private $CategoryDAO;

    public function __construct()
    {
        $this->AdminDAO = new AdminDAO();
        $this->CategoryDAO = new CategoryDAO();
    }

    public function index()
    {
        // Analyze user data
        $userAnalysis = $this->AdminDAO->analyseuser();

        $wikiCount = $this->AdminDAO->getWikiCount();
        $categoryCount = $this->AdminDAO->getCategoryCount();

        $GetUsers = $this->AdminDAO->GetUsers();

        $this->view('dashboard', [
            'userAnalysis' => $userAnalysis,
            'wikiCount' => $wikiCount,
            'categoryCount' => $categoryCount,
            'GetUsers' => $GetUsers
        ]);
    }

    public function Wikis()
    {
        $this->view('Wiki');
    }

    public function Category(){

        $categorys =  $this->CategoryDAO->ReadCategory();
        $cat = new Category();
        if (isset($_POST['submit'])){
            $cat->setId($_POST['idcat']);
            $cat->setCategory($_POST['namecategory']);
            $this->CategoryDAO->CreateCategory($cat);
        }

        if(isset($_POST['edit'])){
            $cat->setId($_POST['idcat']);
            $cat->setCategory($_POST['editname']);
            $this->CategoryDAO->EditCategory($cat);
        }

        $this->view('Categorys' ,['category' => $categorys] );
    }
}