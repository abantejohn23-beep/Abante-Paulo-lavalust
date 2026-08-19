<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * StudentController
 * ------------------------------------------------------------------
<<<<<<< HEAD
 * Laboratory Activity: LavaLust Routing, Controllers, Views, and
 * Middleware.
 *
 * Handles the Halloween-themed "Student Info" pages:
 *   - index()   -> /student           (Student home / haunted gate)
 *   - profile() -> /student/profile   (Student profile, protected by
 *                                       StudentMiddleware)
 * ------------------------------------------------------------------
=======
 * Handles the Student Portal: a home/check-in page and a
 * middleware-protected Digital ID (profile) page.
>>>>>>> 479b9dce994c61c81236cc241752115ccb6298e6
 */
class StudentController extends Controller
{
    /**
<<<<<<< HEAD
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
=======
     * Ensure a PHP session is available on every action.
     */
    public function before_action()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * GET /student
     * Student Portal home / check-in page.
     * "Checking in" here stamps the session flag that
     * StudentMiddleware looks for before it will allow
     * access to the protected profile page.
     */
    public function index()
    {
        // Grab and clear any access-denied notice set by the middleware
        $denied_message = $_SESSION['student_access_message'] ?? null;
        unset($_SESSION['student_access_message']);

        // Simple access condition for this lab: visiting the home page
        // checks the student in and grants access to the Digital ID page.
        $_SESSION['student_access'] = true;

        $data = [
            'page_title'  => 'Student Portal',
            'checked_in'  => true,
            'denied'      => $denied_message,
        ];

        $this->call->view('student_home', $data);
    }

    /**
     * GET /student/profile  (protected by StudentMiddleware)
     * Displays the student's Digital ID card.
     */
    public function profile()
    {
        // Associative array of student data, passed to the view
        $student = [
            'student_id'   => 'MCC2024-00048',
            'name'         => 'Paulo Abante',
            'course'       => 'BS Information Technology',
            'year_level'   => '3rd Year',
            'section'      => 'BSIT-3F1',
            'email'        => 'pau.student@gmail.com',
            'contact'      => '0917-000-0000',
            'address'      => 'Santa isabel, Naujan, Oriental Mindoro, Philippines',
            'hobbies'      => 'Badmiton, Mobile Gaming',
            'photo'        => base_url('assets/img/student.jpg'),
        ];

        $data = [
            'page_title' => 'Student Digital ID',
            'student'    => $student,
        ];

        $this->call->view('student_profile', $data);
    }

    /**
     * GET /student/logout
     * Clears the check-in flag so the middleware-protected route
     * can be tested for unauthorized access again.
     */
    public function logout()
    {
        unset($_SESSION['student_access']);
        $_SESSION['student_access_message'] = 'You checked out. Check in again to view the Digital ID.';
        redirect('student');
>>>>>>> 479b9dce994c61c81236cc241752115ccb6298e6
    }
}
