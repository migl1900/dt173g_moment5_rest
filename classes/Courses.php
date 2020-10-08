<?php

// Class methods handling REST CRUD for application
class Courses extends DbConnect {

    private $codeVariable = "code";
    private $nameVariable = "name";
    private $progressionVariable = "progression";
    private $linkVariable = "link";
    
    public function getAllCourses() {
        $sql = "SELECT * FROM dt173g_5_courses";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function getCourse($id) {
        $sql = "SELECT * FROM dt173g_5_courses WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    public function createCourse() {
        if(!$this->checkValue($this->codeVariable, $this->code)) {
            return false;
        }
        if(!$this->checkValue($this->nameVariable, $this->name)) {
            return false;
        }
        if(!$this->checkValue($this->progressionVariable, $this->progression)) {
            return false;
        }
        if(!$this->checkValue($this->linkVariable, $this->link)) {
            return false;
        }
        $sql = "INSERT INTO dt173g_5_courses(code, name, progression, link) VALUES ('$this->code', '$this->name', '$this->progression', '$this->link')";
        return $this->db->query($sql);
    }

    public function editCourse($id) {
        if(!$this->checkValue($this->codeVariable, $this->code)) {
            return false;
        }
        if(!$this->checkValue($this->nameVariable, $this->name)) {
            return false;
        }
        if(!$this->checkValue($this->progressionVariable, $this->progression)) {
            return false;
        }
        if(!$this->checkValue($this->linkVariable, $this->link)) {
            return false;
        }
        $sql = "UPDATE dt173g_5_courses SET code = '$this->code', name = '$this->name', progression = '$this->progression', link = '$this->link' WHERE id = $id";
        return $this->db->query($sql);
    }

    public function deleteCourse($id) {
        $sql = "DELETE FROM dt173g_5_courses WHERE id = $id";
        return $this->db->query($sql);
    }

    // Check if input value is set and no bad code is used
    function checkValue($variable, $value) {
        if($value != "") {
            $value = strip_tags($value);
            if($variable == "code") {
                $this->code = $this->db->real_escape_string($value);
            } else if($variable == "name") {
                $this->name = $this->db->real_escape_string($value);
            } else if($variable == "progression") {
                $this->progression = $this->db->real_escape_string($value);
            }else if($variable == "link") {
                $this->link = $this->db->real_escape_string($value);
            } else {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}