<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PageContent;

class AdminPageController extends Controller
{
    public function edit($slug)
    {
        // For now, let's group by sections
        $contents = PageContent::where('page', $slug)->get()->groupBy('section');

        // If no content found, we might want to seed it or show empty
        return view('admin.pages.edit', compact('contents', 'slug'));
    }

    public function update(Request $request, $slug)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $id => $value) {
            $content = PageContent::find($id);
            if ($content && $content->page === $slug) {
                // If it's an image, handle upload
                if ($content->type === 'image' && $request->hasFile($id)) {
                    $path = $request->file($id)->store('uploads/pages', 'public');
                    $content->update(['value' => $path]);
                } else {
                    $content->update(['value' => $value]);
                }
            }
        }

        return back()->with('success', ucfirst($slug) . ' page updated successfully.');
    }
}
