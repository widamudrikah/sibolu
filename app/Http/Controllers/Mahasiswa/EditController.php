<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\HasilTugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    public function editTask(Request $request)
    {
        $hasil_tugas                = HasilTugas::find($request->hasil_tugas_id);
        $hasil_tugas->link_tugas    = $request->link_tugas;
        $hasil_tugas->kendala       = $request->kendala;
        $hasil_tugas->save();

        return redirect()->route('m.task.sent.view',Crypt::encrypt($hasil_tugas->kelas_id))->with("mantap","Berhasil update tugas");
    }

    public function changePassword()
    {
        return view('layouts.pages.mhs.change-pw');
    }

    public function changePasswordProses(Request $request)
    {
        $request->validate([
            'current_password'  => 'required',
            'password'          => 'required|min:4|confirmed',
        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('ok', 'Password berhasil diubah.');
        }

        // return redirect()->back()->withErrors(['current_password' => 'Password lama salah.']);
        return redirect()->back()->with('current_password','Password lama salah.');
    }
}
