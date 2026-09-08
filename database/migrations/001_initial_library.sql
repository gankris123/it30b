-- #1 students table 
CREATE TABLE IF NOT EXISTS students (
  -- Primary key for the students table
     student_id INT PRIMARY KEY AUTO_INCREMENT,

        --Student name
        student_first_name VARCHAR(50) NOT NULL,
        student_last_name VARCHAR(50) NOT NULL,
        
        --student course
        student_course VARCHAR(50) NOT NULL,
       
        --student created at timestamp
        student_created_at TIMESTAMP NOT NULL
        DEFAULT CURRENT_TIMESTAMP

)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

-- #2 books table
CREATE TABLE IF NOT EXISTS books (
  -- Primary key for the books table
     book_id INT PRIMARY KEY AUTO_INCREMENT,

-- Book details
book_title VARCHAR(100) NOT NULL,
book_author VARCHAR(100) NOT NULL,
book_category VARCHAR(50) NOT NULL,
-- Book created at timestamp
book_created_at TIMESTAMP NOT NULL
DEFAULT CURRENT_TIMESTAMP

)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;  

-- #3 borrow table 
CREATE TABLE IF NOT EXISTS borrow (
    -- Primary key for the borrow table
    borrow_id INT AUTO_INCREMENT PRIMARY_KEY,

    -- Foreign key references
student_id INT NOT NULL,
book_id INT NOT NULL,
-- Borrow Timestamp not null by default 
borrow_date TIMESTAMP NOT NULL
DEFAULT CURRENT_TIMESTAMP 
-- Borrow return timestamp null by default 
borrow_return_date TIMESTAMP NULL
DEFAULT NULL,

--Borrow table constraints and foreign keys
CONSTRAINT fk_borrow
    FOREIGN KEY (student_id)
    REFERENCES students(students_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

CONSTRAINT fk_borrow_book
    FOREIGN KEY (book_id)
    REFERENCES books(book_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT

)ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;  