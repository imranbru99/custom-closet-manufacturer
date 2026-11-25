<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiContentGenerator extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-content-generator';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $navigationLabel = 'Content Generator';

    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public ?string $result = null;

    public function mount(): void
    {
        $this->form->fill(['type' => 'blog', 'prompt' => '']);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')->options([
                    'blog' => 'Blog Post',
                    'product' => 'Product Description',
                    'description' => 'Service Copy',
                ])->required(),
                Forms\Components\Textarea::make('prompt')->required()->rows(4)->label('What should we write?'),
            ])
            ->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generateContent($state['prompt'], $state['type']);
        Notification::make()->title('Content generated')->success()->send();
    }
}
