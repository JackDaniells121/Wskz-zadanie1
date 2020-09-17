## Ogólny opis :smiley:

Front na podstawie bootstrap template sb admin2. Historia wersji z opisami w CHANGELOG'u

Dodana klasa DB2 - realizująca połączenie z bazą danych oraz CRUD
Dodana klasa User - rejestracja,logowanie użytkownika
Dodana klasa PageController - przekierowania/ przeładowania strony

skrypt logout.php - służący do wylogowywania - ale niestety nie resetuje sesji - do poprawy


Widoki
- login.php
- register.php
- index.php

to są w zasadzie widokami html z wcięciami echo php.

## SQL - Struktura tabel 
```sql
CREATE TABLE `Users` (
  `Id` varchar(13) NOT NULL,
  `Login` varchar(333) NOT NULL,
  `Pass` varchar(333) NOT NULL,
  `Name` varchar(333) NOT NULL,
  `Surname` varchar(333) NOT NULL,
  `Gender` varchar(33) NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);
COMMIT;
```

## Połącznie z bazą danych
Konfiguracja w pliku database.php
Zmieniamy
```php
    private $servername = "localhost";
    private $username = "dbuser1";
    private $password = "1234";
    private $myDB   = "wskz";
    
```


## Thanks :pray: