<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Student.php';
    require_once __DIR__.'/../src/Course.php';

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request; Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->get('/student-list', function() use ($app) {
        return $app['twig']->render('students.html.twig', array('students' => Student::getAll()));
    });

    $app->post('/add-student', function() use ($app) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $student = new Student($name, $date);
        $student->save();
        return $app['twig']->render('students.html.twig', array('students' => Student::getAll()));
    });

    $app->patch('/edit_student/{id}', function($id) use ($app) {
        $student = Student::find($id);
        $new_name = $_POST['new_name'];
        $student->update($new_name);
        return $app->redirect('/student-list');
    });

    $app->delete('/delete_student/{id}', function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();
        return $app->redirect('/student-list');
    });

    $app->post('/delete_all_students', function() use ($app) {
        Student::deleteAll();
        return $app->redirect('/');
    });

    $app->get('/student_page/{id}', function($id) use ($app) {
        $student = Student::find($id);
        return $app['twig']->render('student-page.html.twig', array('student' => $student, 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    });




    return $app;
?>
