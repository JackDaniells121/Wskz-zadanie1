CREATE DATABASE wskz;
GRANT ALL PRIVILEGES ON wskz.* TO'dbuser1'@'localhost';

-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE `User` (
  `Id` varchar(13) NOT NULL,
  `Login` varchar(333) NOT NULL,
  `Pass` varchar(333) NOT NULL,
  `Name` varchar(333) NOT NULL,
  `Surname` varchar(333) NOT NULL,
  `Gender` varchar(33) NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indeksy dla tabeli `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`);
COMMIT;