<?php

namespace App\Http\Controllers;

use App\Services\ZodiacService;
use Illuminate\Http\Request;

class ZodiacController extends Controller
{
    protected ZodiacService $zodiacService;

    public function __construct(ZodiacService $zodiacService)
    {
        $this->zodiacService = $zodiacService;
    }

    /**
     * Obtiene el signo zodiacal de una persona
     * POST /api/zodiac
     */
    public function getZodiac(Request $request)
    {
        $validated = $request->validate([
            'birth_date' => 'required|string'
        ]);

        $result = $this->zodiacService->getZodiacSign($validated['birth_date']);

        return response()->json($result);
    }

    /**
     * Obtiene todos los signos zodiacales
     * GET /api/zodiac/signs
     */
    public function getAllSigns()
    {
        $signs = $this->zodiacService->getAllZodiacSigns();

        return response()->json([
            'success' => true,
            'count' => count($signs),
            'signs' => $signs
        ]);
    }

    /**
     * Obtiene un signo específico
     * GET /api/zodiac/signs/{sign}
     */
    public function getSignByName($sign)
    {
        $signs = $this->zodiacService->getAllZodiacSigns();
        
        $signData = null;
        foreach ($signs as $s) {
            if (mb_strtolower($s['name']) === mb_strtolower($sign)) {
                $signData = $s;
                break;
            }
        }

        if (!$signData) {
            return response()->json([
                'success' => false,
                'error' => "El signo '{$sign}' no existe."
            ], 404);
        }

        return response()->json([
            'success' => true,
            'sign' => $signData
        ]);
    }

    /**
     * Obtiene la compatibilidad entre dos signos
     * POST /api/zodiac/compatibility
     */
    public function getCompatibility(Request $request)
    {
        $validated = $request->validate([
            'sign1' => 'required|string',
            'sign2' => 'required|string'
        ]);

        $result = $this->zodiacService->getCompatibility(
            $validated['sign1'],
            $validated['sign2']
        );

        return response()->json($result);
    }

    /**
     * Vista web para verificar el signo zodiacal
     * GET /zodiac
     */
    public function showForm()
    {
        return view('zodiac.form');
    }

    /**
     * Obtiene el resultado del signo zodiacal (vista web)
     * POST /zodiac
     */
    public function showResult(Request $request)
    {
        $validated = $request->validate([
            'birth_date' => 'required|string'
        ]);

        $result = $this->zodiacService->getZodiacSign($validated['birth_date']);

        return view('zodiac.result', ['result' => $result]);
    }
}
