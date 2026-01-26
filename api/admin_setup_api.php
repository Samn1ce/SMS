<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api-error.log');
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';

    if ($action === 'create_school_and_admin') {
        $school_data = $data['school'] ?? [];
        $admin_data = $data['admin'] ?? [];
        $admin_name = $admin_data['name'] ?? [];
        
        if (empty($school_data['name']) || empty($school_data['slug']) || empty($school_data['email'])) {
            echo json_encode([
                'success' => false,
                'message' => 'School name, code, and email are required'
            ]);
            exit;
        }
        
        if (empty($admin_name['surname']) || empty($admin_name['firstname']) || empty($admin_data['email']) || empty($admin_data['password'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Admin name, email, and password are required'
            ]);
            exit;
        }
        
        mysqli_begin_transaction($conn);
        
        try {
            $insertSchoolQuery = "INSERT INTO schools (school_name, school_slug, school_email, school_phone, school_address) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSchoolQuery);
            mysqli_stmt_bind_param($stmt, "sssss", 
                $school_data['name'],
                $school_data['slug'],
                $school_data['email'], 
                $school_data['phone'],
                $school_data['address']
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception('Failed to create school');
            }

            $school_id = mysqli_insert_id($conn);
            
            // Create admin user
            $hashed_password = password_hash($admin_data['password'], PASSWORD_DEFAULT);
            
            $othername = $admin_name['othername'] ?? '';

            $insertAdminQuery = "INSERT INTO users (school_id, surname, firstname, othername, email, pwd, roles) 
                                VALUES (?, ?, ?, ?, ?, ?, 'admin')";
            $stmt = mysqli_prepare($conn, $insertAdminQuery);
            mysqli_stmt_bind_param($stmt, "isssss", 
                $school_id, 
                $admin_name['surname'],
                $admin_name['firstname'],
                $othername,
                $admin_data['email'], 
                $hashed_password
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception('Failed to create admin user');
            }

            $admin_id = mysqli_insert_id($conn);

            $updateSchool = "UPDATE schools SET admin_id = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $updateSchool);
            mysqli_stmt_bind_param($stmt, "ii", $admin_id, $school_id);
            mysqli_stmt_execute($stmt);

            // Commit transaction
            mysqli_commit($conn);
            
            echo json_encode([
                'success' => true,
                'message' => 'School and admin created successfully',
            ]);
            
        } catch (Exception $e) {
            // Rollback transaction
            mysqli_rollback($conn);
            
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
    }
}