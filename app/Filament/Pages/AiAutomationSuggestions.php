<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiAutomationSuggestions extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static string $view = 'filament.pages.ai-automation-suggestions';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $navigationLabel = 'Automation Ideas';

    protected static ?int $navigationSort = 11;

    public ?array $data = [];

    public ?string $result = null;

    public function mount(): void
    {
        $this->form->fill(['prompt' => 'closet production handoff']);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('prompt')
                    ->label('Process or bottleneck')
                    ->required()
                    ->rows(3),
            ])
            ->statePath('data');
    }

    public function generate(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->generateContent($state['prompt'], 'automation');
        Notification::make()->title('Automation suggestions ready')->success()->send();
    }
}
