<?php
    class Course
    {
        private $id;
        private $course_name;
        private $course_number;

        function __construct($course_name, $course_number, $id = null)
        {
            $this->course_name = $course_name;
            $this->course_number = $course_number;
            $this->id = $id;
        }
//getters & setters
        function getId()
        {
            return $this->id;
        }
        function getCourseName()
        {
            return $this->course_name;
        }
        function setCourseName($new_course_name)
        {
            $this->course_name = (string) $new_course_name;
        }
        function getCourseNumber()
        {
            return $this->course_number;
        }

        //methods
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (course_name, course_number) VALUES ('{$this->getCourseName()}', '{$this->getCourseNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStudents($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
                JOIN students_courses ON (students_courses.course_id = courses.id)
                JOIN students ON (students.id = students_courses.student_id)
                WHERE courses.id = {$this->getId()};");

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


        // function update($new_course_status)
        // {
        //     $GLOBALS['DB']->exec("UPDATE courses SET course_status = '{$new_course_status}' WHERE id = {$this->getId()};");
        //     $this->setFlightStatus($new_course_status);
        // }
        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        // }
        // static function find($search_id)
        // {
        //     $found_course = null;
        //     $courses = Flight::getAll();
        //     foreach($courses as $course) {
        //         $course_id = $course->getId();
        //         if ($course_id == $search_id) {
        //             $found_course = $course;
        //         }
        //     }
        //    return $found_course;
        // }
        // function addFlightCities($city1, $city2)
        // {
        //     $GLOBALS['DB']->exec("INSERT INTO cities_courses (departure_city_id, arrival_city_id, course_id) VALUES ({$city->getId()}, {$city->getId()}, {$this->getId()});");
        // }

//static methods
        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
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

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM courses;");
        }
    }
?>
