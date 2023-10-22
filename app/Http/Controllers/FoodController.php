<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Food;

class FoodController extends Controller
{
    public function create (Request $request) {
        try {
            $newFood = $request -> validate ([
                'name' => ['required', 'unique:food'],
                'type' => ['required'],
                'ingredient' => ['required'],
                'prize' => ['required', 'numeric']
            ]);

            Food::create($newFood);
            return response() -> json ([
                'data' => $newFood,
                'message' => 'Makanan Berhasil Ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            return response() -> json ([
                'data' => NULL,
                'message' => $e -> getMessage(),
            ], 400);
        }
    }

    public function read () {
        $allFood = Food::latest() -> get();
        return response () -> json ([
            'data' => $allFood,
        ]);
    }

    public function update (Food $food, Request $request) {
        try {
            $request -> validate ([
                'name' => ['unique:food'],
                'prize' => ['numeric']
            ]);

            if(!$request['name'] and !$request['type'] and !$request['ingredient'] and !$request['prize']) {
                return response () -> json ([
                    'message' => 'Tidak Ada Data Yang Berubah'
                ]);
            }

            if ($request['name']) {
                $food -> name = $request['name'];
            }
            if ($request['type']) {
                $food -> type = $request['type'];
            }
            if ($request['ingredient']) {
                $food -> ingredient = $request['ingredient'];
            }
            if ($request['prize']) {
                $food -> prize = $request['prize'];
            }

            $food -> save();

            return response () -> json ([
                'data' => $food,
                'message' => 'Data Berhasil Berubah'
            ]);
        } catch (\Exception $e) {
            return response () -> json ([
                'data' => NULL,
                'message' => $e -> getMessage(),
            ], 400);
        }
    }

    public function delete (Food $food) {
        try {
            $food -> delete();
            return response () -> json ([
                'message' => 'Data Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response () -> json ([
                'data' => NULL,
                'message' => $e -> getMessage()
            ], 400);
        }
    }
}
