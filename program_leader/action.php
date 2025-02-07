<?php
session_start();
include("../include/database.php");

// This file is used to handle the action of the program leader

// Load lecturer list
if (isset($_POST["lecturer"])) {
    $lecturers = [];

    if (isset($_POST['search']) || isset($_POST['sort']) || isset($_POST['filter'])) {
        $query = isset($_POST['search']) ? $_POST['query'] : (isset($_POST['sort']) ? $_POST['query'] : $_POST['data']); // Fetch query

        if (isset($_POST['search'])) {
            // Search lecturer under the department
            $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' AND (name LIKE '%$query%' OR email LIKE '%$query%') ORDER BY name";
            $result = mysqli_query($connection, $lecturer);
        } elseif (isset($_POST['sort'])) {
            // Sort lecturer under the department
            $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' ORDER BY $query, name";
            $result = mysqli_query($connection, $lecturer);
        } elseif (isset($_POST['filter'])) {
            // Filter lecturer under the department
            $conditions = implode(" AND ", $query);
            $lecturer = "SELECT * FROM lecturer WHERE department = '" . $_SESSION['department'] . "' AND ($conditions) ORDER BY name";
            $result = mysqli_query($connection, $lecturer);
        }
    } else {
        // Retrieve all lecturers under the same department as the program leader
        $lecturer = 'SELECT * FROM lecturer WHERE department = "' . $_SESSION['department'] . '" ORDER BY name';
        $result = mysqli_query($connection, $lecturer);
    }

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty"; // Return empty
        } else {
            while ($lecturerinfo = mysqli_fetch_assoc($result)) {
                $lecturers[] = $lecturerinfo; // Store the lecturer information in an array
            }
            header('Content-Type: application/json');
            echo json_encode($lecturers);
        }
    } else {
        echo "error";
    }
}

// Load student list
if (isset($_POST["student"])) {
    $programmeCode = [];
    $students = [];

    // Get the programme the register under the program leader
    $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($connection, $programme);

    while ($programmeinfo = mysqli_fetch_assoc($result)) {
        $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
    }

    if (isset($_POST['search']) || isset($_POST['sort']) || isset($_POST['filter'])) {
        $query = isset($_POST['search']) ? $_POST['query'] : (isset($_POST['sort']) ? $_POST['query'] : $_POST['data']);  // Fetch query

        if (isset($_POST['search'])) {
            foreach ($programmeCode as $code) { // Search student under the programme code
                $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' AND (student.student_id LIKE '%$query%' OR student.name LIKE '%$query%' OR student.email LIKE '%$query%') ORDER BY student.name";
                $result = mysqli_query($connection, $student);
            }
        } elseif (isset($_POST['sort'])) {
            foreach ($programmeCode as $code) { // Sort student under the programme code
                $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' ORDER BY $query, student.name";
                $result = mysqli_query($connection, $student);
            }
        } elseif (isset($_POST['filter'])) {
            $conditions = implode(" AND ", $query);
            foreach ($programmeCode as $code) { // Filter student under the programme code
                $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' AND ($conditions) ORDER BY student.name";
                $result = mysqli_query($connection, $student);
            }
        }
    } else {
        foreach ($programmeCode as $code) {
            $student = "SELECT student.*, programme.name AS programme FROM student INNER JOIN programme ON student.programme = programme.code WHERE student.programme = '$code' ORDER BY name";
            $result = mysqli_query($connection, $student);
        }
    }

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty"; // Return empty
        } else {
            while ($studentinfo = mysqli_fetch_assoc($result)) {
                $students[] = $studentinfo; // Store the student information in an array
            }
            header('Content-Type: application/json');
            echo json_encode($students);
        }
    } else {
        echo "error";
    }
}

// Load course list
if (isset($_POST["course"])) {
    $programmeCode = [];
    $courses = [];

    // Get the programme the register under the program leader
    $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($connection, $programme);

    while ($programmeinfo = mysqli_fetch_assoc($result)) {
        $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
    }

    if (isset($_POST['search']) || isset($_POST['filter'])) {
        $query = isset($_POST['search']) ? $_POST['query'] : $_POST['data'];  // Fetch query

        if (isset($_POST['search'])) {
            foreach ($programmeCode as $code) { // Search course under the programme code
                $course = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code WHERE course.programme = '$code' AND (course.code LIKE '%$query%' OR course.name LIKE '%$query%') ORDER BY course.name";
                $result = mysqli_query($connection, $course);
            }
        } elseif (isset($_POST['filter'])) {
            $conditions = implode(" AND ", $query);
            foreach ($programmeCode as $code) { // Filter course under the programme code
                $course = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code WHERE course.programme = '$code' AND ($conditions) ORDER BY course.name";
                $result = mysqli_query($connection, $course);
            }
        }
    } else {
        foreach ($programmeCode as $code) {
            // Get the course info registered under the programme
            $course = "SELECT course.*, course_category.image FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code WHERE course.programme = '$code' ORDER BY course.name";
            $result = mysqli_query($connection, $course);
        }
    }

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";  // Return empty
        } else {
            while ($courseinfo = mysqli_fetch_assoc($result)) {
                $courses[] = $courseinfo; // Store the course information in an array
            }
            header('Content-Type: application/json');
            echo json_encode($courses);
        }
    } else {
        echo "error";
    }
}

