<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * StudentMiddleware
 * ------------------------------------------------------------------
 * Guards the /student/profile route.
 *
 * Access condition (unique to this app):
 * The visitor must have first "checked in" at the Student Portal home
 * page ( /student ), which stamps a session flag. Anyone who tries to
 * jump straight to the profile / digital ID page without checking in
 * first is bounced back to the home page with a denial notice.
 */
class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $allowed = isset($_SESSION['student_access']) && $_SESSION['student_access'] === true;

        if (!$allowed) {
            $_SESSION['student_access_message'] = 'Access denied: please check in at the Student Portal before viewing the Digital ID.';
            redirect('student');
            return;
        }

        return $next();
    }
}
