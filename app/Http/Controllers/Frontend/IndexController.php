<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class IndexController extends Controller
{
    public function Form_Save(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string|max:500',
        ]);
        
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validated->errors()->all()
            ], 200);
        }

        // // Store inquiry in the contact table and get the inserted ID
        // $enquiryId = DB::table('contact')->insertGetId([
        //     'page' => $page ?? null,
        //     'company_name' => $request->input('company_name', null),
        //     'full_name' => $request->input('full_name'),
        //     'mobile' => $request->input('mobile'),
        //     'email' => $request->input('email'),
        //     'product' => $request->input('product', null),
        //     'apply_for' => $request->input('apply_for', null),
        //     'type_code' => $request->input('type_code', null),
        //     'message' => $request->input('message', null),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);


        // Prepare data for sending the email
        $data = [
            'sender' => ['name' => 'Website Enquiry', 'email' => 'rashid.makent@gmail.com'],
            'to' => [['email' => 'khanfaisal.makent@gmail.com', 'name' => 'Azeem Dayani']],
            'subject' => 'New Contact Form Submission',
            'htmlContent' => "
                <h2>Contact Form Submission</h2>"
                . "<p><b>Full Name:</b> {$request->full_name}</p>"
                . "<p><b>Mobile:</b> {$request->mobile}</p>"
                . "<p><b>Email:</b> {$request->email}</p>"
                . ($request->filled('message') ? "<p><b>Message:</b> {$request->message}</p>" : ""),
        ];

        // Send the email using Brevo API
        $apiKey = env('BREVO_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => $apiKey,
        ])->post('https://api.brevo.com/v3/smtp/email', $data);

        if ($response->successful()) {
            return response()->json([
                'status' => true,
                'notification' => 'Thank you for contacting  Azeem Dayani! Your query has been received and our concerned team will reach out to you.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'notification' => 'Error submitting form. Please try again later.',
            ]);
        }
    }


    public function index()
    {
        // Cache the page content query for 60 minutes
        $page = Cache::remember('home_page_content', 60, function () {
            return DB::table('pages')->where('type', 'home_page')->first();
        });

        $data_page = $page->content;
        $decoded_data = json_decode($data_page);

        // Cache film categories
        $film_catg_list = isset($decoded_data->film_catg) ? $decoded_data->film_catg : [];
        $data['film_catg'] = Cache::remember('film_catg', 60, function () use ($film_catg_list) {
            return !empty($film_catg_list) 
                ? Product::where('is_active', 1)
                    ->whereIn('id', json_decode($film_catg_list))
                    ->select('title', 'slug', 'home_image')
                    ->get()
                : [];
        });

        // Cache non-film categories
        $non_film_catg_list = isset($decoded_data->non_film_catg) ? $decoded_data->non_film_catg : [];
        $data['non_film_catg'] = Cache::remember('non_film_catg', 60, function () use ($non_film_catg_list) {
            return !empty($non_film_catg_list)
                ? Product::where('is_active', 1)
                    ->whereIn('id', json_decode($non_film_catg_list))
                    ->select('title', 'slug', 'home_image')
                    ->get()
                : [];
        });

        // Directly assign remaining data (no caching needed here)
        $data['about_content'] = $decoded_data->about_content ?? '';
        $data['banner_text'] = $decoded_data->banner_text ?? '';
        $data['ows_content'] = $decoded_data->ows_content ?? '';
        $data['achivements_content'] = $decoded_data->achivements_content ?? '';
        $data['banner_img'] = $decoded_data->banner ?? '';
        $data['about_image'] = $decoded_data->about_image ?? '';
        $data['ows_image'] = $decoded_data->ows_image ?? '';
        $data['achivements_image'] = $decoded_data->achivements_image ?? '';
        $data['achivements_banner_bg'] = $decoded_data->achivements_banner_bg ?? '';

        return view('frontend.pages.home.index', compact('page', 'data'));
    }


//--------------=============================== other ================================------------------------------

    public function not_found(){

        return view('frontend.pages.404.index');
    }
    public function thank_you(){

        return view('frontend.pages.thankyou.index');
    }

//--------------=============================== other ================================------------------------------

