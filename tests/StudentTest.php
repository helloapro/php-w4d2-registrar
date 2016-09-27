<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }
// Test your getters and setters.
        function test_getName()
        {
            //Arrange
            // no need to pass in id because it is null by default.
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            //Act
            $result = $test_student->getName();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in student name.
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //Arrange
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $new_name = "helloapro";
            //Act
            $test_student->setName($new_name);
            $result = $test_student->getName();
            //Assert
            $this->assertEquals($new_name, $result);
        }

        function test_getEnrollmentDate()
        {
            //Arrange
            // no need to pass in id because it is null by default.
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            //Act
            $result = $test_student->getEnrollmentDate();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in enrollment date.
            $this->assertEquals($enrollment_date, $result);
        }

        function test_setEnrollmentDate()
        {
            //Arrange
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $new_enrollment_date = "2016-09-22";
            //Act
            $test_student->setEnrollmentDate($new_enrollment_date);
            $result = $test_student->getEnrollmentDate();
            //Assert
            $this->assertEquals($new_enrollment_date, $result);
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date, $id);
            //Act
            $result = $test_student->getId();
            //Assert
            $this->assertEquals($id, $result); //make sure id returned is the one we put in, not null.
        }

        function test_save()
        {
            //Arrange
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals($test_student, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            // create more than one student to make sure getAll returns them all.
            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "helloapro";
            $enrollment_date2 = "2016-04-11";
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function test_getAllCourses()
        {
            //Arrange
            // create more than one course to make sure getAll returns them all.
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $course_name1 = "Math";
            $course_number1 = "MT101";
            $test_course1 = new Course($course_name, $course_number);
            $test_course1->save();

            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            $test_student->addCourses($test_course);


            //Act
            $result = $test_student->getCourses();
            //Assert
            $this->assertEquals([$test_course], $result);
        }

        // function testUpdate()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     $test_student->save();
        //     $new_student_status = "DELAYED";
        //     //Act
        //     $test_student->update($new_student_status);
        //     //Assert
        //     $this->assertEquals("DELAYED", $test_student->getStudentStatus());
        // }
        // function testDelete()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     $test_student->save();
        //     $student_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $student_status2 = "DELAYED";
        //     $test_student2 = new Student($student_number2, $departure_time2, $student_status2);
        //     $test_student2->save();
        //     //Act
        //     $test_student->delete();
        //     $result = Student::getAll();
        //     //Assert
        //     $this->assertEquals([$test_student2], $result);
        // }
        // function testFind()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     $test_student->save();
        //     $student_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $student_status2 = "DELAYED";
        //     $test_student2 = new Student($student_number2, $departure_time2, $student_status2);
        //     $test_student2->save();
        //     //Act
        //     $result = Student::find($test_student->getId());
        //     //Assert
        //     $this->assertEquals($test_student, $result);
        // }

        // function test_deleteAll()
        // {
        //     //Arrange
        //     // create more than one student
        //     $student_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     $test_student->save();
        //     $student_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $student_status2 = "DELAYED";
        //     $test_student2 = new Student($student_number2, $departure_time2, $student_status2);
        //     $test_student2->save();
        //     //Act
        //     Student::deleteAll(); // delete them.
        //     $result = Student::getAll(); // get all to make sure they are gone.
        //     //Assert
        //     $this->assertEquals([], $result);
        // }
    }
?>
