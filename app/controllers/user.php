<?php

class UserController extends Controller
{
    
    public function login(){
         return $this->view('user/login');
    }
    public function register(){
        return $this->view('user/register');
    }
    // Create a new user
    public function create()
    {
        $data = $_POST;
        $validationErrors = $this->validateUser($data);

        if (!empty($validationErrors)) {
            echo json_encode(['errors' => $validationErrors]);
            return;
        }

        // Hash the password before saving
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        try {
            $user = User::create($data);
            echo json_encode($user);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to create user: ' . $e->getMessage()]);
        }
    }

    

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            echo json_encode(['message' => 'User not found']);
            return;
        }

        $user->delete();

        echo json_encode(['message' => 'User deleted']);
    }

    // Validation for user data
    private function validateUser($data, $userId = null)
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        } else {
            $existingUser = User::where('email', $data['email']);
            if ($userId) {
                $existingUser->where('id', '!=', $userId);
            }
            $existingUser = $existingUser->first();
            if ($existingUser) {
                $errors['email'] = 'Email already in use';
            }
        }

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        }

        if (empty($data['password']) || strlen($data['password']) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long';
        }

        return $errors;
    }
}