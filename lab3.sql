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

SELECT br.borrow_id, s.student_id,
CONCAT(s.student_first_name, ' ',s.student_last_name) AS student_name, s.student_course,
b.book_title, b.book_author, b.book_category,
br.borrow_date,br.borrow_return_date
FROM borrow br
   JOIN students s ON br.student_id = s.student_id
   JOIN books b ON br.book_id = b.book_id;
WHERE br.borrow_return_date IS NULL
ORDER BY br.borrow_date DESC;

ALTER TABLE borrow
MODIFY borrow_return_date TIMESTAMP NULL DEFAULT NULL;

UPDATE borrow
SET borrow_return_date = NULL
WHERE borrow_return_date = '2026-08-25 19:47:06';

UPDATE borrow 
SET borrow_return_date = CURRENT_TIMESTAMP 

WHERE borrow_id = 1 AND borrow_return_date IS NULL;

SELECT br.borrow_id, s.student_id,
CONCAT(s.student_first_name, ' ',s.student_last_name) AS student_name,
b.book_title, b.book_author, b.book_category,
br.borrow_date,br.borrow_return_date
FROM borrow br
   JOIN students s ON br.student_id = s.student_id
   JOIN books b ON br.book_id = b.book_id;
WHERE br.borrow_return_date IS NOT NULL
ORDER BY br.borrow_date DESC;