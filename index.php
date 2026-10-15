<?php
// Database Connection
$host = 'localhost';
$db = 'it30b_lab_dbs';
$user ='root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host; dbname=$db; charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false
];

try{
    $pdo = new PDO($dsn,$user,$pass,$options);
}catch(PDOException $e){
    die("Database connection failed" . $e->getMessage());
}

// Session
session_start();

// Determin current section
$section = $_GET['section'] ?? 'students';

// CRUD Operations
$action = $_GET['action'] ?? '';


// Students


// Fetch students
if($section === 'students'){
    $stmt = $pdo->query("
        SELECT * 
        FROM students
        ORDER by student_id DESC
    ");

    $students = $stmt->fetchAll();
}

// Create Student
if($section==='students' && $action==='create'){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

<<<<<<< HEAD
        $firstName = trim($_POST['student_first_name'] ?? '');
        $lastName = trim($_POST['student_last_name'] ?? '');
        $course = trim($_POST['student_course'] ?? '');

        if($firstName !== '' && $lastName !=='' && $course!==''){

            $sql=("
                INSERT INTO students (
                    student_first_name,
                    student_last_name,
                    student_course
                )
                VALUES (?,?,?)
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $firstName,
                $lastName,
                $course
            ]);

            //$_SESSION['alert'] = 'Student Saved Successfully';

            header("Location: index.php?section=students");
            exit;

        }
    }

}

// Update Student
if($section==='students'&& $action==='update'){
    
    $studentId = (int) ($_GET['id'] ?? 0);

    // Retrieve Student Information
    $stmt =  $pdo->prepare("
        SELECT *
        FROM students
        WHERE student_id =?
    ");

    $stmt->execute([$studentId]);

    $student = $stmt->fetch();

    // Update Student Info 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $firstName = trim($_POST['student_first_name'] ?? '');
        $lastName = trim($_POST['student_last_name'] ?? '');
        $course = trim($_POST['student_course'] ?? '');

        if($firstName !== '' && $lastName !=='' && $course!==''){

            $sql=("
                UPDATE students
                SET
                    student_first_name=?,
                    student_last_name=?,
                    student_course =?
                WHERE student_id=?
            ");
=======
    // Update Student
if ($section === 'students' && $action === 'update') {

    $studentId = (int) ($_GET['id'] ?? 0);

    // Retrieve Student Info
    $stmt = $pdo->prepare("
        SELECT *
        FROM students
        WHERE student_id = ?
    ");

    $stmt->execute([$studentId]);

    $student = $stmt->fetch();

    if (!$student) {
        die("Student Not Found");
    }

    // Update student
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $firstName = trim($_POST['student_first_name'] ?? '');
        $lastName = trim($_POST['student_last_name'] ?? '');
        $course = trim($_POST['student_course'] ?? '');

        $sql = "
            UPDATE students
            SET
                student_first_name = ?,
                student_last_name = ?,
                student_course = ?
            WHERE student_id = ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $firstName,
            $lastName,
            $course,
            $studentId
        ]);

        header("Location: index.php?section=students");
        exit;
    }
}


// Fetch books
$books = $pdo->query("
    SELECT *
    FROM books
    ORDER BY book_id DESC
")->fetchAll();



// Create Book
if($section === 'books' && $action === 'create'){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $bookTitle = trim($_POST['book_title'] ?? '');
        $bookAuthor = trim($_POST['book_author'] ?? '');
        $bookCategory = trim($_POST['book_category'] ?? '');

        if ($title !== '' && $author !== '' && $category !== '') {

            $sql = "
                INSERT INTO books (
                    book_title,
                    book_author,
                    book_category
                )
                VALUES (?, ?, ?)
            ";
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
<<<<<<< HEAD
                $firstName,
                $lastName,
                $course,
                $studentId
            ]);

            $_SESSION['alert'] = 'Student Updated Successfully';

            header("Location: index.php?section=students");
            exit;

        }
    }

}


// Fetch books
if ($section === 'books') {

    $stmt = $pdo->query("
        SELECT *
        FROM books
        ORDER BY book_id DESC
    ");

    $books = $stmt->fetchAll();
}


// BOOKS CREATE
if ($section === 'books' && $action === 'create') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title    = trim($_POST['book_title'] ?? '');
        $author   = trim($_POST['book_author'] ?? '');
        $category = trim($_POST['book_category'] ?? '');

        if ($title !== '' && $author !== '' && $category !== '') {

            $stmt = $pdo->prepare("
                INSERT INTO books (
                    book_title,
                    book_author,
                    book_category
                )
                VALUES (?, ?, ?)
            ");

            $stmt->execute([
=======
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                $title,
                $author,
                $category
            ]);

            header("Location: index.php?section=books");
            exit;
        }
    }
}

