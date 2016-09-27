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
        function testUpdate()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();
            $new_course = "Middle East History";
            //Act
            $test_course->update($new_course);
            //Assert
            $this->assertEquals("Middle East History", $test_course->getCourseName());
        }
        function testDelete()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $course_name2 = "History2";
            $course_number2 = "HIS102";
            $test_course2 = new Course($course_name2, $course_number2);
            $test_course2->save();
            //Act
            $test_course->delete();
            $result = Course::getAll();
            //Assert
            $this->assertEquals([$test_course2], $result);
        }
        function testFind()
        {
            //Arrange
            $course_name = "History";
            $course_number = "HIS101";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $course_name2 = "History2";
            $course_number2 = "HIS102";
            $test_course2 = new Course($course_name2, $course_number2);
            $test_course2->save();
            //Act
            $result = Course::find($test_course->getId());
            //Assert
            $this->assertEquals($test_course, $result);
        }
        
   }
?>
