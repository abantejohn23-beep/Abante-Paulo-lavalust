<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * StudentController
 * ------------------------------------------------------------------
 * Laboratory Activity: LavaLust Routing, Controllers, Views, and
 * Middleware.
 *
 * Handles the Halloween-themed "Student Info" pages:
 *   - index()   -> /student           (Student home / haunted gate)
 *   - profile() -> /student/profile   (Student profile, protected by
 *                                       StudentMiddleware)
 * ------------------------------------------------------------------
 */
class StudentController extends Controller
{
    /**
     * GET /student
     *
     * Acts as the "gate" of the haunted hallway. Visiting this page
     * grants the visitor a session pass ($_SESSION['student_access'])
     * which StudentMiddleware checks before allowing entry to the
     * protected /student/profile route.
     *
     * @return void
     */
    public function index()
    {
        // Start the session if one isn't already running.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Grant a "haunted pass" for this visitor. This is the simple
        // access condition that StudentMiddleware verifies.
        $_SESSION['student_access'] = true;

        $data['page_title'] = 'Student Info | Haunted Hallway';

        $this->call->view('student/student_home', $data);
    }

    /**
     * GET /student/profile
     *
     * Protected by StudentMiddleware. Builds the student data as an
     * associative array in the controller and passes it to the view,
     * as required by Part C of the activity.
     *
     * @return void
     */
    public function profile()
    {
        // TODO (Individualization Requirement): Replace every value
        // below with YOUR own real information before you submit.
        $student = [
            'student_id'  => '2024-00048',
            'name'        => 'John Paulo Abante',
            'course'      => 'BS Information Technology',
            'year'        => '3rd Year',
            'section'     => 'f1',
            'email'       => 'john.paulo.abante@example.com',
            'address'     => 'Purok 1, sta.Isabel,Naujan',
            'contact'     => '09627010467',
            'hobbies'     => 'Coding, Horror Movies, Digital Art',
            'skills'      => 'PHP, JavaScript, UI Design',
            'bio'         => 'A web development student who enjoys turning '
                            . 'ordinary class projects into something a '
                            . 'little more atmospheric — like this haunted '
                            . 'student portal built with LavaLust.',
            'page_title'  => 'Student Profile | Haunted Hallway',
        ];

        $this->call->view('student/student_profile', $student);
    }
}
