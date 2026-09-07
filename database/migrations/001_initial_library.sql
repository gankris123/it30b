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
