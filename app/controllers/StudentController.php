<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * StudentController
 * ------------------------------------------------------------------
 * Handles the Student Portal: a home/check-in page and a
 * middleware-protected Digital ID (profile) page.
 */
class StudentController extends Controller
{
    /**
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
            'student_id'   => '2024-00123',
            'name'         => 'Pau',
            'course'       => 'BS Information Technology',
            'year_level'   => '3rd Year',
            'section'      => 'BSIT-3A',
            'email'        => 'pau.student@example.edu.ph',
            'contact'      => '0917-000-0000',
            'address'      => 'San Pablo City, Laguna, Philippines',
            'hobbies'      => 'Web development, networking labs, coding capstone projects',
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
    }
}
