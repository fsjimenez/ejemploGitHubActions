<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Author;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Obtener todas las reseñas
    public function index()
    {
        return response()->json(Review::all(), 200);
    }

    // Obtener una reseña por su ID
    public function show($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        return response()->json($review, 200);
    }

    // Crear una nueva reseña
    public function store(Request $request)
    {
        $this->validate($request, [
            'author_id' => 'required|exists:authors,id',  // Aseguramos que el autor existe
            'review_text' => 'required|string',
            'rating' => 'required|integer|between:1,5',   // Calificación entre 1 y 5
        ]);

        $review = Review::create($request->all());
        return response()->json($review, 201);
    }

    // Actualizar una reseña
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $this->validate($request, [
            'review_text' => 'sometimes|string',
            'rating' => 'sometimes|integer|between:1,5',
        ]);

        $review->update($request->all());
        return response()->json($review, 200);
    }

    // Eliminar una reseña
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted'], 200);
    }

    // Obtener todas las reseñas de un autor específico
    public function getReviewsByAuthor($authorId)
    {
        $author = Author::find($authorId);
        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $reviews = $author->reviews;  // Usamos la relación definida en el modelo Author
        return response()->json($reviews, 200);
    }
}
