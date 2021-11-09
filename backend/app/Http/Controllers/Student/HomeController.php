<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->input('userId');
        return response()->json([
            'listOfCourses' => ControllerMaster::getAllCoursesEnrolled($userId, 3),
            'listOfNewCourses' => HomeController::getNewCourses(),
            'numberOfAssigmentsToday' => HomeController::countTodayAssignments($userId),
            'listOfAssignments' => HomeController::getAllAssignments($userId),
        ]);
    }

    // Get number of today assignmentss
    static function countTodayAssignments($studentId)
    {
        $current = Carbon::now();
        $yesterday = Carbon::now()->subDay();
        $numberAssignments = DB::table('assignments')
            ->select('assignments.id', 'assignments.course_id')
            ->join('courses', 'courses.id', 'assignments.course_id')
            ->join('registered_students', 'registered_students.course_id', 'courses.id')
            ->where('registered_students.user_id', $studentId)
            ->where('deadline', '<=', $current)
            ->where('deadline', '>', $yesterday)
            ->count();
        if ($numberAssignments > 1) {
            return $numberAssignments . ' assignments';
        }
        return $numberAssignments . ' assignment';
    }

    // Get new courses
    static function getNewCourses()
    {
        $courses = DB::table('courses')
            ->select('id', 'course_title', 'course_cover', 'introduction', 'public', 'user_id')
            ->where('public', 0)
            ->get();
        $collectionOfNewCourses = collect();
        foreach ($courses as $course) {
            $teacherName = ControllerMaster::getUserNameById($course->user_id);
            $numberOfStudents = ControllerMaster::countStudentsOfCourse($course->id);
            $collectionOfNewCourses->push([
                'course' => $course,
                'teacherName' => $teacherName,
                'teacherAvatar' => ControllerMaster::getUserAvatar($course->user_id),
                'numberOfStudents' => $numberOfStudents,
            ]);
        }
        return $collectionOfNewCourses;
    }

    static function getAllAssignments($userId)
    {
        $assigments = DB::table('assignments')
            ->select('assignments.id', 'assignments.course_id')
            ->join('courses', 'courses.id', 'assignments.course_id')
            ->join('registered_students', 'registered_students.course_id', 'courses.id')
            ->where('registered_students.user_id', $userId)
            ->orderBy('deadline', 'desc')
            ->get();
        return $assigments;
    }
}