//--------------=============================== Pages ================================------------------------------

    public function about_us(){
        
        $page = Cache::remember('about_us_page', 60, function () {
            return DB::table('pages')->where('type', 'about_us')->first();
        });

        $data_page = $page->content;
        $decoded_data = json_decode($data_page);

        $data['ab_title'] = $decoded_data->ab_title ?? '';
        $data['ab_description'] = $decoded_data->ab_description ?? '';
        $data['ab_journey_title'] = $decoded_data->ab_journey_title ?? '';
        $data['ab_journey_description'] = $decoded_data->ab_journey_description ?? '';
        $data['ab_vision_title'] = $decoded_data->ab_vision_title ?? '';
        $data['ab_vision_sub_title'] = $decoded_data->ab_vision_sub_title ?? '';
        $data['ab_vision_description'] = $decoded_data->ab_vision_description ?? '';
        $data['ab_img_1'] = $decoded_data->ab_img_1 ?? '';
        $data['ab_img_2'] = $decoded_data->ab_img_2 ?? '';
        $data['ab_vision_img'] = $decoded_data->ab_vision_img ?? '';
        
        return view('frontend.pages.about_us.index',compact('page', 'data'));
    }

    public function works_page(){
        
        $page = Cache::remember('works_page', 60, function () {
            return DB::table('pages')->where('type', 'works')->first();
        });
        
        $data_page = $page->content;
        $decoded_data = json_decode($data_page);

        $description = $decoded_data->description ?? '';

        // Cache the 'flims' query for 60 minutes
        $flims = Cache::remember('flims_list', 60, function () {
            return DB::table('products')
                ->where('categories_id', 1)
                ->orderBy('id', 'asc')
                ->get();
        });
        
        // Cache the 'non_flims' query for 60 minutes
        $non_flims = Cache::remember('non_flims_list', 60, function () {
            return DB::table('products')
                ->where('categories_id', 2)
                ->orderBy('id', 'asc')
                ->get();
        });
        
        return view('frontend.pages.works.index',compact('page','description','flims','non_flims'));
    }

    public function achievements_page(){
        
        $page = Cache::remember('achievements_page', 60, function () {
            return DB::table('pages')->where('type', 'achivements')->first();
        });

        $data_page = $page->content ?? '';
        $decoded_data = json_decode($data_page);

        $image = $decoded_data->image ?? '';
        $video_image = $decoded_data->video_image ?? '';
        $url = $decoded_data->url ?? '';
        $img_title = $decoded_data->img_title ?? '';
        $video_title = $decoded_data->video_title ?? '';
        $sec_title = $decoded_data->sec_title ?? '';
        $sec_description = $decoded_data->sec_description ?? '';

        return view('frontend.pages.achivements.index',compact('page','image','video_image','url','img_title','video_title','sec_title','sec_description'));
    }

    public function gallery_page(){
        
        $page = Cache::remember('gallery_page', 60, function () {
            return DB::table('pages')->where('type', 'gallery')->first();
        });
        
        $data_page = $page->content ?? '';
        $decoded_data = json_decode($data_page);
        
        $image = $decoded_data->image ?? '';
        $video_image = $decoded_data->video_image ?? '';
        $url = $decoded_data->url ?? '';
        
        return view('frontend.pages.gallery.index',compact('page','image','video_image','url'));
    }

    public function contact_us_page(){
        $page = Cache::remember('contact_us_page', 60, function () {
            return DB::table('pages')->where('type', 'contact_us')->first();
        });

        $data_page = $page->content ?? '';
        $decoded_data = json_decode($data_page);
        
        $image = $decoded_data->image ?? '';

        return view('frontend.pages.contact_us.index',compact('image'));
    }
    

//--------------=============================== Pages ================================------------------------------

