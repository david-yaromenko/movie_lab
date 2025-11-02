<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{
    public function __construct(protected TagService $tagService) {}

    public function index()
    {

        $tags = $this->tagService->getAllTags();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {

        $this->tagService->create($request->toDto());

        return redirect()->route('admin.tags.index')->with('success', 'Tag created!');;
    }

    public function destroy(Tag $tag)
    {

        $this->tagService->delete($tag);

        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted!');;
    }
}
