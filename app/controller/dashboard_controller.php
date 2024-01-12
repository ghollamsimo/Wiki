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
        $userAnalysis = $this->AdminDAO->analyseuser();

        $wikiCount = $this->AdminDAO->getWikiCount();
        $categoryCount = $this->AdminDAO->getCategoryCount();

        $GetUsers = $this->AdminDAO->GetUsers();

        $wiki = $this->WikiDAO->ReadWiki();
        $this->view('dashboard', [
            'userAnalysis' => $userAnalysis,
            'wikiCount' => $wikiCount,
            'categoryCount' => $categoryCount,
            'GetUsers' => $GetUsers ,
            'wiki' => $wiki
        ]);
    }

    public function Wikis()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['archive'])) {
                $archive = $_POST['archive'];

                $wiki = new Wiki();
                $wiki->setId($archive);
                $this->WikiDAO->Archiver($wiki);
            }
            elseif (isset($_POST['unarchive'])) {
                $unarchive = $_POST['unarchive'];
                $wiki = new Wiki();
                $wiki->setId($unarchive);
                $this->WikiDAO->NonArchiver($wiki);
            }
        }

        $wiki = $this->WikiDAO->ReadWiki();

        $this->view('Wiki', ['wiki' => $wiki]);
    }

    public function Category(){

        $categorys = $this->CategoryDAO->ReadCategory();
        $cat = new Category();

        if (isset($_POST['submit'])) {
            $idcat = isset($_POST['idcat']) ? htmlspecialchars($_POST['idcat']) : '';
            $namecategory = isset($_POST['namecategory']) ? htmlspecialchars($_POST['namecategory']) : '';

            $cat->setId($idcat);
            $cat->setCategory($namecategory);

            $this->CategoryDAO->CreateCategory($cat);

            header('location: /wiki/public/dashboard/Category');
            exit();
        }


        if (isset($_POST['delete'])) {
            $idcategory = isset($_POST['idcat']) ? htmlspecialchars($_POST['idcat']) : '';

            $cat->setId($idcategory);

            $this->CategoryDAO->DeleteCategory($cat);

            header('location: /wiki/public/dashboard/Category');
            exit();
        }


        if (isset($_POST['edit'])) {
            $categoryId = isset($_POST['editCategoryId']) ? htmlspecialchars($_POST['editCategoryId']) : '';
            $newName = isset($_POST['editname']) ? htmlspecialchars($_POST['editname']) : '';

            $cat->setId($categoryId);
            $cat->setCategory($newName);

            $this->CategoryDAO->EditCategory($cat);

            header('location: /wiki/public/dashboard/Category');
            exit();
        }


        $this->view('Categorys' ,['category' => $categorys] );
    }

    public function Tags(){
        $tags = $this->TagDAO->ReadTag();
        $tag = new Tag();
        if (isset($_POST['submit'])) {
            $nametag = isset($_POST['nametag']) ? htmlspecialchars($_POST['nametag']) : '';


            $tag->setNameTag($nametag);

            $this->TagDAO->CreateTag($tag);

            header('location: /wiki/public/dashboard/tags');

        }

        if (isset($_POST['delete'])) {
            $idtag = isset($_POST['idtag']) ? htmlspecialchars($_POST['idtag']) : '';

            $tag->setIdTag($idtag);
            $this->TagDAO->DeleteTag($tag);

            header('location: /wiki/public/dashboard/tags');

        }


        if (isset($_POST['edit'])) {
            $idtag = isset($_POST['idtag']) ? htmlspecialchars($_POST['idtag']) : '';
            $nametag = isset($_POST['editname']) ? htmlspecialchars($_POST['editname']) : '';

            $tag->setIdTag($idtag);
            $tag->setNameTag($nametag);
            $this->TagDAO->EditTag($tag);

            header('location: /wiki/public/dashboard/tags');

        }

        $this->view('tag' , ['tag' => $tags]);
    }
}