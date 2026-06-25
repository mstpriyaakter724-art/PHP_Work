CREATE TABLE `students1` (
  `id` int(11) PRIMARY KEY auto_increment,
  `name` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `class` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
);

--
-- Dumping data for table `students1`
--

INSERT INTO `students1` (`id`, `name`, `age`, `class`, `email`) VALUES
(1, 'Rahim', 15, 9, 'rahim1@example.com'),
(2, 'Karim', 16, 9, 'karim2@example.com'),
(3, 'Sajid', 17, 10, 'sajid3@example.com'),
(4, 'Hasan', 18, 10, 'hasan4@example.com'),
(5, 'Nadia', 19, 11, 'nadia5@example.com'),
(6, 'Mitu', 20, 12, 'mitu6@example.com'),
(7, 'Sumon', 21, 12, 'sumon7@example.com'),
(8, 'Anika', 22, 11, 'anika8@example.com'),
(9, 'Rafi', 23, 10, 'rafi9@example.com'),
(10, 'Tanvir', 24, 9, 'tanvir10@example.com'),
(11, 'Rafi', 18, 10, 'rafi11@example.com'),
(12, 'Nadia', 20, 11, 'nadia12@example.com'),
(13, 'Hasan', 22, 12, 'hasan13@example.com'),
(14, 'Sajid', 19, 9, 'sajid14@example.com'),
(15, 'Anika', 21, 10, 'anika15@example.com'),
(16, 'Mitu', 23, 11, 'mitu16@example.com'),
(17, 'Sumon', 17, 12, 'sumon17@example.com'),
(18, 'Rahim', 25, 9, 'rahim18@example.com'),
(19, 'Karim', 20, 10, 'karim19@example.com'),
(20, 'Sharmin', 18, 11, 'sharmin20@example.com'),
(21, 'Shuvo', 22, 12, 'shuvo21@example.com'),
(22, 'Tania', 19, 9, 'tania22@example.com'),
(23, 'Faruk', 21, 10, 'faruk23@example.com'),
(24, 'Lamia', 23, 11, 'lamia24@example.com'),
(25, 'Nusrat', 20, 12, 'nusrat25@example.com'),
(26, 'Jamil', 24, 9, 'jamil26@example.com'),
(27, 'Fahim', 18, 10, 'fahim27@example.com'),
(28, 'Alif', 19, 11, 'alif28@example.com'),
(29, 'Shanta', 22, 12, 'shanta29@example.com'),
(30, 'Parvez', 21, 9, 'parvez30@example.com'),
(31, 'Mim', 23, 10, 'mim31@example.com'),
(32, 'Adnan', 20, 11, 'adnan32@example.com'),
(33, 'Bithi', 18, 12, 'bithi33@example.com'),
(34, 'Nayeem', 25, 9, 'nayeem34@example.com'),
(35, 'Ruma', 19, 10, 'ruma35@example.com'),
(36, 'Sabbir', 21, 11, 'sabbir36@example.com'),
(37, 'Shila', 22, 12, 'shila37@example.com'),
(38, 'Asif', 20, 9, 'asif38@example.com'),
(39, 'Nafisa', 18, 10, 'nafisa39@example.com'),
(40, 'Rashed', 24, 11, 'rashed40@example.com'),
(41, 'Salma', 23, 12, 'salma41@example.com'),
(42, 'Rony', 19, 9, 'rony42@example.com'),
(43, 'Tasnim', 21, 10, 'tasnim43@example.com'),
(44, 'Imran', 22, 11, 'imran44@example.com'),
(45, 'Priya', 20, 12, 'priya45@example.com'),
(46, 'Maruf', 18, 9, 'maruf46@example.com'),
(47, 'Shamim', 25, 10, 'shamim47@example.com'),
(48, 'Liza', 19, 11, 'liza48@example.com'),
(49, 'Arif', 21, 12, 'arif49@example.com'),
(50, 'Rupa', 22, 9, 'rupa50@example.com'),
(51, 'Tarek', 20, 10, 'tarek51@example.com'),
(52, 'Joya', 18, 11, 'joya52@example.com'),
(53, 'Mamun', 23, 12, 'mamun53@example.com'),
(54, 'Papia', 21, 9, 'papia54@example.com'),
(55, 'Niloy', 19, 10, 'niloy55@example.com'),
(56, 'Keya', 22, 11, 'keya56@example.com'),
(57, 'Ovi', 20, 12, 'ovi57@example.com'),
(58, 'Moni', 24, 9, 'moni58@example.com'),
(59, 'Shorna', 18, 10, 'shorna59@example.com'),
(60, 'Habib', 23, 11, 'habib60@example.com');




