<?php
class User {
    private string $username;
    private string $password;
    private DateTime $birthday;

    public function __construct(string $username, string $password, DateTime $birthday) {
        $this->username = $username;
        $this->password = $password;
        $this->birthday = $birthday;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getBirthday(): DateTime {
        return $this->birthday;
    }
}

class UserService {
    public function sortByUsername(array $users, bool $ascending = true): array {
        usort($users, function (User $a, User $b) use ($ascending) {
            return $ascending ? strcmp($a->getUsername(), $b->getUsername()) : strcmp($b->getUsername(), $a->getUsername());
        });
        return $users;
    }

    public function sortByBirthday(array $users, bool $ascending = true): array {
        usort($users, function (User $a, User $b) use ($ascending) {
            return $ascending ? $a->getBirthday() <=> $b->getBirthday() : $b->getBirthday() <=> $a->getBirthday();
        });
        return $users;
    }
}


$users = [
    new User("alice", "password123", new DateTime("1990-05-15")),
    new User("ilia", "passsword", new DateTime("1988-12-01")),
    new User("danil", "pp", new DateTime("1995-06-22")),
];


$userService = new UserService();
$sortedByUsername = $userService->sortByUsername($users);
foreach ($sortedByUsername as $user) {
    echo $user->getUsername() . "\n";
}

$sortedByBirthdayDescending = $userService->sortByBirthday($users, false);
foreach ($sortedByBirthdayDescending as $user) {
    echo $user->getUsername() . " - " . $user->getBirthday()->format('Y-m-d') . "\n";
}

?>
