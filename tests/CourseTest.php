<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class courseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
        }
// Test your getters and setters.
        function test_getCourseName()
        {
            //Arrange
            // no need to pass in id because it is null by default.
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            //Act
            $result = $test_course->getCourseName();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in course name.
            $this->assertEquals($course_name, $result);
        }
        function test_setName()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $new_course_name = "Eastern European History";
            //Act
            $test_course->setCourseName($new_course_name);
            $result = $test_course->getCourseName();
            //Assert
            $this->assertEquals($new_course_name, $result);
        }

        function test_getCourseNumber()
        {
            //Arrange
            // no need to pass in id because it is null by default.
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            //Act
            $result = $test_course->getCourseNumber();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in enrollment date.
            $this->assertEquals($course_number, $result);
        }


        function test_getId()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $id = 1;
            $test_course = new Course($course_name, $course_number, $id);
            //Act
            $result = $test_course->getId();
            //Assert
            $this->assertEquals($id, $result); //make sure id returned is the one we put in, not null.
        }

        function test_save()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();
            //Act
            $result = course::getAll();
            //Assert
            $this->assertEquals($test_course, $result[0]);
        }

        function test_getAll()
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
            //Act
            $result = Course::getAll();
            //Assert
            $this->assertEquals([$test_course, $test_course1], $result);
        }

        function test_getAllStudents()
        {
            //Arrange
            // create more than one course to make sure getAll returns them all.
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $name = "KatyCodes";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name1 = "April";
            $enrollment_date1 = "2016-09-25";
            $test_student1 = new Student($name1, $enrollment_date1);
            $test_student1->save();
            $test_course->addStudents($test_student);

            //Act
            $result = $test_course->getStudents();
            //Assert
            $this->assertEquals([$test_student], $result);
        }
        // function testUpdate()
        // {
        //     //Arrange
        //     $course_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $course_status = "ON-TIME";
        //     $test_course = new course($course_number, $departure_time, $course_status);
        //     $test_course->save();
        //     $new_course_status = "DELAYED";
        //     //Act
        //     $test_course->update($new_course_status);
        //     //Assert
        //     $this->assertEquals("DELAYED", $test_course->getcourseStatus());
        // }
        // function testDelete()
        // {
        //     //Arrange
        //     $course_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $course_status = "ON-TIME";
        //     $test_course = new course($course_number, $departure_time, $course_status);
        //     $test_course->save();
        //     $course_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $course_status2 = "DELAYED";
        //     $test_course2 = new course($course_number2, $departure_time2, $course_status2);
        //     $test_course2->save();
        //     //Act
        //     $test_course->delete();
        //     $result = course::getAll();
        //     //Assert
        //     $this->assertEquals([$test_course2], $result);
        // }
        // function testFind()
        // {
        //     //Arrange
        //     $course_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $course_status = "ON-TIME";
        //     $test_course = new course($course_number, $departure_time, $course_status);
        //     $test_course->save();
        //     $course_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $course_status2 = "DELAYED";
        //     $test_course2 = new course($course_number2, $departure_time2, $course_status2);
        //     $test_course2->save();
        //     //Act
        //     $result = course::find($test_course->getId());
        //     //Assert
        //     $this->assertEquals($test_course, $result);
        // }
        // function test_addcourseCities()
        // {
        //     //Arrange
        //    $name = "Work stuff";
        //    $id = 1;
        //    $test_category = new Category($name, $id);
        //    $test_category->save();
        //    $description = "File reports";
        //    $id2 = 2;
        //    $test_task = new Task($description, $id2);
        //    $test_task->save();
        //    //Act
        //    $test_category->addTask($test_task);
        //    //Assert
        //    $this->assertEquals($test_category->getTasks(), [$test_task]);
        // }

        // function test_deleteAll()
        // {
        //     //Arrange
        //     // create more than one course
        //     $course_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $course_status = "ON-TIME";
        //     $test_course = new course($course_number, $departure_time, $course_status);
        //     $test_course->save();
        //     $course_number2 = "GUT456";
        //     $departure_time2 = "12:45:00";
        //     $course_status2 = "DELAYED";
        //     $test_course2 = new course($course_number2, $departure_time2, $course_status2);
        //     $test_course2->save();
        //     //Act
        //     course::deleteAll(); // delete them.
        //     $result = course::getAll(); // get all to make sure they are gone.
        //     //Assert
        //     $this->assertEquals([], $result);
        // }
    }
?>
