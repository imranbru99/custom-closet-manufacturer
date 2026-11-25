<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiTroubleshooter extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static string $view = 'filament.pages.ai-troubleshooter';

    protected static ?string $navigationGroup = 'AI Tools';

    protected static ?string $navigationLabel = 'Shop Troubleshooter';

    protected static ?int $navigationSort = 12;

    public ?array $data = [];

    public ?string $result = null;

    public function mount(): void
    {
        $this->form->fill(['issue' => '']);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('issue')
                    ->label('Describe the shop / install issue')
                    ->required()
                    ->rows(4),
            ])
            ->statePath('data');
    }

    public function diagnose(AiService $ai): void
    {
        $state = $this->form->getState();
        $this->result = $ai->troubleshoot($state['issue']);
        Notification::make()->title('Diagnosis ready')->success()->send();
    }
}
