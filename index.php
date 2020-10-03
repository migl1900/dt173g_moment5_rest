<?php
/* 
DT173G - Webbutveckling III
REST webservice with API
Author: Michael Glimmerdahl
Date: 2020-10-03

DB structure
---------------------------------------------------------------------------------------------------------------------------
| id (int(11), AI, primary key) | code (varchar(64)) | name (varchar(64)) | progression (varchar(64)) | link (varchar(128))
---------------------------------------------------------------------------------------------------------------------------

REST Requests
GET    - https://webicon.se/tweug/dt173g/moment5/rest/index.php
GET    - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1
POST   - https://webicon.se/tweug/dt173g/moment5/rest/index.php {"code":"DT057G", "name":"Webbutveckling I", "progression":"A", "link":"https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782"}
PUT    - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1 {"code":"DT057G", "name":"Webbutveckling I", "progression":"A", "link":"https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782"}
DELETE - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1

*/


include("includes/config.php");

// Headers to allow methods and access
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, x-Request-With");

// Get method from server request
$method = $_SERVER["REQUEST_METHOD"];

// Check if id is sent
if(isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

// Create instance of courses
$courses = new Courses();

switch($method) {
    case "GET":
        if(isset($id)) {
            $result = $courses->getCourse($id);
        } else {
            $result = $courses->getAllCourses();
        }

        // Check if result contain values
        if(sizeof($result) > 0) {
            http_response_code(200); // OK
        } else {
            http_response_code(404); // Not found
            $result = array("message" => "No courses was found i database");
        }
    break;
    case "POST":
        $data = json_decode(file_get_contents("php://input"));
        $courses->code          = $data->code;
        $courses->name          = $data->name;
        $courses->progression   = $data->progression;
        $courses->link          = $data->link;

        if($courses->createCourse()) {
            http_response_code(201); // Created
            $result = array("message" => "Course created");
        } else {
            http_response_code(503); // Service Unavailable
            $result = array("message" => "Service is unavailable");
        }
    break;
    case "PUT":
        if(!isset($id)) {
            http_response_code(510); // Not extended
            $result = array("message" => "No id is sent");
        } else {
            $data = json_decode(file_get_contents("php://input"));
            $courses->code          = $data->code;
            $courses->name          = $data->name;
            $courses->progression   = $data->progression;
            $courses->link          = $data->link;

            if($courses->editCourse($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Course updated");
            } else {
                http_response_code(503); // Service Unavailable
                $result = array("message" => "Service is unavailable");
            }
        }
    break;
    case "DELETE":
        if(!isset($id)) {
            http_response_code(510); // Not extended
            $result = array("message" => "No id is sent");
        } else {
            if($courses->deleteCourse($id)) {
                http_response_code(200); // OK
                $result = array("message" => "Course deleted");
            } else {
                http_response_code(503); // Service Unavailable
                $result = array("message" => "Service is unavailable");
            }
        }
    break;
}

echo json_encode($result, JSON_PRETTY_PRINT);