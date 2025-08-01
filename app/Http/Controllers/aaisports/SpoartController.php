<?php

namespace App\Http\Controllers\aaisports;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\aaisports\Aaisports;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\Validator;
class SpoartController extends Controller
{
    

// api get airport

// public function fetchEncryptedData()
// {
//     $lang = 'en';

//     $publicKey = file_get_contents(storage_path('keys/public.pem'));

//     $payload = [
//         'lang' => $lang,
//         'timestamp' => now()->timestamp,
//     ];

//     $data = json_encode($payload);

//     openssl_public_encrypt($data, $encrypted, $publicKey);

//     $encryptedPayload = base64_encode($encrypted);

//     $response = Http::withOptions([
//         'verify' => false,
//     ])->post('https://mgmt.aai.aero/api/secure/operational-airports', [
//         'encrypted' => $encryptedPayload,
//     ]);

//     if ($response->successful()) {
//         $responseData = $response->json();

//         $airports = [];

//         if (isset($responseData['terms']) && is_array($responseData['terms'])) {
//             foreach ($responseData['terms'] as $term) {
//                 if (isset($term['children']) && is_array($term['children'])) {
//                     foreach ($term['children'] as $child) {
//                         if (!empty($child['AIRPORT'])) {
//                             $airports[] = $child['AIRPORT'];
//                         }
//                     }
//                 }
//             }
//         }

//         // Optional: Sort alphabetically
//         sort($airports);
// DD($airports);
//         return view('your-view-name', compact('airports'));
//     } else {
//         return back()->with('error', 'Failed to fetch data.');
//     }
// }


