<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Models\FooterAdvert;
use App\Models\SideAdvert;

class BlogController extends Controller
{

    public function blog(Request $request)
    {
        $categories = BlogPost::distinct()->pluck('category');

        // Fetch posts for each category
        $categories = BlogPost::select('category')->distinct()->pluck('category');
        $postsByCategory = [];
        foreach ($categories as $category) {
            $postsByCategory[$category] = BlogPost::where('category', $category)->count();
        }

        // Fetch the first seven blog posts
        $cards = BlogPost::orderBy('created_at', 'desc')->take(4)->get();

        $posts = BlogPost::orderBy('created_at', 'desc')->take(4)->get();

        $page = $request->input('page', 1);
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $mostReadPosts = BlogPost::orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $hasMorePosts = BlogPost::count() > $offset + $perPage;

        // Get trending blog posts
        $trendingPosts = BlogPost::orderBy('created_at', 'desc')->take(20)->get();

        $blogPosts = BlogPost::orderBy('created_at', 'asc')->take(8)->get();

        // Fetch adverts
        $sideAdverts = SideAdvert::all();
        $footerAdverts = FooterAdvert::first();
     
   

        if ($request->ajax()) {
            return response()->json([
                'posts' => $mostReadPosts,
                'page' => $page,
                'hasMorePosts' => $hasMorePosts
            ]);
        }

        return view('pages.blog', compact('posts', 'cards', 'postsByCategory', 'categories', 'mostReadPosts', 'trendingPosts', 'blogPosts', 'page', 'hasMorePosts', 'sideAdverts', 'footerAdverts'));
    }

    public function showMostReadPosts(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $mostReadPosts = BlogPost::orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();

        $hasMorePosts = BlogPost::count() > $offset + $perPage;

        if ($request->ajax()) {
            return response()->json([
                'posts' => $mostReadPosts,
                'page' => $page,
                'hasMorePosts' => $hasMorePosts
            ]);
        }

        return view('pages.blog', compact('mostReadPosts', 'page', 'hasMorePosts'));
    }




    public function loadMorePosts(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 5; // Number of posts to load

        $posts = BlogPost::orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        return response()->json($posts);
    }


    public function single($id)
    {
        $post = BlogPost::findOrFail($id);
        
         $post->content = preg_replace_callback('/src="([^"]+)"/', function ($matches) {
        // Wrap the URL with the asset() helper function
        return 'src="' . asset($matches[1]) . '"';
    }, $post->content);
    
        $categories = BlogPost::select('category')->distinct()->pluck('category');
        $postsByCategory = [];
        foreach ($categories as $category) {
            $postsByCategory[$category] = BlogPost::where('category', $category)->count();
        }
        // Pass the $postsByCategory data to the view
        return view('pages.single_post', compact('post', 'categories', 'postsByCategory'));
    }

    public function post()
    {
        $categories = BlogPost::distinct()->pluck('category');
        $Posts = BlogPost::orderBy('created_at', 'desc')->get();
         $sideAdverts = SideAdvert::all();
        $footerAdverts = FooterAdvert::all();

        return view('pages.blog_form', compact('Posts', 'categories', 'sideAdverts', 'footerAdverts'));
    }

  public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

      // Store the image in the 'public/assets/images' directory
$imagePath = $request->file('file')->store('public/assets/images');

// Generate the URL to access the stored image
$imageUrl = asset('storage/app/' . $imagePath);



        return response()->json(['location' => $imageUrl]);
    }