SQL Practice Questions (Students Table)
1. Basic SELECT
    Show all columns of all students.
    Show only the name and age of all students.
    List all students from class 10.
    Find all students whose age is greater than 20.
    Show the first 10 students in the table.
2. Filtering with WHERE
    Find students whose name starts with 'S'.
    Find students aged between 18 and 22.
    Show students from class 9 or class 12.
    List students whose email is NULL.
    Show students who are not 18 years old.
    3. Sorting
    List all students ordered by age ascending.
    Show the oldest 5 students.
    Show the youngest student in class 11.
4. DISTINCT
    Show all the different classes available in the table.
    Find all distinct ages present in the dataset.
5. Aggregate Functions
    Count how many students are in the table.
    Find the average age of all students.
    Find the maximum and minimum age.
    Find the total sum of all ages.
    Count how many students are in class 10.
6. GROUP BY + HAVING
    Show how many students are in each class.
    Show the average age of students grouped by class.
    Show only those classes where the number of students is greater than 20.
    Find the youngest students age in each class.
7. Subqueries
    Find the names of students who have the maximum age in the table.
    Find students whose age is above the average age.
    Find students who are in the same class as "Tanvir".
8. LIKE and Pattern Matching
    Find all students whose name ends with 'a'.
    Find students whose email contains the word "example".
    Show all students whose name is 5 characters long.
9. LIMIT & OFFSET
    Show the top 5 students by age.
    Show the next 5 students after skipping the first 5.
10. VIEW
    Create a view named teen_students showing students aged between 13 and 19.
    Drop the teen_students view.


-- SELECT * FROM students1;

-- SELECT name, age FROM students1;

-- SELECT * FROM students1 WHERE class = 10;

-- SELECT * FROM students1 WHERE age > 20;

-- SELECT * FROM students1 LIMIT 10;

-- SELECT * FROM students1 WHERE name LIKE 'S%';

-- SELECT * FROM students1 WHERE age BETWEEN 18 AND 22;

-- SELECT * FROM students1 WHERE class = 9 OR class = 12;

-- SELECT * FROM students1 WHERE email IS NULL;

-- SELECT * FROM students1 WHERE age <> 18;

-- SELECT * FROM students1 ORDER BY age ASC;

-- SELECT * FROM students1 ORDER BY age DESC LIMIT 5;

-- SELECT * FROM students1 WHERE class = 11 ORDER BY age ASC LIMIT 1;

-- SELECT DISTINCT class FROM students1;

-- SELECT DISTINCT age FROM students1;

-- SELECT COUNT(*) FROM students1;

-- SELECT AVG(age) FROM students1;

-- SELECT MAX(age), MIN(age) FROM students1;

-- SELECT SUM(age) FROM students1;

-- SELECT COUNT(*) FROM students1 WHERE class = 10;

-- SELECT class, COUNT(*) FROM students1 GROUP BY class;

-- SELECT class, AVG(age) FROM students1 GROUP BY class;

-- SELECT class, COUNT(*) 
-- FROM students1
-- GROUP BY class
-- HAVING COUNT(*) > 20;

-- SELECT class, MIN(age)
-- FROM students1
-- GROUP BY class;

-- SELECT name
-- FROM students1
-- WHERE age = (SELECT MAX(age) FROM students1);

-- SELECT *
-- FROM students1
-- WHERE age > (SELECT AVG(age) FROM students1);

-- SELECT *
-- FROM students1
-- WHERE class = (
--     SELECT class
--     FROM students1
--     WHERE name = 'Tanvir'
-- );

-- SELECT * FROM students1 WHERE name LIKE '%a';

-- SELECT * FROM students1 WHERE email LIKE '%example%';

-- SELECT * FROM students1 WHERE LENGTH(name) = 5;

-- SELECT * FROM students1 ORDER BY age DESC LIMIT 5;

-- SELECT * FROM students1 LIMIT 5 OFFSET 5;

-- CREATE VIEW teen_students AS
-- SELECT *
-- FROM students1
-- WHERE age BETWEEN 13 AND 19;

-- DROP VIEW teen_students;