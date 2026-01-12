<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    /**
     * @OA\Post(
     *  path="/api/v1/send_sms",
     *  tags={"Auth Api"},
     *  description="Send verification sms",
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="multipart/form-data",
     *      @OA\Schema(
     *        @OA\Property(property="mobile", type="string", example="09371778560")
     *      )
     *    )
     *  ),
     *  @OA\Response(response=201, description="SMS sent"),
     *  @OA\Response(response=429, description="Please wait")
     * )
     */
    public function sendSms(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|min:10|max:15',
        ]);

        $mobile = $request->mobile;

        if (!SmsCode::checkTwoMiuntes($mobile)) {
            return response()->json([
                'result' => false,
                'message' => 'Please wait for two minutes',
            ], 429);
        }

        $code = rand(1111, 9999);
        SmsCode::createSmsCode($mobile, $code);

        return response()->json([
            'result' => true,
            'message' => 'send sms is done',
            'data' => [
                'mobile' => $mobile,
                'code'   => $code,
            ],
        ], 201);
    }

    /**
     * @OA\Post(
     *  path="/api/v1/verify_sms_code",
     *  tags={"Auth Api"},
     *  description="Verify sms code",
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\MediaType(
     *      mediaType="multipart/form-data",
     *      @OA\Schema(
     *        @OA\Property(property="mobile", type="string"),
     *        @OA\Property(property="code", type="string")
     *      )
     *    )
     *  ),
     *  @OA\Response(response=200, description="Verified"),
     *  @OA\Response(response=401, description="Invalid code")
     * )
     */
    public function verifySms(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|min:10|max:15',
            'code'   => 'required|string|min:4|max:6',
        ]);

        if (!SmsCode::checkCode($request->mobile, $request->code)) {
            return response()->json([
                'result' => false,
                'message' => 'Invalid or expired code',
            ], 401);
        }

        $user = User::firstOrCreate(
            ['mobile' => $request->mobile],
            ['password' => Hash::make(uniqid())]
        );

        return response()->json([
            'result' => true,
            'message' => 'Login successful',
            'data' => [
                'id'    => $user->id,
                'token' => $user->createToken('new Token')->plainTextToken,
            ],
        ], 200);
    }
}
