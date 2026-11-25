<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Company Settings';

    protected static ?int $navigationSort = 99;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::get('company_name', 'Westforge Closet Co.'),
            'company_phone' => Setting::get('company_phone', '(503) 555-0187'),
            'company_email' => Setting::get('company_email', 'hello@westforgecloset.com'),
            'company_address' => Setting::get('company_address', '2140 NW Thurman St, Portland, OR 97210'),
            'whatsapp' => Setting::get('whatsapp', '+15035550187'),
            'tax_rate' => Setting::get('tax_rate', '0.00'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\TextInput::make('company_phone'),
                Forms\Components\TextInput::make('company_email')->email(),
                Forms\Components\Textarea::make('company_address')->rows(2),
                Forms\Components\TextInput::make('whatsapp'),
                Forms\Components\TextInput::make('tax_rate')->numeric()->suffix('%'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();
        foreach ($state as $key => $value) {
            Setting::set($key, is_null($value) ? null : (string) $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
