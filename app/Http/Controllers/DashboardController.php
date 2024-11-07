<?php

namespace App\Http\Controllers;

use App\Models\Sale; // Assuming you have a Sale model
use App\Models\AuditTrail; // Assuming AuditTrail model tracks user actions
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all sales data and the associated user data
        $sales = Sale::with('user')->get(); // Assuming the 'Sale' model has a relationship with the 'User' model

        // Fetch unique menus accessed by the authenticated user
        $userId = Auth::id();
        $menus = AuditTrail::where('user_id', $userId)
            ->select('menu_accessed')
            ->distinct()
            ->pluck('menu_accessed');

        // Pass both sales data and menus to the view
        return view('dashboard.index', compact('sales', 'menus'));
    }
}
