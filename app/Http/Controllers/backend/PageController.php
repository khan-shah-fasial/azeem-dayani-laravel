<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.website_settings.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.website_settings.pages.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->type = "custom_page";
            $page->content = $request->content;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->save();

            $response = [
                'status' => true,
                'notification' => 'Page Created successfully!',
            ];

            return response()->json($response);
        }
        $response = [
            'status' => false,
            'notification' => 'Slug has been used already',
        ];

        return response()->json($response);

        // Flash warning message using session
        // session()->flash('warning', __('Slug has been used already'));
        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //  $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('slug', $id)->first();
        $film = Product::where('is_active', 1)->where('categories_id', 1)->get();
        $non_film = Product::where('is_active', 1)->where('categories_id', 2)->get();

        if ($page != null) {
            if ($page_name == 'home') {
                return view('backend.website_settings.pages.home_page_edit', compact('page', 'film', 'non_film'));
            } elseif ($page->type == 'about_us') {
                return view('backend.website_settings.pages.about_page_edit', compact('page'));
            } elseif ($page->type == 'contact_us') {
                return view('backend.website_settings.pages.contact_us_page_edit', compact('page'));
            } elseif ($page->type == 'works') {
                return view('backend.website_settings.pages.works_page_edit', compact('page'));
            } elseif ($page->type == 'gallery') {
                return view('backend.website_settings.pages.gallery_page_edit', compact('page'));
            } elseif ($page->type == 'achivements') {
                return view('backend.website_settings.pages.achivements_page_edit', compact('page'));
            } elseif ($page->type == 'partner_with_us') {
                return view('backend.website_settings.pages.partner_with_us_page_edit', compact('page', 'products', 'post_categories', 'product_categories'));
            } else {
                return view('backend.website_settings.pages.edit', compact('page'));
            }
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        if (Page::where('id', '!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            
            if ($page->type == 'custom_page') {
                $page->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }

            $page_content = json_decode($page->content);

            if ($page->type == 'home_page') {

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',
                    
                    'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'banner_text' => 'required|max:255',

                    'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'about_content' => 'required',

                    'ows_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'ows_content' => 'required',

                    'achivements_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'achivements_banner_bg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'achivements_content' => 'required',
                    
                    'film_catg' => 'required|array',
                    'non_film_catg' => 'required|array',

                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                // Initialize content array
                $content = [
                    'about_content' => $request->input('about_content'),
                    'banner_text' => $request->input('banner_text'),
                    'ows_content' => $request->input('ows_content'),
                    'achivements_content' => $request->input('achivements_content'),
                    'film_catg' => json_encode($request->input('film_catg')),
                    'non_film_catg' => json_encode($request->input('non_film_catg')),
                ];

                // Handle About Image Upload
                if ($request->hasFile('banner')) {
                    if (isset($page_content->banner)){
                        Storage::disk('public')->delete($page_content->banner);
                    }
                    $content['banner'] = $request->file('banner')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['banner'] = $page_content->banner ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('about_image')) {
                    if (isset($page_content->about_image)) {
                        Storage::disk('public')->delete($page_content->about_image);
                    }
                    $content['about_image'] = $request->file('about_image')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['about_image'] = $page_content->about_image ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('ows_image')) {
                    if (isset($page_content->ows_image)) {
                        Storage::disk('public')->delete($page_content->ows_image);
                    }
                    $content['ows_image'] = $request->file('ows_image')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['ows_image'] = $page_content->ows_image ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('achivements_image')) {
                    if (isset($page_content->achivements_image)) {
                        Storage::disk('public')->delete($page_content->achivements_image);
                    }
                    $content['achivements_image'] = $request->file('achivements_image')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['achivements_image'] = $page_content->achivements_image ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('achivements_banner_bg')) {
                    if (isset($page_content->achivements_banner_bg)) {
                        Storage::disk('public')->delete($page_content->achivements_banner_bg);
                    }
                    $content['achivements_banner_bg'] = $request->file('achivements_banner_bg')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['achivements_banner_bg'] = $page_content->achivements_banner_bg ?? null;
                }

            }

            if ($page->type == 'contact_us'){

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',

                    'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
        
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                // Handle About Image Upload
                if ($request->hasFile('image')) {
                    if (isset($page_content->image)) {
                        Storage::disk('public')->delete($page_content->image);
                    }
                    $content['image'] = $request->file('image')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['image'] = $page_content->image ?? null;
                }

            }

            if ($page->type == 'gallery'){

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',

                    'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'video.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

                    'url.*' => 'required',
    
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
        
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                $oldData = $request->input('existing_banner_image') ?? [];

                // Storing new images
                $newImages = [];
                if ($request->has('image')) {
                    foreach ($request->file('image') as $index => $file) {
                        $imagePath = $file->store('assets/images', 'public');
                        $newImages[$index] = $imagePath;
                    }
                }
                
                // Handling image count and merging old/new images
                $images = [];
                $imgCount = count($request->input('img_count'));
                
                for ($key = 0; $key < $imgCount; $key++) {
                    if (isset($newImages[$key])) {
                        $images[$key] = $newImages[$key];


                    } else {
                        // $oldImageKey = "oldData[$key]";
                        
                        if (isset($oldData[$key])) {

                            $images[$key] = $oldData[$key];
                        } else {

                            $images[$key] = $oldData[$key + 1] ?? null;
                        }
                    }
                }

                $content['image'] = $images;

                $oldData_video = $request->input('existing_banner_video') ?? [];

                // Storing new images
                $newvideo = [];
                if ($request->has('video')) {
                    foreach ($request->file('video') as $index => $file) {
                        $imagePath_v = $file->store('assets/images', 'public');
                        $newvideo[$index] = $imagePath_v;
                    }
                }
                
                // Handling image count and merging old/new images
                $video = [];
                $videoCount = count($request->input('video_count'));
                
                for ($key = 0; $key < $videoCount; $key++) {
                    if (isset($newvideo[$key])) {
                        $video[$key] = $newvideo[$key];


                    } else {
                        // $oldImageKey = "oldData[$key]";
                        
                        if (isset($oldData_video[$key])) {

                            $video[$key] = $oldData_video[$key];
                        } else {

                            $video[$key] = $oldData_video[$key + 1] ?? null;
                        }
                    }
                }

                $content['video_image'] = $video;
                $content['url'] = $request->input('url') ?? [];


                $page->title = $request->title;
                $page->slug = $slug;
                $page->is_active = $request->is_active;
                $page->meta_title = $request->meta_title;
                $page->meta_description = $request->meta_description;
                $page->content = json_encode($content);
                $page->save();
    
                $response = [
                    'status' => true,
                    'notification' => 'Page updated successfully!',
                ];
    
                return response()->json($response);

            }

            if ($page->type == 'achivements'){

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',

                    'sec_title' => 'required',
                    'sec_description' => 'required',

                    'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'img_title.*' => 'required',
    
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
        
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                $oldData = $request->input('existing_banner_image') ?? [];

                // Storing new images
                $newImages = [];
                if ($request->has('image')) {
                    foreach ($request->file('image') as $index => $file) {
                        $imagePath = $file->store('assets/images', 'public');
                        $newImages[$index] = $imagePath;
                    }
                }
                
                // Handling image count and merging old/new images
                $images = [];
                $imgCount = count($request->input('img_count'));
                
                for ($key = 0; $key < $imgCount; $key++) {
                    if (isset($newImages[$key])) {
                        $images[$key] = $newImages[$key];


                    } else {
                        // $oldImageKey = "oldData[$key]";
                        
                        if (isset($oldData[$key])) {

                            $images[$key] = $oldData[$key];
                        } else {

                            $images[$key] = $oldData[$key + 1] ?? null;
                        }
                    }
                }

                $content['image'] = $images;

                $oldData_video = $request->input('existing_banner_video') ?? [];

                // Storing new images
                $newvideo = [];
                if ($request->has('video')) {
                    foreach ($request->file('video') as $index => $file) {
                        $imagePath_v = $file->store('assets/images', 'public');
                        $newvideo[$index] = $imagePath_v;
                    }
                }
                
                // Handling image count and merging old/new images
                $video = [];
                $videoCount = count($request->input('video_count'));
                
                for ($key = 0; $key < $videoCount; $key++) {
                    if (isset($newvideo[$key])) {
                        $video[$key] = $newvideo[$key];


                    } else {
                        // $oldImageKey = "oldData[$key]";
                        
                        if (isset($oldData_video[$key])) {

                            // echo"<pre>";
                            // echo"work video";
                            // echo"</pre>";

                            $video[$key] = $oldData_video[$key];
                        } else {

                            // echo"<pre>";
                            // echo"no";
                            // echo"</pre>";

                            $video[$key] = $oldData_video[$key + 1] ?? null;
                        }
                    }
                }

                // exit();

                $content['video_image'] = $video;
                $content['url'] = $request->input('url') ?? [];

                $content["img_title"] = $request->input('img_title') ?? [];
                $content["video_title"] = $request->input('video_title') ?? [];

                $content["sec_title"] = $request->input('sec_title') ?? '';
                $content["sec_description"] = $request->input('sec_description') ?? '';



                $page->title = $request->title;
                $page->slug = $slug;
                $page->is_active = $request->is_active;
                $page->meta_title = $request->meta_title;
                $page->meta_description = $request->meta_description;
                $page->content = json_encode($content);
                $page->save();
    
                $response = [
                    'status' => true,
                    'notification' => 'Page updated successfully!',
                ];
    
                return response()->json($response);

            }

            if ($page->type == 'works'){

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',

                    'description' => 'required',
    
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
        
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                $content['description'] = $request->input('description') ?? null;

            }

            if ($page->type == 'about_us') {
                
                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',

                    'ab_img_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'ab_img_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'ab_title' => 'required|max:255',
                    'ab_description' => 'required',

                    'ab_journey_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'ab_journey_title' => 'required|max:255',
                    'ab_journey_description' => 'required',

                    'ab_vision_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                    'ab_vision_title' => 'required|max:255',
                    'ab_vision_sub_title' => 'required|max:255',
                    'ab_vision_description' => 'required',

                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
        
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                // Initialize content array
                $content = [
                    'ab_title' => $request->input('ab_title'),
                    'ab_description' => $request->input('ab_description'),
                    'ab_journey_title' => $request->input('ab_journey_title'),
                    'ab_journey_description' => $request->input('ab_journey_description'),
                    'ab_vision_title' => $request->input('ab_vision_title'),
                    'ab_vision_sub_title' => $request->input('ab_vision_sub_title'),
                    'ab_vision_description' => $request->input('ab_vision_description'),
                ];

                // Handle About Image Upload
                if ($request->hasFile('ab_img_1')) {
                    if (isset($page_content->ab_img_1)) {
                        Storage::disk('public')->delete($page_content->ab_img_1);
                    }
                    $content['ab_img_1'] = $request->file('ab_img_1')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['ab_img_1'] = $page_content->ab_img_1 ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('ab_img_2')) {
                    if (isset($page_content->ab_img_2)) {
                        Storage::disk('public')->delete($page_content->ab_img_2);
                    }
                    $content['ab_img_2'] = $request->file('ab_img_2')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['ab_img_2'] = $page_content->ab_img_2 ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('ab_journey_img')) {
                    if (isset($page_content->ab_journey_img)) {
                        Storage::disk('public')->delete($page_content->ab_journey_img);
                    }
                    $content['ab_journey_img'] = $request->file('ab_journey_img')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['ab_journey_img'] = $page_content->ab_journey_img ?? null;
                }

                // Handle About Image Upload
                if ($request->hasFile('ab_vision_img')) {
                    if (isset($page_content->ab_vision_img)) {
                        Storage::disk('public')->delete($page_content->ab_vision_img);
                    }
                    $content['ab_vision_img'] = $request->file('ab_vision_img')->store('assets/images', 'public');
                } else {
                    // Retain the existing image
                    $content['ab_vision_img'] = $page_content->ab_vision_img ?? null;
                }


            } elseif ($page->type == 'partner_with_us') {

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',
                    'about_content' => 'required',
                    'question' => 'required|max:255',
                    'answer' => 'required',
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                // Initialize content array
                $content = [
                    'about_content' => $request->input('about_content'),
                ];

                // Handle FAQ's Section
                $faqs = [];
                foreach ($request->input('question', []) as $key => $question) {
                    $faqs[] = [
                        'question' => $question,
                        'answer' => $request->input('answer', [])[$key] ?? '', // Use 'answer' instead of 'team_description'
                    ];
                }
                // Save faqs array to the database or use it as needed
                $content['faqs'] = $faqs;

            } elseif ($page->type == 'custom_page') {

                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:155',
                    'slug' => 'required',
                    'is_active' => 'required|boolean',
                    'content' => 'required',
                    'meta_title' => 'required|max:255',
                    'meta_description' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'notification' => $validator->errors()->all()
                    ], 200);
                }

                if (!empty($request->input('slug'))) {
                    $slug = customSlug($request->input('slug'));
                }

                $content = $request->content;

            }

            $page->title = $request->title;
            $page->slug = $slug;
            $page->is_active = $request->is_active;
            $page->meta_title = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->content = $content;
            $page->save();

            $response = [
                'status' => true,
                'notification' => 'Page updated successfully!',
            ];

            return response()->json($response);

            // Redirect back with success message
            // return redirect()->route('website.pages')->with('success', '');
        }

        $response = [
            'status' => false,
            'notification' => 'Slug has been used already',
        ];

        return response()->json($response);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if (!$page) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $page->delete();

        $response = [
            'status' => true,
            'notification' => 'Page Deleted successfully!',
        ];

        return response()->json($response);
    }

    // public function show_custom_page($slug)
    // {
    //     $page = Page::where('slug', $slug)->first();
    //     if ($page != null) {
    //         return view('frontend.custom_page', compact('page'));
    //     }
    //     abort(404);
    // }
}
