<?php

namespace App\Interfaces;

interface StudentRepositoryInterface
{
    public function getAllStudents();
    public function createStudent($studentDetails);
    public function editStudent($studentId);
    public function updateStudent($studentDetails, $studentId);
    public function getStudentById($studentId);
    public function deleteStudent($studentId);
    public function getGenders();
    public function getNationalities();
    public function getBloods();
    public function getClassrooms();
    public function getParents();
    public function getGrades();
    public function getSections($id);
    public function uploadAttachments($request);
    public function deleteAttachment($request);
    public function downloadAttachment($id, $name);

}