     public function index()
    {

        $aaisports  = Aaisports::latest()->paginate(10);
        return view('admin.aaisports.aaisports-list')->with('aaisports', $aaisports );
    }


public function importCsv(Request $request)
{
    $request->validate([
        'upload_file' => 'required|file|mimes:csv,txt|max:5120',
    ]);

    $file = $request->file('upload_file');
    $path = $file->getRealPath();
    $inserted = 0;

    if (($handle = fopen($path, 'r')) !== false) {
        // 1) Read & normalize header
        $header = fgetcsv($handle);
        if (! $header) {
            fclose($handle);
            return back()->with('error', 'CSV header missing.');
        }
        $header = array_map(function ($key) {
            return strtolower(trim(str_replace([' ', '-'], '_', $key)));
        }, $header);

        // 2) Find index of upload_file column
        $uploadIndex = array_search('upload_file', $header);

        while (($row = fgetcsv($handle)) !== false) {
            // 3) If row has more fields than header, merge extras into upload_file
            if ($uploadIndex !== false && count($row) > count($header)) {
                $partsBefore = array_slice($row, 0, $uploadIndex);
                $extraParts  = array_slice($row, $uploadIndex);
                $merged      = implode(',', $extraParts);
                $row         = array_merge($partsBefore, [ $merged ]);
            }

            $data = @array_combine($header, $row);
            if (! $data) {
                continue;
            }

            // 4) Date‐range splitting
            if (! empty($data['document_date']) && str_contains($data['document_date'], 'to')) {
                [$from, $to] = explode('to', $data['document_date']);
                try {
                    $data['document_date'] = \Carbon\Carbon::createFromFormat('d/m/y', trim($from))->format('Y-m-d');
                    $data['document_date_to'] = \Carbon\Carbon::createFromFormat('d/m/y', trim($to))->format('Y-m-d');
                } catch (\Exception $e) {
                    // leave as null on parse errors
                    $data['document_date']    = null;
                    $data['document_date_to'] = null;
                }
            }

            if (! empty($data['created_date'])) {
                try {
                    $data['created_date'] = \Carbon\Carbon::createFromFormat('d/m/y', $data['created_date'])->format('Y-m-d');
                } catch (\Exception $e) {
                    $data['created_date'] = now()->format('Y-m-d');
                }
            }

            // 5) Validate row
            $validator = Validator::make($data, [
                'title'               => 'nullable|string|max:182',
                'page_title'          => 'nullable|string|max:182',
                'discription'         => 'nullable|string|max:113',
                'content_category'    => 'nullable|string|max:200',
                'region'              => 'nullable|string|max:200',
                'airport'             => 'nullable|string|max:100',
                'published_status'    => 'nullable|string|in:Yes,No',
                'document_number'     => 'nullable|string|max:150',
                'document_date'       => 'nullable|date_format:Y-m-d',
                'document_date_to'    => 'nullable|date_format:Y-m-d',
                'signing_authority'   => 'nullable|string|max:88',
                'email'               => 'nullable|email|max:160',
                'created_date'        => 'nullable|date',
                'upload_file'         => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                continue;
            }

            // 6) Insert into DB
            \App\Models\aaisports\Aaisports::create([
                'title'               => $data['title']               ?? null,
                'page_title'          => $data['page_title']          ?? null,
                'discription'         => $data['discription']         ?? null,
                'content_category'    => $data['content_category']    ?? null,
                'upload_file'         => $data['upload_file']         ?? null,
                'region'              => $data['region']              ?? null,
                'airport'             => $data['airport']             ?? null,
                'published_status'    => $data['published_status']    ?? 'No',
                'document_number'     => $data['document_number']     ?? null,
                'document_date'       => $data['document_date']       ?? null,
                'document_date_to'    => $data['document_date_to']    ?? null,
                'signing_authority'   => $data['signing_authority']   ?? null,
                'email'               => $data['email']               ?? null,
                'created_date'        => $data['created_date']        ?? now()->format('Y-m-d'),
                'created_at'          => now(),
            ]);

            $inserted++;
        }

        fclose($handle);
    }

    return redirect()->back()->with('success', "$inserted record(s) imported successfully.");
}



      public function updatespoarts(Request $request, $id)
{
    $lang = 'en';

    // Load the public key
    $publicKey = file_get_contents(storage_path('keys/public.pem'));

    // Prepare the payload
    $payload = [
        'lang' => $lang,
        'timestamp' => now()->timestamp,
    ];

    // Encrypt the payload
    $data = json_encode($payload);
    openssl_public_encrypt($data, $encrypted, $publicKey);
    $encryptedPayload = base64_encode($encrypted);

    // Send API request
    $response = Http::withOptions([
        'verify' => false,
    ])->post('https://mgmt.aai.aero/api/secure/operational-airports', [
        'encrypted' => $encryptedPayload,
    ]);

    $airports = [];

    if ($response->successful()) {
        $responseData = $response->json();

        if (isset($responseData['terms']) && is_array($responseData['terms'])) {
            foreach ($responseData['terms'] as $term) {
                if (isset($term['children']) && is_array($term['children'])) {
                    foreach ($term['children'] as $child) {
                        if (!empty($child['AIRPORT'])) {
                            $airports[] = $child['AIRPORT'];
                        }
                    }
                }
            }
        }

        sort($airports); // Optional
    } else {
        // Handle API error (log or notify)
        return back()->with('error', 'Failed to fetch airport data from API.');
    }

    // Get the record to update
    $aaisport = Aaisports::findOrFail($id);

    // dd($aaisport);

    // Return the view with the required data
    return view('admin.aaisports.aaisports-update', compact('aaisport', 'airports'));
}

public function updateAirports(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'nullable|string|max:182',
        'page_title' => 'nullable|string|max:182',
        'discription' => 'nullable|string|max:113', // or rename to 'description'
        'content_category' => 'nullable|string|max:200',
        'public_documents' => 'nullable|string|max:100',
        'upload_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'region' => 'nullable|string|max:200',
        'airport' => 'nullable|string|max:100',
        'published_status' => 'required|string|in:Yes,No',
        'document_number' => 'nullable|string|max:150',
        'document_date' => 'nullable|date_format:Y-m-d',
        'document_date_to' => 'nullable|date_format:Y-m-d',
        'signing_authority' => 'nullable|string|max:88',
        'email' => 'nullable|email|max:160',
        'created_date' => 'nullable|date',
    ]);

    $aaisport = Aaisports::findOrFail($id);

    $aaisport->fill($validated);

   if ($request->hasFile('upload_file')) {
    $file = $request->file('upload_file');
    $filename = time() . '_' . $file->getClientOriginalName();
    $destinationPath = 'files/scb/';
    $file->move(public_path($destinationPath), $filename);

    // Save full relative path to DB
    $aaisport->upload_file = $destinationPath . $filename;
}


    $aaisport->save();

    return redirect()->back()->with('success', 'Record updated successfully.');
}




           public function category_store(Request $request)
            {
                $request->validate([
                    'category_name' => 'required|string|max:255|unique:category,category_name',
                ]);

                Category::create(['category_name' => $request->category_name ?? '']);

                return back()->with('success', 'emp-laravel-employe-portal successfully uploaded.');
            }
 }