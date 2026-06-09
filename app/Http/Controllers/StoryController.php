<?php

namespace App\Http\Controllers;

use App\Support\StoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * Return the ordered (newest -> oldest) stories for the active locale,
     * resolved for the Instagram-style stories module.
     */
    public function index(Request $request): JsonResponse
    {
        $stories = StoryRepository::all($request->getLocale() ?: app()->getLocale());

        return response()->json([
            'locale'  => app()->getLocale(),
            'dir'     => config('app.available_locales.' . app()->getLocale() . '.dir', 'ltr'),
            'stories' => $stories,
        ]);
    }
}
