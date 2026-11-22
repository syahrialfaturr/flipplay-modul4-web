<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Menampilkan semua member
    public function index()
    {
        $members = Member::latest()->get();

        return MemberResource::collection($members);
    }

    // Menampilkan detail member beserta koleksinya
    public function show(Member $member)
    {
        return new MemberResource($member->load('media'));
    }

    // Menambahkan member baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $member = Member::create($validated);

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(201);
    }

    // Memperbarui data member
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $member->update($validated);

        return new MemberResource($member);
    }

    // Menghapus member
    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'message' => 'Member berhasil dihapus.',
        ]);
    }
}
