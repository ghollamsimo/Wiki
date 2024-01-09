<?php

class Dashboard extends Controller
{
    private $AdminDAO;

    public function __construct()
    {
        $this->AdminDAO = new AdminDAO();
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
        $admin = new Admin();
        $category = $this->AdminDAO->CreateCategory($admin);
        $this->view('Categorys' , ['CreateCategory' => $category]);
    }
}
