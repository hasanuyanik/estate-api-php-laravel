<?php

namespace App\Http\Controllers;

use App\Contracts\IAppointmentService;
use App\Contracts\IContactService;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class AppointmentController extends Controller
{
    /**
     * @var IAppointmentService
     */
    private IAppointmentService $appointmentService;

    /**
     * @var IContactService
     */
    private IContactService $contactService;

    /**
     * Create a new AuthController instance.
     *
     * @param IAppointmentService $appointmentService
     * @param IContactService $contactService
     * 
     * @return void
     */
    public function __construct(IAppointmentService $appointmentService, IContactService $contactService)
    {
        $this->appointmentService = $appointmentService;
        $this->contactService = $contactService;
    }

    public function create(Request $request)
    {
        $contact = $this->contactService->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'address' => $request->contactAddress,
            'phone' => $request->phone
        ]);

        $client = new \GuzzleHttp\Client();
        $endpoint = 'https://maps.googleapis.com/maps/api/distancematrix/json';

        $response = $client->request('GET', $endpoint, ['query' => [
            'destinations' => $request->appointmentAddress, 
            'origins' => env('REALTOR_ZIP_CODE'),
            'units' => 'imperial',
            'key' => env('GOOGLE_DISTANCE_MATRIX_API_KEY')
        ]]);
dd($response);
        $user = $this->appointmentService->create([
            'contact_id' => $contact->id,
            'address' => $request->appointmentAddress,
            'date' => $request->date,
            'distance',
            'estimate_departure' => $request->estimateDeparture,
            'return_time'
        ]);

        return response()->json([
            'message' => 'Created',
            'user' => $user
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}