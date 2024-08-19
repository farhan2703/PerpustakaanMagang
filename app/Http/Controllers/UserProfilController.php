<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserProfilController extends Controller
{
    // Metode edit untuk menampilkan halaman edit profil
    public function edit($id_member)
    {
        $member = Member::findOrFail($id_member);
        return view('profile.editprofil', compact('member'));
    }

    // Metode update untuk menyimpan perubahan profil
    public function update(Request $request, $id_member)
    {
        $member = Member::findOrFail($id_member);

        // Validasi data
        // dd($request->all());
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:member,email,' . $id_member . ',id_member',
            'email' => ['required', 'string', 'email'],
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($member->email == $request->email) {
            unset($data['email']);
        }

        // Hash password jika ada
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']); // Jangan update password jika tidak ada input
        }

        // Upload foto jika ada
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('profile_photos', 'public');
        }

        // Update data member
        $member->update($data);

        // Redirect ke dashboard setelah perubahan disimpan
        return redirect()->route('halaman.dashboard')->with('success', 'Profil berhasil diubah');
    }

}
