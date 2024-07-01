<?php



class Ads extends Controller
{
    public function index()
    {
        $this->model('ad');
        $ads = Ad::all(); 

        return $this->view('ads/index', array('oglasi' => $ads));
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
    

    // Dodajte ostale funkcije kontrollera oglasima ako je potrebno (npr. create, edit, delete)
}