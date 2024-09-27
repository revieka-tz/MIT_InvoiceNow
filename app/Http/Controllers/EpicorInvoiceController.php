<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EpicorInvoiceController extends Controller
{
    //
    public function getHeaderAR(Request $request)
    {
        // Create a new Guzzle HTTP client
        $client = new Client();

        try {
            // Make a GET request to the API with Basic Authentication
            $response = $client->request('GET', 'https://seasiadtadtl02.epicorsaas.com/saas534third/api/v1/BaqSvc/MIT_AR_GetHeader(OJJF)/', [
                'auth' => ['techsupprt', 'Password12345'], // Replace with the actual username and password
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            // Parse the JSON response
            
            $data = json_decode($response->getBody()->getContents(), true);
            $invoices = $data['value'];
            // Return the response as JSON to be used in the frontend
            return response()->json(['invoices' => $invoices]);

        } catch (\Exception $e) {
            // If there is an error, return the error message
            return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        }
   }

   public function getApiData(Request $request)
    {
        // Create a new Guzzle HTTP client
        $client = new Client();

        try {
            // Make a GET request to the external API
            $response = $client->request('GET', 'https://seasiadtadtl02.epicorsaas.com/saas534third/api/v1/BaqSvc/MIT_AR_GetHeader(OJJF)/', [
                'auth' => ['techsupport', 'Password12345'], // Replace with the actual username and password
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            // Parse the JSON response
            $data = json_decode($response->getBody()->getContents(), true);

            // Return the response as JSON to the frontend
            return response()->json($data);
        } catch (\Exception $e) {
            // If there is an error, return the error message
            return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        }
    }
}

 