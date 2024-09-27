<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Return the login form view
    }

    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $client = new Client();

        try {
            // Make an external API call using Guzzle to validate the user credentials
            $response = $client->post('https://seasiadtadtl02.epicorsaas.com/saas534third/api/v1/Ice.BO.UserFileSvc/ValidatePassword', [
                'auth' => ['techsupport', 'Password12345'], // Basic auth credentials
                'json' => [
                    'userID' => $request->username,  // Pass the username as userID
                    'password' => $request->password, // Pass the password
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // Check the response data for success
            if (isset($data['returnObj']) && $data['returnObj'] === true) {
                // Set session or authentication (if needed)
                Session::put('user', $request->username); // Save user in session for future use

                // Redirect to the 'sendInvoice' view
                return redirect()->route('sendInvoice');
                
                
            } else {
                // If authentication fails, redirect back with an error message
                return redirect()->back()->withErrors(['Invalid credentials, please try again.']);
            }
        } catch (\Exception $e) {
            // Handle exception or API failure
            return redirect()->back()->withErrors(['An error occurred: ' . $e->getMessage()]);
        }
    }

    public function sendInvoice()
    {
        return view('sendInvoice', ['title' => 'Send A/R Invoice']); // Return the sendInvoice view after successful login
    }

    public function logout(Request $request)
    {
        // Clear the session and log the user out
        Session::flush();

        // Redirect to the login page
        return redirect()->route('login');
    }
}

