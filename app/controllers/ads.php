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
    
    
    public function unorder($id) {
        
        $this->model('order');

        $order = Order::where('oglas_id', $id)->first();

        if (!$order) {
            header("Location: /autoplac%20mvc%20projekat/public/ads");
            exit;
        }

        // Delete the order
        $order->delete();
        header("Location: /autoplac%20mvc%20projekat/public/ads");
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
                header("Location: /autoplac%20mvc%20projekat/public/ads/orders");
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

    // Dodajte ostale funkcije kontrollera oglasima ako je potrebno (npr. create, edit, delete)
}