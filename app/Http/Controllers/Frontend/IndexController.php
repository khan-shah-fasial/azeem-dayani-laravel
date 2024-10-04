<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    // public function Form_Save(Request $request)
    // {
    //     $formType = $request->input('form_type');

    //     // Validate data based on form type
    //     if ($formType === 'partner_us') {
    //         $page = 'Partner Us';
    //         $validated = Validator::make($request->all(), [
    //             'company_name' => 'required|string|max:255',
    //             'full_name' => 'required|string|max:255',
    //             'mobile' => 'required|string|max:20',
    //             'email' => 'required|email|max:255',
    //             'product' => 'required|string|max:255',
    //             'message' => 'nullable|string|max:500',
    //         ]);
    //     } 
    //     elseif ($formType === 'contact_us') {
    //         $page = 'Contact Us';
    //         $validated = Validator::make($request->all(), [
    //             'full_name' => 'required|string|max:255',
    //             'mobile' => 'required|string|max:20',
    //             'email' => 'required|email|max:255',
    //             'message' => 'nullable|string|max:500',
    //         ]);
    //     }
    //     elseif ($formType === 'career') {
    //         $page = 'Career';
    //         $validated = Validator::make($request->all(), [
    //             'full_name' => 'required|string|max:255',
    //             'mobile' => 'required|string|max:20',
    //             'email' => 'required|email|max:255',
    //             'apply_for' => 'required|string|max:255',
    //             'type_code' => 'required|string|max:255',
    //             'message' => 'nullable|string|max:500',
    //         ]);
    //     }

    //     if ($validated->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'notification' => $validated->errors()->all()
    //         ], 200);
    //     }

    //     // Store inquiry in the contact table and get the inserted ID
    //     $enquiryId = DB::table('contact')->insertGetId([
    //         'page' => $page,
    //         'company_name' => $request->input('company_name', null),
    //         'full_name' => $request->input('full_name'),
    //         'mobile' => $request->input('mobile'),
    //         'email' => $request->input('email'),
    //         'product' => $request->input('product', null),
    //         'apply_for' => $request->input('apply_for', null),
    //         'type_code' => $request->input('type_code', null),
    //         'message' => $request->input('message', null),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);


    //     // Prepare data for sending the email
    //     $data = [
    //         'sender' => ['name' => 'Saagar SCPL', 'email' => 'rashid.makent@gmail.com'],
    //         'to' => [['email' => 'umair.makent@gmail.com', 'name' => 'Saagar SCPL']],
    //         'subject' => 'New Contact Form Submission',
    //         'htmlContent' => "
    //             <h2>Contact Form Submission</h2>
    //             <p><b>Page:</b> {$page}</p>"
    //             . ($request->filled('company_name') ? "<p><b>Company Name:</b> {$request->company_name}</p>" : "")
    //             . "<p><b>Full Name:</b> {$request->full_name}</p>"
    //             . "<p><b>Mobile:</b> {$request->mobile}</p>"
    //             . "<p><b>Email:</b> {$request->email}</p>"
    //             . ($request->filled('product') ? "<p><b>Product:</b> {$request->product}</p>" : "")
    //             . ($request->filled('apply_for') ? "<p><b>Apply For:</b> {$request->apply_for}</p>" : "")
    //             . ($request->filled('type_code') ? "<p><b>Type Code:</b> {$request->type_code}</p>" : "")
    //             . ($request->filled('message') ? "<p><b>Message:</b> {$request->message}</p>" : ""),
    //     ];

    //     // Send the email using Brevo API
    //     $apiKey = env('MAIL_API');

    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'api-key' => $apiKey,
    //     ])->post('https://api.brevo.com/v3/smtp/email', $data);

    //     if ($response->successful()) {
    //         return response()->json([
    //             'status' => true,
    //             'notification' => 'Thank you for contacting Saagar SCPL! Your query has been received and our concerned team will reach out to you within 24 hours.',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'notification' => 'Error submitting form. Please try again later.',
    //         ]);
    //     }
    // }


    public function index()
    {
        // Fetch the page content
        $page = DB::table('pages')->where('type', 'home_page')->first();
        $data = $page->content;
        $decoded_data = json_decode($data);

        // Check if product_ids exists and is an array
        $productIds = isset($decoded_data->product_ids) ? explode(',', $decoded_data->product_ids) : [];

        // Check if product_category_id exists and is an array
        $productCategoryIds = isset($decoded_data->product_category_id) ? explode(',', $decoded_data->product_category_id) : [];

        // Fetch the products that are active and match the IDs, order by ID descending, and limit to 8
        $products = Product::where('is_active', 1)
            ->whereIn('id', $productIds)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        // Fetch the ProductCategory that are active and match the IDs, order by ID descending, and limit to 9
        $productCategories = ProductCategory::where('is_active', 1)
            ->whereIn('id', $productCategoryIds)
            ->orderBy('id', 'asc')
            ->limit(9)
            ->get();

        return view('frontend.pages.home.index', compact('page', 'products', 'productCategories'));
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
        
        $page = DB::table('pages')->where('type','about_us')->first();
        
        return view('frontend.pages.about_us.index',compact('page'));
    }

    public function works_page(){
        
        $page = DB::table('pages')->where('type','works')->first();
        
        return view('frontend.pages.works.index',compact('page'));
    }

    public function achievements_page(){
        
        $page = DB::table('pages')->where('type','achivements')->first();
        
        return view('frontend.pages.achivements.index',compact('page'));
    }

    public function gallery_page(){
        
        $page = DB::table('pages')->where('type','gallery')->first();
        
        return view('frontend.pages.gallery.index',compact('page'));
    }

    public function contact_us_page(){
        // $footer = DB::table('frontend_settings')->where('id', 1)->first(); // Use `first()` instead of `get()` to get a single record
        // $contacts = json_decode($footer->contacts);
        $contacts = '';

        return view('frontend.pages.contact_us.index',compact('contacts'));
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