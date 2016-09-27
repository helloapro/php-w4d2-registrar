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
            $name = "AUX345";
            $enrollment_date = "2016-09-06";
            $test_student = new Student($name, $enrollment_date);
            //Act
            $result = $test_student->getName();
            //Assert
            // id is null here, but that is not what we are testing. We are only interested in student number.
            $this->assertEquals($name, $result);
        }
        // function test_setStudentNumber()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $new_student_number = "GUT456";
        //     $departure_time = "11:23";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     //Act
        //     $test_student->setStudentNumber($new_student_number);
        //     $result = $test_student->getStudentNumber();
        //     //Assert
        //     $this->assertEquals($new_student_number, $result);
        // }
        // function test_getDepartureTime()
        // {
        //     //Arrange
        //     // no need to pass in id because it is null by default.
        //     $student_number = "AUX345";
        //     $departure_time = "11:23";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     //Act
        //     $result = $test_student->getDepartureTime();
        //     //Assert
        //     // id is null here, but that is not what we are testing. We are only interested in student number.
        //     $this->assertEquals($departure_time, $result);
        // }
        // function test_setDepartureTime()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23";
        //     $new_departure_time = "12:45";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     //Act
        //     $test_student->setDepartureTime($new_departure_time);
        //     $result = $test_student->getDepartureTime();
        //     //Assert
        //     $this->assertEquals($new_departure_time, $result);
        // }
        // function test_getStudentStatus()
        // {
        //     //Arrange
        //     // no need to pass in id because it is null by default.
        //     $student_number = "AUX345";
        //     $departure_time = "11:23";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     //Act
        //     $result = $test_student->getStudentStatus();
        //     //Assert
        //     // id is null here, but that is not what we are testing. We are only interested in student number.
        //     $this->assertEquals($student_status, $result);
        // }
        // function test_setStudentStatus()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23";
        //     $student_status = "ON-TIME";
        //     $new_student_status = "DELAYED";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     //Act
        //     $test_student->setStudentStatus($new_student_status);
        //     $result = $test_student->getStudentStatus();
        //     //Assert
        //     $this->assertEquals($new_student_status, $result);
        // }
        // function test_getId()
        // {
        //     //Arrange
        //     $id = 1;
        //     $student_number = "AUX345";
        //     $departure_time = "11:23";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status, $id);
        //     //Act
        //     $result = $test_student->getId();
        //     //Assert
        //     $this->assertEquals($id, $result); //make sure id returned is the one we put in, not null.
        // }
        // function test_save()
        // {
        //     //Arrange
        //     $student_number = "AUX345";
        //     $departure_time = "11:23:00";
        //     $student_status = "ON-TIME";
        //     $test_student = new Student($student_number, $departure_time, $student_status);
        //     $test_student->save();
        //     //Act
        //     $result = Student::getAll();
        //     //Assert
        //     $this->assertEquals($test_student, $result[0]);
        // }
        // function test_getAll()
        // {
        //     //Arrange
        //     // create more than one student to make sure getAll returns them all.
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
        //     $result = Student::getAll();
        //     //Assert
        //     $this->assertEquals([$test_student, $test_student2], $result);
        // }
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
        // function test_addStudentCities()
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
