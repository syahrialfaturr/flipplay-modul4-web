<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // Menampilkan semua media dan pencarian berdasarkan judul
    public function index(Request $request)
    {
        $media = Media::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->get();

        return MediaResource::collection($media);
    }

    // Menampilkan detail media beserta member dalam koleksinya
    public function show(Media $media)
    {
        return new MediaResource($media->load('members'));
    }

    // Menambahkan media baru
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    // Memperbarui data media
    public function update(UpdateMediaRequest $request, Media $media)
    {
        $media->update($request->validated());

        return new MediaResource($media->fresh());
    }

    // Menghapus media
    public function destroy(Media $media)
    {
        $media->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus.',
        ], 200);
    }
}
