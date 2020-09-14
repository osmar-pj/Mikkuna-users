<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UbigeoPeruDistrict;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password', 'active']);

        if (! $token = auth('api')->attempt($credentials)) {
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
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 60 * 24
        ]);
    }

    public function guard() {
        return \Auth::Guard('api');
    }

    public function register(Request $request) {
        $data = new User;
        $data->empresa = $request->empresa;
        $data->mobile = $request->mobile;
        $data->servicio = $request->servicio;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->delivery = false;
        $data->premium = true;
        $data->active = $request->active;
        $data->mode = "empresa";

        $data->save();

        return response()->json([
            'registered' => true
        ]);
    }

    public function getEmpresaId(Request $request) {
        $empresa_id = $request->user();
        $empresa_id->week = unserialize($empresa_id->week);
        $distritos = UbigeoPeruDistrict::with('province')->with('department')->get();

        return response()->json([
            'data' => [
                'empresa_id' => $empresa_id,
                'distritos' => $distritos
            ]
        ]);
    }

    public function updateEmpresa(Request $request) {
        $data = json_decode($request->data);
        $empresa = $request->user()->empresa;
        if($request->imagen_empresa) {
            $imagen_empresa = $request->imagen_empresa;
            $path_public_imagen = $imagen_empresa->store('public');
            $path_imagen = explode('/', $path_public_imagen)[1];
            $imagen_empresa->storeAs('image_empresas', $empresa.'-'.$path_imagen);
        } else {
            $path_imagen = $request->user()->imagen_empresa;
        }

        if($request->logo_empresa) {
            $logo_empresa = $request->logo_empresa;
            $path_public_logo = $logo_empresa->store('public');
            $path_logo = explode('/', $path_public_logo)[1];
            $logo_empresa->storeAs('image_empresas', $empresa.'-'.$path_logo);
        } else {
            $path_logo = $request->user()->logo_empresa;
        }
        

        $empresa = User::where('id', $request->user()->id)->first();
        $empresa->empresa = $data->empresa;
        $empresa->name = $data->name;
        $empresa->mobile = $data->mobile;
        $empresa->slogan = $data->slogan;
        $empresa->descripcion = $data->descripcion;
        $empresa->address = $data->address;
        $empresa->servicio = $data->servicio;
        $empresa->delivery = $data->delivery;
        $empresa->imagen_empresa = $path_imagen;
        $empresa->logo_empresa = $path_logo;
        $empresa->district_id = $data->district_id;
        $empresa->hora_entrada = $data->hora_entrada;
        $empresa->hora_salida = $data->hora_salida;
        $empresa->week = serialize($data->week);
        $empresa->update();

        return response()->json([
            'updated' => true
        ]);
    }
}
