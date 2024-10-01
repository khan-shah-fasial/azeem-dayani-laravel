<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FrontendSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FrontendSettingsController extends Controller
{
    public function index()
    {
        $settings = FrontendSetting::first();
        return view('backend.pages.frontend_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('backend.pages.frontend_settings.create');
    }

    public function store(Request $request)
    {
        $frontendSetting = new FrontendSetting();
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            // 'pdf' => 'nullable|file|mimes:pdf',
            // 'contacts_address' => 'required',
            // 'contacts_email1' => 'required',
            // 'contacts_phone1' => 'required',
            // 'social_media_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'social_media_icon' => 'required',
            'social_media_url' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }


        // Handle About Image Upload
        if ($request->hasFile('logo')) {
            if ($frontendSetting->logo ?? false) {
                Storage::delete($frontendSetting->logo);
            }
            $logo = $request->file('logo')->store('assets/images', 'public');
        } else {
            // Retain the existing image
            $logo = $request->input('existing_logo') ?? $frontendSetting->logo;
        }
        

        // Prepare contacts array
        $contacts = [];
        $names = $request->input('contacts_name', []);
        $addresses = $request->input('contacts_address', []);
        $google_maps = $request->input('contacts_google_map', []);
        $emails1 = $request->input('contacts_email1', []);
        $emails2 = $request->input('contacts_email2', []);
        $emails3 = $request->input('contacts_email3', []);
        $phones1 = $request->input('contacts_phone1', []);
        $phones2 = $request->input('contacts_phone2', []);
        $phones3 = $request->input('contacts_phone3', []);

        foreach ($names as $index => $name) {
            $contacts[] = [
                'name' => $name,
                'address' => $addresses[$index] ?? '',
                'google_map' => $google_maps[$index] ?? '',
                'email1' => $emails1[$index] ?? '',
                'email2' => $emails2[$index] ?? '',
                'email3' => $emails3[$index] ?? '',
                'phone1' => $phones1[$index] ?? '',
                'phone2' => $phones2[$index] ?? '',
                'phone3' => $phones3[$index] ?? ''
            ];
        }

        // Remove empty contact entries
        $contacts = array_filter($contacts, function ($contact) {
            return !empty(array_filter($contact));
        });

        // Handle Banner Images
        $socialMedia = [];
        foreach ($request->input('social_media_url', []) as $key => $text) {
            // Check if a new file was uploaded for this banner
            if ($request->hasFile("social_media_icon.$key")) {
                $path = $request->file("social_media_icon.$key")->store('assets/images', 'public');
            } else {
                // Retain the existing image
                $path = $request->input('existing_social_media_icon')[$key] ?? null;
            }

            $socialMedia[] = [
                'icon' => $path,
                'url' => $text,
            ];
        }

        // Remove empty social media entries
        $socialMedia = array_filter($socialMedia, function ($media) {
            return !empty(array_filter($media));
        });

        // Handle PDF 
        if ($request->hasFile('pdf')) {
            $frontendSetting->pdf = $request->file('pdf')->store('assets/files', 'public');
        } else {
            $frontendSetting->pdf = $request->input('existing_pdf') ?? $frontendSetting->pdf;
        }

        $frontendSetting->logo = $logo;
        $frontendSetting->meta_title = $request->meta_title;
        $frontendSetting->meta_description = $request->meta_description;
        $frontendSetting->contacts = json_encode($contacts);
        $frontendSetting->social_media = json_encode($socialMedia);
        $frontendSetting->save();

        $response = [
            'status' => true,
            'notification' => 'Frontend Settings created successfully!',
        ];

        return response()->json($response);

    }

    public function edit(FrontendSetting $frontendSetting)
    {
        return view('backend.pages.frontend_settings.edit', compact('frontendSetting'));
    }

    public function update(Request $request, $id)
    {
        $frontendSetting = FrontendSetting::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
            // 'pdf' => 'nullable|file|mimes:pdf',
            // 'contacts_address' => 'required',
            // 'contacts_email1' => 'required',
            // 'contacts_phone1' => 'required',
            // 'social_media_icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'social_media_icon' => 'required',
            'social_media_url' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'notification' => $validator->errors()->all()
            ], 200);
        }


        // Handle About Image Upload
        if ($request->hasFile('logo')) {
            if ($frontendSetting->logo ?? false) {
                Storage::delete($frontendSetting->logo);
            }
            $logo = $request->file('logo')->store('assets/images', 'public');
        } else {
            // Retain the existing image
            $logo = $request->input('existing_logo') ?? $frontendSetting->logo;
        }
        

        // Prepare contacts array
        $contacts = [];
        $names = $request->input('contacts_name', []);
        $addresses = $request->input('contacts_address', []);
        $google_maps = $request->input('contacts_google_map', []);
        $emails1 = $request->input('contacts_email1', []);
        $emails2 = $request->input('contacts_email2', []);
        $emails3 = $request->input('contacts_email3', []);
        $phones1 = $request->input('contacts_phone1', []);
        $phones2 = $request->input('contacts_phone2', []);
        $phones3 = $request->input('contacts_phone3', []);

        foreach ($names as $index => $name) {
            $contacts[] = [
                'name' => $name,
                'address' => $addresses[$index] ?? '',
                'google_map' => $google_maps[$index] ?? '',
                'email1' => $emails1[$index] ?? '',
                'email2' => $emails2[$index] ?? '',
                'email3' => $emails3[$index] ?? '',
                'phone1' => $phones1[$index] ?? '',
                'phone2' => $phones2[$index] ?? '',
                'phone3' => $phones3[$index] ?? ''
            ];
        }

        // Remove empty contact entries
        $contacts = array_filter($contacts, function ($contact) {
            return !empty(array_filter($contact));
        });

        // Handle Banner Images
        $socialMedia = [];
        foreach ($request->input('social_media_url', []) as $key => $text) {
            // Check if a new file was uploaded for this banner
            // if ($request->hasFile("social_media_icon.$key")) {
            //     $path = $request->file("social_media_icon.$key")->store('assets/images', 'public');
            // } else {
            //     // Retain the existing image
            //     $path = $request->input('existing_social_media_icon')[$key] ?? null;
            // }
            $path = $request->input("social_media_icon.$key");
            $socialMedia[] = [
                'icon' => $path,
                'url' => $text,
            ];
        }

        // Remove empty social media entries
        $socialMedia = array_filter($socialMedia, function ($media) {
            return !empty(array_filter($media));
        });

        // Handle PDF 
        if ($request->hasFile('pdf')) {
            $frontendSetting->pdf = $request->file('pdf')->store('assets/files', 'public');
        } else {
            $frontendSetting->pdf = $request->input('existing_pdf') ?? $frontendSetting->pdf;
        }

        $frontendSetting->logo = $logo;
        $frontendSetting->meta_title = $request->meta_title;
        $frontendSetting->meta_description = $request->meta_description;
        $frontendSetting->contacts = json_encode($contacts);
        $frontendSetting->social_media = json_encode($socialMedia);
        $frontendSetting->save();

        $response = [
            'status' => true,
            'notification' => 'Frontend Settings updated successfully!',
        ];

        return response()->json($response);

        // return redirect()->route('frontend-settings.index')->with('success', 'updated successfully.');
    }

    public function destroy($id)
    {
        $FrontendSetting = FrontendSetting::find($id);
        if (!$FrontendSetting) {
            $response = [
                'status' => false,
                'notification' => 'Record not found.!',
            ];
            return response()->json($response);
        }
        $FrontendSetting->delete();

        $response = [
            'status' => true,
            'notification' => 'FrontendSetting Deleted successfully!',
        ];

        return response()->json($response);

        // $frontendSetting->delete();
        // return redirect()->route('frontend-settings.index')->with('success', 'Frontend Settings deleted successfully.');
    }
}