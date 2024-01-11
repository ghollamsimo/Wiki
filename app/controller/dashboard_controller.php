<?php

class Dashboard extends Controller
{
    private $AdminDAO;
    private $CategoryDAO;
    private $WikiDAO;
    private $TagDAO;
    public function __construct()
    {
        $this->AdminDAO = new AdminDAO();
        $this->CategoryDAO = new CategoryDAO();
        $this->WikiDAO = new WikiDAO();
        $this->TagDAO = new TagDAO();
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
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check for 'archive' button
            if (isset($_POST['archive'])) {
                $archive = $_POST['archive'];

                $wiki = new Wiki();
                $wiki->setId($archive);
                $this->WikiDAO->Archiver($wiki);
            }
            // Check for 'unarchive' button
            elseif (isset($_POST['unarchive'])) {
                $unarchive = $_POST['unarchive'];
                $wiki = new Wiki();
                $wiki->setId($unarchive);
                $this->WikiDAO->NonArchiver($wiki);
            }
        }

        // Fetch the wikis after handling form submissions
        $wiki = $this->WikiDAO->ReadWiki();

        // Pass the wikis to the view
        $this->view('Wiki', ['wiki' => $wiki]);
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
            $categoryId = $_POST['editCategoryId'];
            $newName = $_POST['editname'];

            $cat->setId($categoryId);
            $cat->setCategory($newName);
            $this->CategoryDAO->EditCategory($cat);
        }

        $this->view('Categorys' ,['category' => $categorys] );
    }

    public function Tags(){
        $tags = $this->TagDAO->ReadTag();
        $tag = new Tag();
        if (isset($_POST['submit'])){
            $nametag = $_POST['nametag'];

            $tag->setNameTag($nametag);
            $this->TagDAO->CreateTag($tag);
        }

        if (isset($_POST['delete'])){
            $idtag = $_POST['idtag'];

            $tag->setIdTag($idtag);
            $this->TagDAO->DeleteTag($tag);
        }

        if(isset($_POST['edit'])){
            $idtag = $_POST['idtag'];
            $nametag = $_POST['editname'];

            $tag->setIdTag($idtag);
            $tag->setNameTag($nametag);
            $this->TagDAO->EditTag($tag);
        }
        $this->view('tag' , ['tag' => $tags]);
    }
}