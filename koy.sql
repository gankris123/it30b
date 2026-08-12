CREATE TABLE student (
    Student_id INT AUTO_INCREMENT PRIMARY KEY,
    Student_name VARCHAR(100) NOT NULL,
    Course VARCHAR(100),
    Year_level INT
);


CREATE TABLE borrow (
    Borrow_id INT AUTO_INCREMENT PRIMARY KEY,
    Student_id INT NOT NULL,
    Book_id INT NOT NULL,
    Borrow_date DATE NOT NULL,
    Return_date DATE,

    FOREIGN KEY (Student_id) REFERENCES student(Student_id),
    FOREIGN KEY (Book_id) REFERENCES book(Book_id)
);


CREATE TABLE book (
    Book_id INT AUTO_INCREMENT PRIMARY KEY,
    Book_title VARCHAR(150) NOT NULL,
    Author VARCHAR(100),
    Published_year YEAR
);