<<<<<<< HEAD
// BOOKS UPDATE
=======

// Update Book
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
if ($section === 'books' && $action === 'update') {

    $bookId = (int) ($_GET['id'] ?? 0);

<<<<<<< HEAD
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title    = trim($_POST['book_title'] ?? '');
        $author   = trim($_POST['book_author'] ?? '');
        $category = trim($_POST['book_category'] ?? '');

        $stmt = $pdo->prepare("
            UPDATE books
            SET
                book_title = ?,
                book_author = ?,
                book_category = ?
            WHERE book_id = ?
        ");

        $stmt->execute([
            $title,
            $author,
            $category,
            $bookId
        ]);

        header("Location: index.php?section=books");
        exit;
    }

    $stmt = $pdo->prepare("
        SELECT *
        FROM books
        WHERE book_id = ?
    ");

    $stmt->execute([$bookId]);

    $book = $stmt->fetch();

    if (!$book) {
        die("Book not found.");
    }
}

// Fetch Borrow Records
if($section === 'borrow'){

    // Fetch Students for borrow form
    $stmt=$pdo->query("
=======
    $stmt = $pdo->prepare("
        SELECT *
        FROM books
        WHERE book_id = ?
    ");

    $stmt->execute([$bookId]);

    $book = $stmt->fetch();

    if (!$book) {
        die("Book Not Found");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = trim($_POST['book_title'] ?? '');
        $author = trim($_POST['book_author'] ?? '');
        $category = trim($_POST['book_category'] ?? '');

        $sql = "
            UPDATE books
            SET
                book_title = ?,
                book_author = ?,
                book_category = ?
            WHERE book_id = ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $title,
            $author,
            $category,
            $bookId
        ]);

        header("Location: index.php?section=books");
        exit;
    }
}


// Retrieve students for borrow form
if ($section === 'borrow') {

    $stmt = $pdo->prepare("
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
        SELECT
            student_id,
            student_first_name,
            student_last_name
        FROM students
<<<<<<< HEAD
        ORDER BY student_last_name,student_first_name
    ");

    $students  =  $stmt->fetchAll();

    // Fetch Books for borrow form
    $stmt=$pdo->query("
=======
        ORDER BY student_last_name, student_first_name
    ");

    $stmt->execute();

    $students = $stmt->fetchAll();


    // Retrieve books for borrow form
    $stmt = $pdo->prepare("
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
        SELECT
            book_id,
            book_title,
            book_author
        FROM books
<<<<<<< HEAD
        ORDER By book_title
    ");

    $books = $stmt->fetchAll();

    $stmt = $pdo->query("
        SELECT
            borrow.borrow_id,
            borrow.borrow_date,
            borrow.borrow_return_date,

            students.student_first_name,
            students.student_last_name,

            books.book_title,
            books.book_author

        FROM borrow

        INNER JOIN students
            ON borrow.student_id = students.student_id

        INNER JOIN books
            ON borrow.book_id = books.book_id

        ORDER BY borrow.borrow_id DESC
    ");

    $borrowRecords = $stmt->fetchAll();
}

// Borrow a book
if($section==='borrow' && $action==="create"){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $studentId = (int)($_POST['student_id'] ?? 0);
        $bookId = (int)($_POST['book_id'] ?? 0);

        if($studentId > 0  && $bookId >0){
=======
        ORDER BY book_title
    ");

    $stmt->execute();

    $books = $stmt->fetchAll();


    // Retrieve borrow records
    $stmt = $pdo->prepare("
        SELECT
            b.borrow_id,
            b.student_id,
            b.book_id,
            b.borrow_date,
            b.borrow_return_date,
            s.student_first_name,
            s.student_last_name,
            bk.book_title
            
        FROM borrow b
        INNER JOIN students s
            ON b.student_id = s.student_id
        INNER JOIN books bk
            ON b.book_id = bk.book_id
        ORDER BY b.borrow_id DESC
    ");

    $stmt->execute();

    $borrows = $stmt->fetchAll();
}


// Create Borrow
if ($section === 'borrow' && $action === 'create') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $studentId = (int) ($_POST['student_id'] ?? 0);
        $bookId = (int) ($_POST['book_id'] ?? 0);

        if ($studentId > 0 && $bookId > 0) {
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c

            // Check if student has an unreturned book
            $stmt = $pdo->prepare("
                SELECT borrow_id
                FROM borrow
<<<<<<< HEAD
                WHERE  student_id=?
                    AND borrow_return_date is NULL
=======
                WHERE student_id = ?
                AND borrow_return_date IS NULL
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                LIMIT 1
            ");

            $stmt->execute([$studentId]);
<<<<<<< HEAD
            $studentBorrow = $stmt->fetch();

            if($studentBorrow){
                $_SESSION['alert'] = 'This student cannot borrow another book because a previous book has not been returned';
            } else {

                // Check if book is already returned
                $stmt = $pdo->prepare("
                    SELECT borrow_id
                    FROM borrow
                    WHERE book_id=?
                        AND borrow_return_date is NULL
=======

            $studentBorrow = $stmt->fetch();

            if ($studentBorrow) {

                $_SESSION['alert'] =
                    'This student cannot borrow another book because a previous book has not been returned.';

            } else {

                // Check if book is already borrowed
                $stmt = $pdo->prepare("
                    SELECT borrow_id
                    FROM borrow
                    WHERE book_id = ?
                    AND borrow_return_date IS NULL
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                    LIMIT 1
                ");

                $stmt->execute([$bookId]);
<<<<<<< HEAD
                $bookBorrow = $stmt->fetch();

                if($bookBorrow){
                    $_SESSION['alert'] = 'This book cannot be borrowed because it has not been returned';
                }else{

                    // Create borrow record finally 
                    $stmt = $pdo->prepare("
                        INSERT INTO borrow(
=======

                $bookBorrow = $stmt->fetch();

                if ($bookBorrow) {

                    $_SESSION['alert'] =
                        'This book is currently borrowed by another student.';

                } else {

                    // Create borrow record
                    $stmt = $pdo->prepare("
                        INSERT INTO borrow (
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                            student_id,
                            book_id
                        )
                        VALUES (?, ?)
                    ");

                    $stmt->execute([
                        $studentId,
                        $bookId
                    ]);

<<<<<<< HEAD
                    $_SESSION['alert'] = 'Book borrowed successfully';
=======
                    $_SESSION['alert'] =
                        'Book borrowed successfully.';
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                }
            }

            header("Location: index.php?section=borrow");
            exit;
        }

    }
}


if ($section === 'borrow' && $action === 'return') {

    $borrowId = (int) ($_GET['id'] ?? 0);

    if ($borrowId > 0) {

        $stmt = $pdo->prepare("
            UPDATE borrow
            SET borrow_return_date = NOW()
            WHERE borrow_id = ?
            AND borrow_return_date IS NULL
        ");

        $stmt->execute([$borrowId]);

        $_SESSION['alert'] = 'Book returned successfully.';
    }

    header("Location: index.php?section=borrow");
    exit;
}

}

// Return a book
if($section==='borrow' && $action==='return'){
    $borrowId = (int) ($_GET['id'] ??0);

    $stmt = $pdo->prepare("
        UPDATE borrow
        SET borrow_return_date = CURRENT_TIMESTAMP
        WHERE borrow_id = ?
    ");

    $stmt->execute([$borrowId]);

    $_SESSION['alert'] = "Book returned successfully.";

    header("Location: index.php?section=borrow");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
</head>
<body>
    <h1>Simple Library System</h1>
    <nav>
        <a href="index.php?section=students">Students</a>
        <a href="index.php?section=books">Books</a>
        <a href="index.php?section=borrow">Borrow</a>
    </nav>
    <hr>
    <?php if($section==='students'): ?>
        <h1>Students</h1>
        <p>
            <a href="index.php?section=students&action=create">
                Add Student
            </a>
        </p>

        <?php if($action==='create'): ?>

            <h2>Add student</h2>

            <form method="POST">
                <p>
                    <label>First Name</label>
                    <br>
                    <input type="text"
                        name="student_first_name"
                        required
                    />
                </p>
                <p>
                    <label>Last Name</label>
                    <br>
                    <input type="text"
                        name="student_last_name"
                        required
                    />
                </p>
                
                <p>
                    <label>Course</label>
                    <br>
                    <input type="text"
                        name="student_course"
                        required
                    />
                </p>

                <button type="submit">
                    Save
                </button>

                <a href="index.php?section=students">
                    Cancel
                </a>
            </form>

        <?php elseif($action==='update'): ?>

            <h2>Update Student</h2>

            <form method="POST">
                <p>
                    <label>First Name</label>
                    <br>
                    <input type="text"
                        name="student_first_name"
                        value="<?=  htmlspecialchars($student['student_first_name'])?>"
                        required
                    />
                </p>
                <p>
                    <label>Last Name</label>
                    <br>
                    <input type="text"
                        name="student_last_name"
                        value="<?=  htmlspecialchars($student['student_last_name'])?>"
                        required
                    />
                </p>
                
                <p>
                    <label>Course</label>
                    <br>
                    <input type="text"
                        name="student_course"
                        value="<?=  htmlspecialchars($student['student_course'])?>"
                        required
                    />
                </p>

                <button type="submit">
                    Update
                </button>

                <a href="index.php?section=students">
                    Cancel
                </a>
            </form>

        <?php else: ?>

        <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Course</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $student): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($student['student_id']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($student['student_first_name']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($student['student_last_name']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($student['student_course']) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($student['student_created_at']) ?>
                            </td>
                            <td>
                                <a href="index.php?section=students&action=update&id=<?= $student['student_id'] ?>">Edit</a>
                                |
                                <a>Delete</a>
                            </td>

                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>

        <?php endif; ?>

    
    <?php endif; ?>

    <?php if($section==='books'): ?>

            <h2>Books</h2>

            <p>
                <a href="index.php?section=books&action=create">
                    Add Book
                </a>
            </p>

            <?php if ($action === 'create'): ?>

                <h3>Add Book</h3>

                <form method="POST">

                    <p>
                        <label>Title:</label><br>
                        <input
                            type="text"
                            name="book_title"
                            required
                        >
                    </p>

                    <p>
                        <label>Author:</label><br>
                        <input
                            type="text"
                            name="book_author"
                            required
                        >
                    </p>

                    <p>
                        <label>Category:</label><br>
                        <input
                            type="text"
                            name="book_category"
                            required
                        >
                    </p>

                    <button type="submit">
                        Save
                    </button>

                    <a href="index.php?section=books">
                        Cancel
                    </a>

                </form>

            <?php elseif ($action === 'update'): ?>

                <h3>Update Book</h3>

                <form method="POST">

                    <p>
                        <label>Title:</label><br>
                        <input
                            type="text"
                            name="book_title"
                            value="<?= htmlspecialchars($book['book_title']) ?>"
                            required
                        >
                    </p>

                    <p>
                        <label>Author:</label><br>
                        <input
                            type="text"
                            name="book_author"
                            value="<?= htmlspecialchars($book['book_author']) ?>"
                            required
                        >
                    </p>

                    <p>
                        <label>Category:</label><br>
                        <input
                            type="text"
                            name="book_category"
                            value="<?= htmlspecialchars($book['book_category']) ?>"
                            required
                        >
                    </p>

                    <button type="submit">
                        Update
                    </button>

                    <a href="index.php?section=books">
                        Cancel
                    </a>

                </form>

            <?php else: ?>

                <table border="1" cellpadding="8">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($books as $book): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($book['book_id']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($book['book_title']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($book['book_author']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($book['book_category']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($book['book_created_at']) ?>
                                </td>

                                <td>

                                    <a href="index.php?section=books&action=update&id=<?= $book['book_id'] ?>">
                                        Edit
                                    </a>

                                    |

                                    <a
                                        href="index.php?section=books&action=delete&id=<?= $book['book_id'] ?>"
                                        onclick="return confirm('Delete this book?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php endif; ?>


    <?php endif; ?>

<<<<<<< HEAD
    <?php if($section==='borrow'): ?>
        <h1>Borrow</h1>
        <p>
            <a href="index.php?section=borrow&action=create">
                Borrow a Book  
            </a>
        </p>

        <?php if($action==='create'):?>
            <h3>Borrow a Book</h3>

            <form method="POST">

                <label>Student</label>
                <br>
                <select name=student_id required>
                    <option value="">
                        -- Select Student--
                    </option>
                    <?php foreach($students as $student): ?>
                        <option value="<?= $student['student_id']?> ">
                            <?= htmlspecialchars(
                                $student['student_first_name']
                                .' '.
                                $student['student_last_name']
                            )?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <br>
                <br>

                <label>Book</label>
                <br>
                <select name=book_id required>
                    <option value="">
                        -- Select Book--
                    </option>
                    <?php foreach($books as $book): ?>
                        <option value="<?= $book['book_id']?> ">
=======
   <?php if($section === 'borrow'):?>
    <h1>Borrow</h1>
    <p>
        <a href="index.php?section=borrow&action=create">
            Borrow a Book
        </a>
    </p>

    <?php if ($action=='create'): ?>
        <h2>Borrow a Book</h2>

        <form method="POST">
            
                <label>Student:</label>
                <br>
                <select name="student_id" required>
                    <option value="">
                        -- Select Student --
                    </option>
                    <?php foreach($students as $student): ?>
                        <option value="<?=$student['student_id'] ?>">
                            <?=htmlspecialchars(
                            $student['student_first_name']
                             .' '. 
                            $student['student_last_name']
                            ) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <br>
            <br>
                <label>Book:</label>
                <br>
                <select name="book_id" required>
                    <option value="">
                        -- Select Book --
                    </option>
                    <?php foreach($books as $book): ?>
                        <option value="<?=($book['book_id']) ?> ">
>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
                            <?= htmlspecialchars(
                                $book['book_title']
                                .'-'.
                                $book['book_author']
<<<<<<< HEAD
                            )?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <br>
                <button type="submit">
                    Borrow
                </button

                <a href="index.php?section=borrow">
                    Cancel
                </a
            </form>



        <?php else: ?>

        <table border="1" cellpadding="8">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Book</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                <?php foreach ($borrowRecords as $borrow): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($borrow['borrow_id']) ?>
                        </td>

                        <td>

                            <?= htmlspecialchars(
                                $borrow['student_first_name']
                                . ' '
                                . $borrow['student_last_name']
                            ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars(
                                $borrow['book_title']
                            ) ?>

                            -
                            <?= htmlspecialchars(
                                $borrow['book_author']
                            ) ?>

                        </td>

                        <td>
                            <?= htmlspecialchars($borrow['borrow_date']) ?>
                        </td>

                        <td>

                            <?php if ($borrow['borrow_return_date']): ?>

                                <?= htmlspecialchars(
                                    $borrow['borrow_return_date']
                                ) ?>

                            <?php else: ?>

                                Not returned

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if ($borrow['borrow_return_date']): ?>

                                Returned

                            <?php else: ?>

                                Borrowed

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if (!$borrow['borrow_return_date']): ?>

                                <a
                                    href="index.php?section=borrow&action=return&id=<?= $borrow['borrow_id'] ?>"
                                    onclick="return confirm('Mark this book as returned?');"
                                >
                                    Return
                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
        <?php endif;?>



    <?php endif; ?>
    
=======
                            )?> 
                        </option>
                    <?php endforeach; ?>
                </select>
            <br>

            <button type="submit">
                Borrow
            </button>

            <a href="index.php?section=borrow">
                Cancel
            </a
        </form>

    <?php else: ?>
        <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Borrow ID</th>
                <th>Student</th>
                <th>Book</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
           <?php
             $borrows = $borrows ?? [];
                 foreach ($borrows as $br):
                                          ?>
                <tr>
                    <td><?=htmlspecialchars($br['borrow_id']) ?></td>
                    <td>
                        <?=htmlspecialchars($br['student_first_name'] . ' ' . $br['student_last_name']) ?>
                    </td>
                    <td>
                        <?=htmlspecialchars($br['book_title']) ?>
                    </td>
                    <td><?=htmlspecialchars($br['borrow_date']) ?></td>
                    <td>
                        <?=htmlspecialchars($br['borrow_return_date'] ?? 'Not returned') ?>
                    </td>
                    <td>
                        <?php if($br['borrow_return_date']): ?>
                            Returned
                        <?php else: ?>
                            Borrowed
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!$br['borrow_return_date']): ?>
                            <a href="index.php?section=borrow&action=return&id=<?=htmlspecialchars($br['borrow_id']) ?>">
                                Return
                            </a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>

<?php endif; ?>

>>>>>>> 62a7e5c6315d79b1ac434585316ebb06a808879c
</body>

<?php if (isset($_SESSION['alert'])): ?>

    <script>
        alert(<?=json_encode($_SESSION['alert'])?>);
    </script>

    <?php unset($_SESSION['alert']); ?>

<?php endif; ?>
</html>