// Load course offered
if (isset($_POST["courseoffered"])) {
    $programmeCode = [];
    $courses = [];
    $currentdate = $_POST['currentdate'];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Get the programme the register under the program leader
    $programme = "SELECT * FROM programme WHERE program_leader = '" . $_SESSION['id'] . "'";
    $result = mysqli_query($connection, $programme);

    while ($programmeinfo = mysqli_fetch_assoc($result)) {
        $programmeCode[] = $programmeinfo['code']; // Store the programme code in an array
    }

    if (isset($_POST['search']) || isset($_POST['filter'])) {
        $query = isset($_POST['search']) ? $_POST['query'] : $_POST['data'];  // Fetch query

        if (isset($_POST['search'])) {
            foreach ($programmeCode as $code) { // Search course under the programme code
                $offered = "SELECT course.code, course.name, course.credit_hour, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND (course.code LIKE '%$query%' OR course.name LIKE '%$query%') AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
                $result = mysqli_query($connection, $offered);
            }
        } elseif (isset($_POST['filter'])) {
            $conditions = implode(" AND ", $query);
            foreach ($programmeCode as $code) { // Filter course under the programme code
                $offered = "SELECT course.code, course.name, course.credit_hour, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND ($conditions) AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
                $result = mysqli_query($connection, $offered);
            }
        }
    } else {
        foreach ($programmeCode as $code) {
            // Get the course info offered under the programme
            $offered = "SELECT course.code, course.name, course.credit_hour, course_category.image, course_offer.id FROM course INNER JOIN course_category ON SUBSTRING(course.code,1,3) = course_category.code INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course.programme = '$code' AND course.code = course_offer.course_code AND course_offer.semester = '" . $semesterid['id'] . "' ORDER BY course.name";
            $result = mysqli_query($connection, $offered);
        }
    }

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";  // Return empty
        } else {
            while ($courseinfo = mysqli_fetch_assoc($result)) {
                $courses[] = $courseinfo; // Store the course information in an array
            }
            header('Content-Type: application/json');
            echo json_encode($courses);
        }
    } else {
        echo "error";
    }
}

// Offer course
if (isset($_POST["offer"])) {
    $coursecode = $_POST["coursecode"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Add course into the course offer table
    $offer = "INSERT INTO course_offer(course_code, semester) VALUES('$coursecode','" . $semesterid["id"] . "')";
    $result = mysqli_query($connection, $offer);
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

// Remove course offered
if (isset($_POST["remove"])) {
    $offerid = $_POST["offerid"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Add course into the course offer table
    $remove = "DELETE FROM  course_offer WHERE id = '$offerid' AND semester = '" . $semesterid["id"] . "'";
    $result = mysqli_query($connection, $remove);
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

// Select lecturer for course offered
if (isset($_POST["select"])) {
    $lecturerid = $_POST["lecturerid"];
    $offerid = $_POST["offerid"];

    // Get the cours name of the current course
    $course = "SELECT course.name FROM course INNER JOIN course_offer ON course.code = course_offer.course_code WHERE course_offer.id = '$offerid'";
    $result = mysqli_query($connection, $course);
    $coursename = mysqli_fetch_assoc($result);

    // Get the name of the selected lecturer
    $lecturer = "SELECT name FROM lecturer WHERE id = '$lecturerid'";
    $result = mysqli_query($connection, $lecturer);
    $lecturername = mysqli_fetch_assoc($result);

    if (isset($lecturername) && isset($coursename)) {
        $response = [];
        $response[] = $lecturername["name"];
        $response[] = $coursename["name"];

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        echo "error";
    }
}

// Assign lecturer for course offered
if (isset($_POST["assign"])) {
    $lecturerid = $_POST["lecturerid"];
    $offerid = $_POST["offerid"];

    // Assign lecturer to current course
    $assign = "UPDATE course_offer SET lecturer = '$lecturerid' WHERE id = '$offerid'";
    $result = mysqli_query($connection, $assign);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

// Load lecturer for course offered
if (isset($_POST["load"])) {
    $offerid = $_POST["offerid"];

    // Get lecturer assined to current course
    $lecturer = "SELECT lecturer.* FROM lecturer INNER JOIN course_offer on lecturer.id = course_offer.lecturer WHERE course_offer.id = '$offerid'";
    $result = mysqli_query($connection, $lecturer);
    $lecturer = mysqli_fetch_assoc($result);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty";
        } else { // If lecturer assigned
            $response = [];
            $response[] = $lecturer['name'];
            $response[] = $lecturer['gender'];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        echo "error";
    }
}

// Load student under course offered
if (isset($_POST["enrolment"])) {
    $students = [];
    $offerid = $_POST["offerid"];
    $currentdate = $_POST["currentdate"];

    // Get the semester id based on current date
    $semester = "SELECT id FROM semester WHERE start < '$currentdate' AND end > '$currentdate'";
    $result = mysqli_query($connection, $semester);
    $semesterid = mysqli_fetch_assoc($result);

    // Get the course code of the offer id
    $coursecode = "SELECT course_code FROM course_offer WHERE id = '$offerid'";
    $result = mysqli_query($connection, $coursecode);
    $coursecode = mysqli_fetch_assoc($result);

    // Get the student enrolled in the course
    $enrolment = "SELECT student.* FROM student INNER JOIN enrolment ON student.id = enrolment.student_id WHERE enrolment.student_id = student.id AND enrolment.semester = '" . $semesterid["id"] . "' AND enrolment.course_code = '" . $coursecode["course_code"] . "'";
    $result = mysqli_query($connection, $enrolment);

    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            echo "empty"; // Return empty
        } else {
            while ($studentinfo = mysqli_fetch_assoc($result)) {
                $students[] = $studentinfo; // Store the student information in an array
            }
            header('Content-Type: application/json');
            echo json_encode($students);
        }
    } else {
        echo "error";
    }
}
