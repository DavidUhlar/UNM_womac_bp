<?php

namespace App\Http\Controllers;

use App\Models\Oznam;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function indexTag($id)
    {
        $oznam = Oznam::find($id);
        $tags = Tag::all();
        $associatedTags = $oznam ? $oznam->tags->pluck('id')->toArray() : [];
        return view('oznam.oznamTags', compact('oznam', 'tags', 'associatedTags'));
    }

    public function associateTag(Request $request, $oznamId)
    {
//        $request->validate([
//            'tag.*' => 'exists:tag,id',
//        ]);

        $tagIds = $request->input('tags');
        $oznam = Oznam::find($oznamId);
        $oznam->tags()->sync($tagIds);


        return redirect()->route('oznam.oznam');
    }
}
