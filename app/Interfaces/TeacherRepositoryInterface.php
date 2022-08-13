<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface
{
    public function getAllTeachers();
    public function createTeacher(array $teacherDetails);
    public function editTeacher($teacherId);
    public function updateTeacher($teacherDetails, $teacherId);
    public function getTeacherById($teacherId);
    public function getSpecializations();
    public function getGenders();
    public function deleteTeacher($teacherId);
}
