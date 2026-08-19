<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * StudentMiddleware
 * ------------------------------------------------------------------
 * Guards the /student/profile route.
 *
 * Access condition (unique to this activity): the visitor must carry
 * a "haunted pass" in their session — $_SESSION['student_access'].
 * That pass is stamped by StudentController::index() when the
 * visitor enters through /student, the "gate" of the Haunted Hallway.
 *
 * Conceptual flow:
 *
 *   Request
 *     ↓
 *   StudentMiddleware
 *     ↓
 *   Is $_SESSION['student_access'] === true ?
 *     ├── YES → StudentController::profile() → View
 *     └── NO  → Redirect back to /student
 * ------------------------------------------------------------------
 */
class StudentMiddleware
{
    /**
     * Handle the incoming request.
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $has_pass = isset($_SESSION['student_access']) && $_SESSION['student_access'] === true;

        if ($has_pass) {
            return $next();
        }

        // No haunted pass found — send the visitor back to the gate.
        $_SESSION['student_access_denied_message'] =
            '👻 Boo! You tried to sneak into the crypt without a haunted pass. '
            . 'Walk through the gate at /student first.';

        redirect('student');
    }
}