//--------------=============================== contact form save ===========================------------------------------

    // public function contact_save(Request $request)
    // {
    //     $rules = [
    //         'cv' => 'nullable|mimetypes:application/pdf,application/msword',
    //         //'g-recaptcha-response' => 'required|captcha',
    //     ];
    
    //     $validator = \Validator::make($request->all(), $rules); // Pass $request->all() as the first argument
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'notification' => $validator->errors(),
    //         ]);
    //     }
    
    //     if ($request->hasFile('cv')) {
    //         $cvPath = $request->file('cv')->store('assets/image/pdf', 'public');
    //     } else {
    //         $cvPath = null; // Set to null if 'cv' is not provided
    //     }
    
    //     // Create the contact record, including 'cv' if provided
    //     $contactData = $request->all();
    //     $contactData['cv'] = $cvPath;

    //     $name = isset($contactData["name"]) ? $contactData["name"] : ' - ';
    //     $email = isset($contactData["email"]) ? $contactData["email"] : ' - ';
    //     $phone = isset($contactData["phone"]) ? $contactData["phone"] : ' - ';
    //     $services = isset($contactData["services"]) ? $contactData["services"] : ' - ';
    //     $description = isset($contactData["description"]) ? $contactData["description"] : ' - ';
    //     //$ip = isset($contactData["ip"]) ? $contactData["ip"] : ' - ';
    //     $section = isset($contactData["section"]) ? $contactData["section"] : ' - ';
    //     $ref_url = isset($contactData["ref_url"]) ? $contactData["ref_url"] : ' - ';
    //     $url = isset($contactData["url"]) ? $contactData["url"] : ' - ';
    //     $qualification = isset($contactData["qualification"]) ? $contactData["qualification"] : ' - ';

    //     // Create the contact record
    //     Contact::create($contactData);

    //     // Send email if $cvPath is not null

    //     $recipient = 'admin@seedlingassociates.com'; // Replace with the actual recipient email
    //     $subject = 'Lead Enquiry';

    //     $body = '<table>';
    //     $body .= "<tr><td style='width: 150px;'><strong>From :</strong></td><td>" . $name . ' ' . $email . "</td></tr></br>";
    //     $body .= "<tr><td style='width: 150px;'><strong>Form Name :</strong></td><td>" . $section . "</td></tr></br>";
    //     $body .= "<tr><td style='width: 150px;'><strong>Page URL :</strong></td><td>" . $url . "</td></tr></br><p></p>";
        
    //     $body .= "<tr><td style='width: 150px;'><strong>Full Name :</strong></td><td>" . $name . "</td></tr></br>";
    //     $body .= "<tr><td style='width: 150px;'><strong>Email Address :</strong></td><td>" . $email . "</td></tr></br>";
    //     $body .= "<tr><td style='width: 150px;'><strong>Phone Number :</strong></td><td>" . $phone . "</td></tr></br>";

    //     if (isset($contactData["description"]) || isset($contactData["services"])) {
    //         $body .= "<tr><td style='width: 150px;'><strong>Service Requested :</strong></td><td>" . ($services ?? 'Not provided') . "</td></tr></br>";
    //         $body .= "<tr><td style='width: 150px;'><strong>Description :</strong></td><td>" . ($description ?? 'Not provided') . "</td></tr></br><p></p>";
    //     } else {
    //         $body .= "<tr><td style='width: 150px;'><strong>Description :</strong></td><td>" . ($description ?? 'Not provided') . "</td></tr></br><p></p>";
    //     }
        
    //     /*
    //     $body .= "<tr><td style='width: 150px;'><strong>Ip :</strong></td><td>" . $ip . "</td></tr></br>";
    //     $body .= "<tr><td style='width: 150px;'><strong>User Location :</strong></td><td>" . 
    //                 ($user_data['city'] ?? 'null') . ' ' . 
    //                 ($user_data['region'] ?? 'null') . ' ' . 
    //                 ($user_data['country'] ?? 'null') . 
    //             "</td></tr></br>";
    //     */
    //     $body .= "<tr><td style='width: 150px;'><strong>Referrer URL :</strong></td><td>" . $ref_url . "</td></tr></br>";

    //     $body .= "<tr><td style='width: 150px;'><strong>Submitted Data :</strong></td><td>" . date('Y-m-d') . "</td></tr></br>";
    //     $body .= '</table>';

    //     if ($cvPath !== null) {
    //          // Optional attachments
    //         $attachments = [
    //             [
    //                 'path' => storage_path("app/public/$cvPath"), // Replace with the actual path
    //                 'name' => ''.$name.'.pdf', // Replace with the desired attachment name
    //             ],
    //             // Add more attachments if needed
    //         ];

    //         // Send the email
    //         sendEmail($recipient, $subject, $body, $attachments);

    //     } else {
    //         sendEmail($recipient, $subject, $body);
    //     }

    
    //     $response = [
    //         'status' => true,
    //         'notification' => 'Contact added successfully!',
    //     ];
    
    //     return response()->json($response);
    // }
   //--------------=============================== contact form save ===========================--------------------------
   

}