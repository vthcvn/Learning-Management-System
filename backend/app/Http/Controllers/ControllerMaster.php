<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ControllerMaster extends Controller
{

    static function getAllCoursesEnrolled($userId, $limit)
    {

        $courses = null;
        if ($limit == 0) {
            $courses = DB::table('courses')
                ->select('course_id', 'course_title', 'course_cover', 'public', 'courses.user_id')
                ->join('registered_students', 'registered_students.course_id', '=', 'courses.id')
                ->where('public', 1)
                ->where('registered_students.user_id', $userId)
                ->get();
        } else {
            $courses = DB::table('courses')
                ->select('course_id', 'course_title', 'course_cover', 'public', 'courses.user_id')
                ->join('registered_students', 'registered_students.course_id', '=', 'courses.id')
                ->where('public', 1)
                ->where('registered_students.user_id', $userId)
                ->limit($limit)
                ->get();
        }
        $collectionOfCourses = collect();
        foreach ($courses as $course) {
            $teacherName = ControllerMaster::getUserNameById($course->user_id);
            $numberOfStudents = ControllerMaster::countStudentsOfCourse($course->course_id);
            $numberOfMaterials = ControllerMaster::countMaterialsOfCourse($course->course_id);
            $numberOfAssignments = ControllerMaster::countAssginmentsOfCourse($course->course_id);
            $collectionOfCourses->push([
                'course' => $course,
                'teacherName' => $teacherName,
                'numberOfStudents' => $numberOfStudents,
                'numberOfMaterials' => $numberOfMaterials,
                'numberOfAssignments' => $numberOfAssignments,
            ]);
        }
        return $collectionOfCourses;
    }

    // Get course teaching by teacher
    static function getCoursesIsBeingTaught($teacherId, $limit)
    {
        $courses = null;
        if ($limit == 0) {
            $courses = DB::table('courses')
                ->select('id', 'course_title', 'course_cover', 'public', 'user_id')
                ->where('user_id', $teacherId)
                ->where('public', 1)
                ->get();
        } else {
            $courses = DB::table('courses')
                ->select('id', 'course_title', 'course_cover', 'public', 'user_id', 'id as course_id')
                ->where('user_id', $teacherId)
                ->where('public', 1)
                ->limit($limit)
                ->get();
        }
        $collectionOfCourses = collect();
        foreach ($courses as $course) {
            $teacherName = ControllerMaster::getUserNameById($course->user_id);
            $numberOfStudents = ControllerMaster::countStudentsOfCourse($course->id);
            $numberOfMaterials = ControllerMaster::countMaterialsOfCourse($course->id);
            $numberOfAssignments = ControllerMaster::countAssginmentsOfCourse($course->id);
            $collectionOfCourses->push([
                'course' => $course,
                'teacherName' => $teacherName,
                'numberOfStudents' => $numberOfStudents,
                'numberOfMaterials' => $numberOfMaterials,
                'numberOfAssignments' => $numberOfAssignments,
            ]);
        }
        return $collectionOfCourses;
    }

    // Get all assignments
    static function getAssignments($userId)
    {
        $assignments = DB::table('assignments')
            ->join('courses', 'courses.id', '=', 'assignments.course_id')
            // ->join('registered_students', 'registered_students.id', '=', 'courses.id')
            // ->where('registered_students.user_id', 3)
            ->get();
        // $collection = collect();
        // foreach ($assignments as $assignment) {
        //     $submission = CourseController::getSubmission($assignment->id, 2);
        //     $collection->push(['assignment' => $assignment, 'submission' => $submission]);
        // }
        return $assignments;
    }

    static function countAssginmentsOfCourse($courseId)
    {
        $assignments = DB::table('assignments')
            ->select('id')
            ->where('course_id', $courseId)
            ->count();
        return $assignments;
    }

    static function countStudentsOfCourse($courseId)
    {
        $student = DB::table('users')
            ->join('registered_students', 'registered_students.user_id', '=', 'users.id')
            ->join('courses', 'courses.id', '=', 'registered_students.course_id')
            ->where('courses.id', $courseId)->count();
        return $student;
    }

    static function countMaterialsOfCourse($courseId)
    {
        $materials = DB::table('materials')
            ->select('id')
            ->join('courses', 'courses.id', '=', 'materials.course_id')
            ->where('courses.id', $courseId)->count();
        return $materials;
    }

    // Get course by id
    static function getCourseById($courseId)
    {
        $course = Course::where('id', $courseId)->first();
        return $course;
    }

    // Get assignments by course id
    static function getAssginmentsByCourseId($courseId)
    {
        $assignments = DB::table('assignments')
            ->where('course_id', $courseId)
            ->get();
        // $collection = collect();
        // foreach ($assignments as $assignment) {
        //     $submission = CourseController::getSubmission($assignment->id, 2);
        //     $collection->push(['assignment' => $assignment, 'submission' => $submission,]);
        // }
        return $assignments;
    }


    // Get materials by course id
    static function getMaterialsByCourseId($courseId)
    {
        $materials = DB::table('materials')
            ->select('material_title', 'material_content', 'file_link')
            ->join('courses', 'courses.id', '=', 'materials.course_id')
            ->where('courses.id', $courseId)
            ->get();
        return $materials;
    }

    // Get username by user id
    static function getUserNameById($userId)
    {
        $user = DB::table('users')
            ->where('id', $userId)
            ->first();
        return $user->name;
    }
}