public function store(Request $request)
{
    // Decode the JSON string into a PHP array
    $categories = json_decode($request->input('category'), true);

    // Validate only the necessary fields
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'author' => 'nullable|string',
    ]);

    // Handle image upload if exists
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = 'storage/images/' . $image->getClientOriginalName();
        $image->move(public_path('storage/images'), $image->getClientOriginalName());
        $validated['image'] = $imagePath;
    }

    // Replace relative image URLs with absolute URLs
    $content = $request->input('content');
    $content = preg_replace('/src="storage\/images\//', 'src="' . asset('storage/images/') . '/', $content);
    $validated['content'] = $content;

    // Convert category array to a JSON string (if you still want to store it this way)
    $validated['category'] = json_encode($categories);

    // Create new blog post
    $post = BlogPost::create($validated);

    return response()->json(['success' => true, 'post' => $post]);
}




    public function category(Request $request, $category)
    {
         
        $categories = BlogPost::select('category')->distinct()->pluck('category');
        $postsByCategory = [];
        foreach ($categories as $categori) {
            $postsByCategory[$categori] = BlogPost::where('category', $category)->count();
        }
     
        $fistpic = BlogPost::where('category', $category)->first();
        $count = BlogPost::where('category', $category)->count();
       
        $firstpic = $fistpic->image;
        $page = $request->input('page', 1);
      
        // Fetch blog posts with pagination
        $categoryPosts = BlogPost::where('category', $category)
            ->latest()
            ->paginate(6, ['*'], 'page', $page);

        if ($request->ajax()) {
            return response()->json([
                'posts' => $categoryPosts->items(),
                'nextPage' => $categoryPosts->nextPageUrl(),
                'prevPage' => $categoryPosts->previousPageUrl()
            ]);
        }
        
        return view('pages.category', compact('postsByCategory','categories','categori','categoryPosts', 'category', 'page', 'firstpic', 'count'));
    }

     public function storeSideAdvert(Request $request)
    {
        $request->validate([
            'sideadvert' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('sideadvert');
        $filePath = $file->storeAs('assets/images/side_adverts', $file->getClientOriginalName(), 'public');

        SideAdvert::create(['file_path' => $filePath]);

        return redirect()->back()->with('success', 'Side Advert uploaded successfully!');
    }

    public function storeFooterAdvert(Request $request)
    {
        $request->validate([
            'footeradvert' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('footeradvert');
        $filePath = $file->storeAs('assets/images/side_adverts', $file->getClientOriginalName(), 'public');

        FooterAdvert::create(['file_path' => $filePath]);

        return redirect()->back()->with('success', 'Footer Advert uploaded successfully!');
    }

    public function deleteAdvert($type, $id)
    {
        if ($type === 'side') {
            $advert = SideAdvert::findOrFail($id);
        } else if ($type === 'footer') {
            $advert = FooterAdvert::findOrFail($id);
        } else {
            return redirect()->back()->with('error', 'Invalid advert type');
        }

        Storage::disk('public')->delete($advert->file_path);
        $advert->delete();

        return redirect()->back()->with('success', 'Advert deleted successfully!');
    }

    public function getAdverts()
    {
        $sideAdverts = SideAdvert::all();
        $footerAdverts = FooterAdvert::all();

        return response()->json([
            'sideAdverts' => $sideAdverts,
            'footerAdverts' => $footerAdverts,
        ]);
    }
    
     public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->image) {
            \Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->route('post')->with('success', 'Post deleted successfully!');
    }
    
public function edit($id)
{
    $post = BlogPost::findOrFail($id); // Fetch the post by ID

    // Decode the JSON array stored in the 'category' field
    $categories = json_decode($post->category, true);

    return view('pages.edit', compact('post', 'categories')); // Pass the post and categories data to the view
}

public function update(Request $request, $id)
{
    $post = BlogPost::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'author' => 'required|string|max:255',
    ]);

    // Update post details
    $post->title = $request->title;
    $post->content = $request->content;
    $post->author = $request->author;
$categories = json_decode($request->category, true);
        $post->category = json_encode($categories);
    


    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = 'storage/images/' . $image->getClientOriginalName();
         $image->move(public_path('storage/images'), $image->getClientOriginalName());
        $post->image = $imagePath;
    }

    $post->save();

return response()->json(['success' => true, 'post' => $post]);}

}
