<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('member.dashboard');
    }
    public function dashboard()
{
    $jumlahBukuTersedia = Buku::countAvailableBooks();
    return view('member.dashboard', compact('jumlahBukuTersedia'));
}

}