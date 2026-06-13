create table students(
    id int primary key auto_increment,
    name varchar(255),
    email varchar(100),
    created_at datetime,
    update_at datetime
);


create table Schools(
    id int primary key auto_increment,
    Name varchar(150),
    Email varchar(150),
    Phone varchar(50),
    Address text
);

insert into Schools (Name,Email,Phone,Address)values("Dhaka polytechnic institute","abcd@gmail.com","00086745","Dhaka"),("chadpur polytechnic institute","abcd@gmail.com","00086745","chadpur")

create table Doctors(
    id int primary key auto_increment,
    name varchar(150),
    designation varchar(100),
    phone varchar(50)
);

create table Employees(
    id int primary key auto_increment,
    name varchar(100),
    designation varchar(50),
    department varchar(50),
    basic_salary decimal(10,2),
    sales_amount decimal(10,2),
    commission_rate decimal(5,2),
    promotion_date date,
    joining_data date 
);

insert into Employees
(name,designation,department,basic_salary,sales_amount,commission_rate,promotion_date,joining_data)
values

("Nusrat", "Sales Executive", "Sales", 28000, 1200000, 250, "2024-03-15", "2021-07-12");

("Rahim", "Marketing Officer", "Marketing", 30000, 850000, 1800, "2023-11-20", "2020-05-18"),

("Sadia", "Sales Manager", "Sales", 45000, 2000000, 5000, "2025-01-10", "2019-08-25"),

("Tanvir", "HR Executive", "HR", 32000, 0, 0, "2024-06-01", "2022-02-14"),

("Mim", "Accountant", "Accounts", 35000, 0, 0, "2023-09-05", "2021-11-30");
