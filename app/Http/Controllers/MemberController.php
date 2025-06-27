<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Setting;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $member = Member::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $member = Member::paginate(5);
        }
        return view('member.index', data: compact('member'));
    }

    public function create()
    {
        return view('member.create-member');
    }

    public function edit($id)
    {
        $member = Member::find($id);
        return view('member.edit-member', compact('member'));
    }


    public function store(Request $request)
    {
        $member = Member::latest()->first() ?? new Member();
        $kode_member = (int) $member->kode_member + 1;

        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');


    }

    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->update($request->all());
        $member->update();
        return redirect()->route('member.index')->with('suksesupdate', 'Member berhasil diupdate');
    }

    public function deletemember($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('member.index')->with('delete', 'Member Berhasil Dihapus');

    }

    public function cetakMember(Request $request)
    { {
            $datamember = collect(array());
            foreach ($request->id_member as $id) {
                $member = Member::find($id);
                $datamember[] = $member;
            }

            $datamember = $datamember->chunk(2);
            $setting = Setting::first();

            $no = 1;
            $pdf = PDF::loadView('member.cetak', compact('datamember', 'no', 'setting'));
            $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
            return $pdf->stream('member.pdf');
        }
    }

    public function cetakMemberSelect(Request $request)
    {
        // Validasi input
        $request->validate([
            'member_id' => 'required|array',
            'member_id.*' => 'exists:member,id_member', // Pastikan id_member valid
        ]);

        // Ambil data member berdasarkan ID yang dipilih
        $members = Member::whereIn('id_member', $request->member_id)->get();

        // Jika tidak ada data, kembalikan ke halaman sebelumnya dengan pesan error
        if ($members->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada member yang dipilih.');
        }

        // Kirim data ke view untuk cetak kartu
        return view('member.cetak-member', compact('members'));
    }


}
