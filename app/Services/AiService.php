<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    protected array $faq = [
        'lead time' => 'Westforge Closet Co. typically manufactures custom closet systems in 3–5 weeks after design approval. Complex walk-ins or specialty finishes may add 1–2 weeks.',
        'materials' => 'We manufacture with furniture-grade plywood, thermofoil and wood-veneer panels, soft-close hardware, aluminum hanging rails, and optional glass or leather accents.',
        'warranty' => 'Every Westforge system includes a limited lifetime warranty on cabinetry construction and a 5-year hardware warranty when installed by our certified crews.',
        'measure' => 'We schedule an in-home measure after your design consultation. Precise laser measurements feed our CNC nesting software before panels leave the factory.',
        'cost' => 'Reach-in systems commonly start around $1,800–$3,500. Full walk-in suites typically range $6,500–$18,000 depending on footprint, finishes, and accessories.',
        'install' => 'Factory-trained installers complete most reach-ins in a half day and walk-ins in one to two days. We protect floors, haul packaging, and leave the space broom-clean.',
        'styles' => 'We manufacture modern flat-panel, Shaker, frameless European, and transitional systems with finishes from matte white to walnut veneer and custom paint colors.',
        'contact' => 'Call (503) 555-0187, email hello@westforgecloset.com, or use the contact form. Showroom visits are by appointment in Portland, Oregon.',
    ];

    public function chat(string $message, string $context = 'public'): string
    {
        $key = config('services.openai.key') ?: env('OPENAI_API_KEY');
        $gemini = config('services.gemini.key') ?: env('GEMINI_API_KEY');

        if ($key) {
            $reply = $this->callOpenAi($message, $context, $key);
            if ($reply) {
                return $reply;
            }
        }

        if ($gemini) {
            $reply = $this->callGemini($message, $context, $gemini);
            if ($reply) {
                return $reply;
            }
        }

        return $this->demoReply($message, $context);
    }

    public function generateContent(string $prompt, string $type = 'blog'): string
    {
        $key = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if ($key) {
            $reply = $this->callOpenAi(
                "Write a {$type} for a US custom closet manufacturer named Westforge Closet Co. Prompt: {$prompt}",
                'generator',
                $key
            );
            if ($reply) {
                return $reply;
            }
        }

        return match ($type) {
            'product' => "Westforge {$prompt}: precision CNC-cut panels, soft-close hardware, and factory-finished surfaces engineered for lasting daily use. Available in multiple finishes with modular accessories.",
            'description' => "Discover Westforge Closet Co.'s {$prompt} — manufactured in our Portland facility with furniture-grade materials and measured for a perfect fit.",
            'automation' => "Automation suggestion for {$prompt}: create a Filament workflow that flags low-stock hanging rods, auto-schedules measure appointments after deposit invoices, and drafts follow-up emails 48 hours after install.",
            default => "## {$prompt}\n\nCustom closets from Westforge Closet Co. start with a design consultation, laser measure, and CNC manufacturing. Our Portland factory builds frameless systems tailored to your footprint, then certified installers complete white-glove delivery.",
        };
    }

    public function troubleshoot(string $issue): string
    {
        $key = config('services.openai.key') ?: env('OPENAI_API_KEY');
        if ($key) {
            $reply = $this->callOpenAi(
                "You are the Westforge Closet Co. shop floor assistant. Help diagnose: {$issue}",
                'troubleshoot',
                $key
            );
            if ($reply) {
                return $reply;
            }
        }

        $lower = Str::lower($issue);
        if (str_contains($lower, 'hinge') || str_contains($lower, 'door')) {
            return "Check hinge cup depth (35mm standard), confirm overlay vs inset mapping, and verify soft-close dampers are seated. Re-square the door and adjust the lateral screw before remounting.";
        }
        if (str_contains($lower, 'drawer') || str_contains($lower, 'slide')) {
            return "Confirm full-extension slides are parallel and fully clipped. Check for debris in the track, verify drawer box squareness, and re-seat the soft-close trigger if the drawer fails to latch.";
        }
        if (str_contains($lower, 'stock') || str_contains($lower, 'inventory')) {
            return "Open Inventory in Filament, filter products below reorder level, create a PO for aluminum rails and shelf pins first, then sync received qty after the freight ticket arrives.";
        }

        return "Document the SKU, order number, and photo of the issue. Check the CNC nest sheet for cut tolerances, confirm finish batch codes match the work order, and escalate to the shop lead if panels are out of square more than 1.5mm.";
    }

    protected function callOpenAi(string $message, string $context, string $key): ?string
    {
        try {
            $system = $this->systemPrompt($context);
            $response = Http::withToken($key)
                ->timeout(30)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
                    'messages' => [
                        ['role' => 'system', 'content' => $system],
                        ['role' => 'user', 'content' => $message],
                    ],
                    'temperature' => 0.6,
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'choices.0.message.content'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function callGemini(string $message, string $context, string $key): ?string
    {
        try {
            $model = env('GEMINI_MODEL', 'gemini-1.5-flash');
            $response = Http::timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                    'contents' => [
                        ['parts' => [['text' => $this->systemPrompt($context)."\n\nUser: {$message}"]]],
                    ],
                ]);

            if ($response->successful()) {
                return trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }

    protected function systemPrompt(string $context): string
    {
        return "You are the AI assistant for Westforge Closet Co., a US custom closet manufacturer in Portland, Oregon. Context mode: {$context}. Be concise, practical, and brand-aligned. Never invent unsafe installation advice.";
    }

    protected function demoReply(string $message, string $context): string
    {
        $lower = Str::lower($message);

        foreach ($this->faq as $needle => $answer) {
            if (str_contains($lower, $needle)) {
                return $answer;
            }
        }

        if ($context === 'automation') {
            return 'Suggested automation: when an order moves to "ready for install", auto-create an appointment for the assigned installer and send the customer a prep checklist via email.';
        }

        return 'Thanks for reaching out to Westforge Closet Co. We manufacture custom reach-in and walk-in closet systems in Portland. Ask about lead times, materials, pricing ranges, warranties, or book a measure — or visit /contact to schedule a design consult.';
    }
}
