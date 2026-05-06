<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users'       => User::count(),
            'admin_users'       => User::where('is_admin', true)->count(),
            'new_this_week'     => User::where('created_at', '>=', now()->subDays(7))->count(),
            'new_this_month'    => User::where('created_at', '>=', now()->startOfMonth())->count(),
            'recent_users'      => User::latest()->take(8)->get(),
            'total_contacts'    => Contact::count(),
            'unread_contacts'   => Contact::where('leido', false)->count(),
            'recent_contacts'   => Contact::latest()->take(6)->get(),
            'total_enrollments' => Enrollment::count(),
            'recent_enrollments'=> Enrollment::with('user')->latest()->take(6)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
