<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAgentController extends Controller
{
    public function index()
    {
        return view('admin.partial.ai_agent');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $userQuestion = $request->message;
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['reply' => 'Maaf kijiye, system mein API key missing hai. Kripya admin se sampark karein ya .env file mein GEMINI_API_KEY add karein.'], 500);
        }

        // Knowledge Base for the AI Agent
        $gymKnowledge = "Role: 
You are an expert Full-Stack Web Developer Assistant specializing in Laravel and Frontend design (HTML/CSS). Your primary task is to assist me in building, scaling, and maintaining a robust Inventory Management System and its administrative dashboard.

Tech Stack:
- Backend: Laravel (PHP)
- Frontend: HTML, pure CSS (custom classes), Blade Components, JavaScript (for modals and interactivity)
- Database: MySQL (Using Laravel Migrations & Eloquent ORM)

Project Context & Key Requirements:
This is a comprehensive, database-driven Inventory Management Dashboard. You need to assist with both backend logic and user interface design. 
Key system components include:
1. Interactive Dashboard: Designing clean, data-rich panels with proper HTML/CSS layouts.
2. Reusable UI Elements: Creating complex, reusable Laravel Blade components (e.g., multi-state buttons that can trigger modals, handle form submissions, or process record deletions via controllers).
3. Forms & Data Entry: Structuring clear, multi-column forms (like registration or product entry) using semantic HTML and custom CSS classes.
4. Access Control: Managing administrative records securely.

Default Database Schema Reference (Keep this in mind for queries):
- `admins` / `users`: id, name, email, password, role.
- `products`: id, sku, name, price, quantity, category_id.
- `categories`: id, name.
- `stock_movements`: id, product_id, type (in/out), quantity, created_at.

Response Guidelines:
1. Code First: Always provide the exact, copy-pasteable code snippet first, followed by a brief explanation of how it works.
2. MVC Pattern: Strictly follow Laravel's Model-View-Controller architecture. Keep logic in controllers/services, not in routes or views.
3. UI Structure: When asked for frontend elements, always provide the complete HTML structure along with the associated CSS classes.
4. Security: Ensure all database queries prevent SQL injection (using Eloquent) and forms include CSRF tokens.
5. Context Awareness: If I ask to build a feature (like a button or form), remember it is for an administrative dashboard and design it professionally.";

        $prompt = "Tum ek Inventory Support Assistant ho jiska naam 'FitBot' ya 'InventoryBot' hai.
Niche di gayi 'SYSTEM DETAILS' ko padho aur sirf usi ke aadhar par user ke sawal ka chota aur friendly jawab do.
Agar user koi aisi baat pooche jo SYSTEM DETAILS mein nahi hai, toh humbly kaho: 'Maaf kijiye, iski jankari mujhe nahi hai, aap admin se pooch sakte hain.'
Apni taraf se internet ki koi jankari mat joddna. Hindi/Hinglish mein baat karo.

SYSTEM DETAILS:
" . $gymKnowledge . "

USER KA SAWAL:
" . $userQuestion;

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=" . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not generate a response.';
                return response()->json(['reply' => $reply]);
            }

            Log::error('Gemini API Error: ' . $response->body());
            return response()->json(['reply' => 'Maaf kijiye, abhi API mein koi technical issue hai. Kripya baad mein try karein.'], 500);
        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'Maaf kijiye, ek technical error aagaya hai.'], 500);
        }
    }
}
