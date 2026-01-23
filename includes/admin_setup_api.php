<?php
header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, PUT');
// header('Access-Control-Allow-Headers: Content-Type');

require_once 'dbh.inc.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';

    if ($action === 'create_school_and_admin') {
        // All-in-one: Create school and admin in one go
        $school_data = $data['school'] ?? [];
        $admin_data = $data['admin'] ?? [];
        
        // Validate school data
        if (empty($school_data['school_name']) || empty($school_data['school_code']) || empty($school_data['email'])) {
            echo json_encode([
                'success' => false,
                'message' => 'School name, code, and email are required'
            ]);
            exit;
        }
        
        // Validate admin data
        if (empty($admin_data['name']) || empty($admin_data['email']) || empty($admin_data['password'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Admin name, email, and password are required'
            ]);
            exit;
        }
        
        // Start transaction
        mysqli_begin_transaction($conn);
        
        try {           
            // Create school
            $insertSchoolQuery = "INSERT INTO schools (school_name, school_email, school_phone_number, school_address) 
                                 VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSchoolQuery);
            mysqli_stmt_bind_param($stmt, "sssss", 
                $school_data['school_name'], 
                $school_data['school_email'], 
                $school_data['school_phone_number'] ?? '', 
                $school_data['school_address'] ?? '', 
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception('Failed to create school');
            }
            
            $school_id = mysqli_insert_id($conn);
            
            // Create admin user
            $hashed_password = password_hash($admin_data['password'], PASSWORD_DEFAULT);
            
            $insertAdminQuery = "INSERT INTO users (school_id, name, email, password, role) 
                                VALUES (?, ?, ?, ?, 'admin')";
            $stmt = mysqli_prepare($conn, $insertAdminQuery);
            mysqli_stmt_bind_param($stmt, "isss", 
                $school_id, 
                $admin_data['name'], 
                $admin_data['email'], 
                $hashed_password
            );
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception('Failed to create admin user');
            }
            
            $admin_id = mysqli_insert_id($conn);
            
            // Commit transaction
            mysqli_commit($conn);
            
            echo json_encode([
                'success' => true,
                'message' => 'School and admin created successfully',
                'data' => [
                    'school_id' => $school_id,
                    'admin_id' => $admin_id
                ]
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