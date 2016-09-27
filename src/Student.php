<?php
    class Student
    {
        private $id;
        private $name;
        private $enrollment_date;

        function __construct($name, $enrollment_date, $id = null)
        {
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
            $this->id = $id;
        }
//getters & setters
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }
        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }
        function setEnrollmentDate($new_enrollment_date)
        {
            $this->enrollment_date = (string) $new_enrollment_date;
        }
//methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollmentDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addCourses($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");
        }

        function getCourses()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM students
                JOIN students_courses ON (students_courses.student_id = students.id)
                JOIN courses ON (courses.id = students_courses.course_id)
                WHERE students.id = {$this->getId()};");

            $courses = array();

            foreach($returned_courses as $course) {
                $course_name = $course['course_name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($course_name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        // function update($new_student_status)
        // {
        //     $GLOBALS['DB']->exec("UPDATE students SET student_status = '{$new_student_status}' WHERE id = {$this->getId()};");
        //     $this->setFlightStatus($new_student_status);
        // }
        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        // }
        // static function find($search_id)
        // {
        //     $found_student = null;
        //     $students = Flight::getAll();
        //     foreach($students as $student) {
        //         $student_id = $student->getId();
        //         if ($student_id == $search_id) {
        //             $found_student = $student;
        //         }
        //     }
        //    return $found_student;
        // }
        // function addFlightCities($city1, $city2)
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO cities_students (departure_city_id, arrival_city_id, student_id) VALUES ({$city->getId()}, {$city->getId()}, {$this->getId()});");
        // }

//static methods
        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM students;");
        }
    }
?>
