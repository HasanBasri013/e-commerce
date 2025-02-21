<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\BarangImage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('user.home');
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        // Data untuk dashboard admin
        $total_users = 1250;
        $total_orders = 856;
        $total_revenue = 5230060.75;
        $recent_activities = [
            ['user' => 'John Doe', 'action' => 'Placed an order', 'time' => '2 hours ago'],
            ['user' => 'Jane Smith', 'action' => 'Updated profile', 'time' => '3 hours ago'],
            ['user' => 'Bob Johnson', 'action' => 'Submitted a review', 'time' => '5 hours ago'],
        ];
    
        // Kirim data ke view 'admin.adminHome'
        return view('admin.adminHome', compact('total_users', 'total_orders', 'total_revenue', 'recent_activities'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome(): View
    {
        $barangs = Barang::with('images')
        ->orderBy('id', 'desc')  // Urutkan berdasarkan ID secara menurun
        ->take(4)  // Ambil 4 barang terakhir
        ->get();

// Kirim data barang ke view 'manager.home'
        return view('kasir.managerHome', compact('barangs'));;
    }

}
