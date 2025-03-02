<?php


class Book {
    private $title;
    private $author;
    private $isAvailable;

    public function __construct($title, $author) 
    {
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = true; 
    }

    public function getTitle():string 
    {
        return $this->title;
    }

    public function getAuthor():string 
    {
        return $this->author;
    }

    public function isAvailable() :bool
    {
        return $this->isAvailable;
    }

    public function setAvailability($availability) 
    {
        $this->isAvailable = $availability;
    }
}

class User 
{
    private $name;
    private $userID;
    private $borrowedBooks;
    private $penalty;

    public function __construct($name, $userID) 
    {
        $this->name = $name;
        $this->userID = $userID;
        $this->borrowedBooks = [];
        $this->penalty = 0;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getUserID() 
    {
        return $this->userID;
    }

    public function borrowBook($book) 
    {
        if ($book->isAvailable()) 
        {
            $book->setAvailability(false); 
            $this->borrowedBooks[] = $book; 
        } else 
        {
            echo "Книга '" . $book->getTitle() . "' недоступна для займа.\n";
        }
    }

    public function returnBook($book) 
    {
        $key = array_search($book, $this->borrowedBooks, true);
        if ($key !== false) 
        {
            unset($this->borrowedBooks[$key]); 
            $book->setAvailability(true); 
        } else 
        {
            echo "Книга не была взята пользователем.\n";
        }
    }
}

class Library 
{
    private $books;
    private $users;

    public function __construct() 
    {
        $this->books = [];
        $this->users = [];
    }

    public function addBook($book) 
    {
        $this->books[] = $book;
    }

    public function addUser($user) 
    {
        $this->users[] = $user;
    }

    public function findBookByTitle($title) 
    {
        foreach ($this->books as $book) 
        {
            if ($book->getTitle() === $title) 
            {
                return $book;
            }
        }
        return null;
    }

    public function findUserById($userID) 
    {
        foreach ($this->users as $user) 
        {
            if ($user->getUserID() === $userID) 
            {
                return $user; 
            }
        }
        return null; 
    }
}


$library = new Library();
$library->addBook(new Book("1999", "Винни Пух"));
$library->addBook(new Book("смешарики", "Сказки"));
$library->addUser(new User("kirill", 1));
$library->addUser(new User("max", 2));


$bookToFind = $library->findBookByTitle("1999");
if ($bookToFind) 
{
    echo "Найдена книга: " . $bookToFind->getTitle() . " автор: " . $bookToFind->getAuthor() . "\n";
}


$userToFind = $library->findUserById(1);
if ($userToFind) 
{
    echo "Найден пользователь: " . $userToFind->getName() . " с ID: " . $userToFind->getUserID() . "\n";
}
/*  */
