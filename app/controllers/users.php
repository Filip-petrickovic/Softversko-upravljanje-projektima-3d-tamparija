<?php

class Users extends Controller
{
    function provera($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index(){
        session_destroy();
        header('Location: /autoplac%20mvc%20projekat/public/home/index');
    }

    public function login(){
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model('user');
            $this->model('ad');
            $email = $this->provera($_POST["email"]);
            $pass = $this->provera($_POST["pass"]);
            $valid = true;
        
            if (empty($email)) {
                $response['errors']['email'] = "Niste uneli email adresu";
                $valid = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['errors']['email'] = "Pogresno uneta email adresa";
                $valid = false;
            }
        
            if (empty($pass)) {
                $response['errors']['pass'] = "Niste uneli lozinku";
                $valid = false;
            } elseif (strlen($pass) < 6) {
                $response['errors']['pass'] = "Šifra mora imati vise od 6 karaktera";
                $valid = false;
            }
        
            if ($valid) {
                $user = User::where('email', $email)->first();
                
                if ($user) {
                    
        
                    if ($user->verifyPassword($pass)) {
                        $_SESSION["email"] = $email;
                        $response['success'] = true;
                    } else {
                        $response['errors']['pass'] = "Pogresna ifra";
                    }
                } else {
                    $response['errors']['email'] = "Ne postoji nalog pod ovim mejlom.";
                }
            }
            echo json_encode($response);
        }else{
            return $this->view('user/login');
        }
    }
    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->model('user');
            $this->model('ad');
            
            // Sanitize and validate input
            $email = $this->provera($_POST["email"]);
            $pass = $this->provera($_POST["pass"]);
            $username = $this->provera($_POST["username"]);
            $lozinkaPonovo = $this->provera($_POST["provera"]);
        
            $valid = true;
            $response = [];
        
            if (empty($username)) {
                $response['errors']['username'] = "Niste uneli korisničko ime";
                $valid = false;
            }
        
            if (empty($email)) {
                $response['errors']['email'] = "Niste uneli email adresu";
                $valid = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response['errors']['email'] = "Pogrešno uneta email adresa";
                $valid = false;
            }
        
            if (empty($pass)) {
                $response['errors']['pass'] = "Niste uneli lozinku";
                $valid = false;
            } elseif (strlen($pass) < 6) {
                $response['errors']['pass'] = "Šifra mora imati više od 6 karaktera";
                $valid = false;
            }
        
            if (empty($lozinkaPonovo)) {
                $response['errors']['provera'] = "Niste uneli ponovljenu lozinku";
                $valid = false;
            } elseif ($lozinkaPonovo !== $pass) {
                $response['errors']['provera'] = "Lozinke se ne podudaraju";
                $valid = false;
            }
        
            if ($valid) {
                // Check if email already exists
                $existingUser = User::where('email', $email)->first();
        
                if ($existingUser) {
                    $response['errors']['email'] = "Već postoji nalog sa ovim emailom";
                } else {
                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

                    $newUser = User::create([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashedPass,
                    ]);

                    if ($newUser) {
                        $_SESSION["email"] = $email;
                        $response['success'] = true;
                    } else {
                        $response['errors']['database'] = "Greška pri unosu u bazu";
                    }
                }
            }
        
            echo json_encode($response);
        } else {
            return $this->view('user/register');
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