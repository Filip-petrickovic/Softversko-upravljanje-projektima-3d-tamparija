<?php



class Ads extends Controller
{
    public function index()
    {
        $this->model('ad');
        $ads = Ad::whereNotIn('id', function($query) {
            $query->select('oglas_id')->from('narudzbina');
        })->get();
    

        return $this->view('ads/index', array('oglasi' => $ads));
    }
    
    public function objavi() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if user is logged in
            if(isset($_SESSION["email"])) {
                // Find user ID based on email
                $user = $this->getUserByEmail($_SESSION["email"]);
    
                if ($user) {
                    // Accept form data
                    $this->model('ad');
                    $naslov = $this->sanitize($_POST['naslov']);
                    $opis = $this->sanitize($_POST['opis']);
                    $marka = $this->sanitize($_POST['marka']);
                    $model = $this->sanitize($_POST['model']);
                    $godina = $this->sanitize($_POST['godina']);
                    $cena = $this->sanitize($_POST['cena']);
                    $kilometraza = $this->sanitize($_POST['kilometraza']);
                    $kreator_id = $user->id; // Assuming 'id' is the user ID column name
    
                    // Validate data
                    $errors = [];
    
                    if (empty($naslov)) {
                        $errors[] = "Naslov je obavezan.";
                    }
    
                    if (empty($opis)) {
                        $errors[] = "Opis je obavezan.";
                    }
    
                    if (empty($marka)) {
                        $errors[] = "Marka je obavezna.";
                    }
    
                    if (empty($model)) {
                        $errors[] = "Model je obavezan.";
                    }
    
                    if (!is_numeric($godina) || empty($godina)) {
                        $errors[] = "Godina mora biti broj.";
                    }
    
                    if (!is_numeric($cena) || empty($cena)) {
                        $errors[] = "Cena mora biti broj.";
                    }
    
                    // Proceed if no errors
                    if (empty($errors)) {
                        // Handle file upload
                        $targetDir = "images/";
                        $fileName = basename($_FILES["url_slike"]["name"]);
                        $targetFilePath = $targetDir . $fileName;
                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    
                        if (in_array($fileType, $allowTypes)) {
                            if (move_uploaded_file($_FILES["url_slike"]["tmp_name"], $targetFilePath)) {
                                // Insert data into database
                                $ad = new Ad(); // Assuming Ad model exists
                                $ad->naslov = $naslov;
                                $ad->opis = $opis;
                                $ad->marka = $marka;
                                $ad->model = $model;
                                $ad->godina = $godina;
                                $ad->cena = $cena;
                                $ad->kilometraza = $kilometraza;
                                $ad->url_slike = $fileName;
                                $ad->kreator_id = $kreator_id;
    
                                if ($ad->save()) {
                                    echo json_encode(["success" => true, "message" => "Podaci uspešno uneti."]);
                                } else {
                                    echo json_encode(["success" => false, "message" => "Greška pri unosu podataka."]);
                                }
                            } else {
                                echo json_encode(["success" => false, "message" => "Greška pri uploadu slike."]);
                            }
                        } else {
                            echo json_encode(["success" => false, "message" => "Dozvoljeni formati slike su JPG, JPEG, PNG, GIF."]);
                        }
                    } else {
                        // Display validation errors
                        echo json_encode(["success" => false, "errors" => $errors]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "Korisnik nije pronađen"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Korisnik nije prijavljen"]);
            }
        }else{
            return $this->view('ads/objavi');
        }
    }
    
    public function unorder($id) {
        
        $this->model('order');

        $order = Order::where('oglas_id', $id)->first();

        if (!$order) {
            header("Location: /public/ads");
            exit;
        }

        // Delete the order
        $order->delete();
        header("Location: /public/ads");
    }
    public function ad($id) {
        $this->model('ad');
        $ad = Ad::find($id);
        if($ad) {
            return $this->view('ads/ad', ['oglas' => $ad]);
        } else {
            echo "Ad not found"; // Handle case where ad is not found
        }
    }

    public function orders()
    {
        $user = null;
        $this->model('order');
        $this->model('user');
        $this->model('ad');
        if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            $user = User::where('email', $_SESSION['email'])->first();
        }
        // Retrieve orders associated with the user and eager load the 'ad' relationship
        $orders = Order::where('user_id', $user->id)->with('ad')->get();
        return $this->view('ads/orders', ['oglasi' => $orders]);
    }
    public function order($adId)
    {
        $user = null;
        $orders = [];

        // Load necessary models
        $this->model('order');
        $this->model('user');
        $this->model('ad');

        // Check if user is logged in
        if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            // Fetch the user by email from the database
            $user = User::where('email', $_SESSION['email'])->first();

            if($user) {
                // Fetch the ad based on the provided $adId
                $ad = Ad::find($adId);

                if($ad) {
                    // Example: Creating a new order (assuming user adds a new order)
                    // Replace with your actual logic to create a new order
                    $newOrder = Order::create([
                        'user_id' => $user->id,
                        'oglas_id' => $ad->id,
                        // Add other fields as needed
                    ]);
                    
                    // Retrieve all orders related to the ad and the user
                    $orders = Order::where('user_id', $user->id)->with('ad')
                                    ->get();

                    // Redirect or display success message after creating the order

                    // Return the view with orders data
                    header("Location: /public/ads/orders");
                } else {
                    echo "Ad not found"; // Handle case where ad is not found
                }
            } else {
                echo "User not found"; // Handle case where user is not found
            }
        } else {
            echo "User not logged in"; // Handle case where user is not logged in
        }
    }
    private function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    // Helper method to sanitize input
    private function sanitize($input)
    {
        // Implement your sanitization logic as needed
        return htmlspecialchars(trim($input));
    }

    // Dodajte ostale funkcije kontrollera oglasima ako je potrebno (npr. create, edit, delete)
}