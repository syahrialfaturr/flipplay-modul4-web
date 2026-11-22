<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Media;
use App\Models\Member;
use Illuminate\Http\JsonResponse;

class MemberCollectionController extends Controller
{
    // Menampilkan koleksi media milik member
    public function index(Member $member): MemberResource
    {
        return new MemberResource($member->load('media'));
    }

    // Menambahkan media ke koleksi member
    public function store(Member $member, Media $media): JsonResponse
    {
        if ($member->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada dalam koleksi member.',
            ], 409);
        }

        $member->media()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi.',
            'data' => new MemberResource($member->load('media')),
        ], 201);
    }

    // Menghapus media dari koleksi member
    public function destroy(Member $member, Media $media): JsonResponse
    {
        $deleted = $member->media()->detach($media->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Media tidak ditemukan dalam koleksi member.',
            ], 404);
        }

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi.',
        ]);
    }
}
