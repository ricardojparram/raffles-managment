<?php

namespace App\Filament\Pages\Auth;

use App\Enums\TeamType;
use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Revoltify\Subscriptionify\Models\Plan;

class Register extends BaseRegister
{
    protected \Filament\Support\Enums\Width|string|null $maxWidth = '2xl';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Step::make(__('Account Type'))
                        ->icon('heroicon-o-user-group')
                        ->description(__('Choose your account type'))
                        ->schema([
                            Radio::make('team_type')
                                ->label(__('What type of account do you need?'))
                                ->options([
                                    'individual' => __('Individual'),
                                    'organization' => __('Organization'),
                                ])
                                ->descriptions([
                                    'individual' => __('Personal account for managing your own raffles. Your organization will be created with your name.'),
                                    'organization' => __('For businesses and teams that need multiple users and advanced features.'),
                                ])
                                ->default('individual')
                                ->required()
                                ->live()
                                ->columnSpanFull(),
                        ]),

                    Step::make(__('Your Details'))
                        ->icon('heroicon-o-identification')
                        ->description(__('Create your account'))
                        ->schema([
                            $this->getNameFormComponent(),
                            $this->getEmailFormComponent(),
                            Select::make('country')
                                ->label(__('Country'))
                                ->searchable()
                                ->options(fn () => $this->getCountryOptions())
                                ->default('VE')
                                ->required(),
                            $this->getPasswordFormComponent(),
                            $this->getPasswordConfirmationFormComponent(),
                        ]),

                    Step::make(__('Organization'))
                        ->icon('heroicon-o-building-office')
                        ->description(__('Set up your organization'))
                        ->schema([
                            TextInput::make('team_name')
                                ->label(__('Organization Name'))
                                ->placeholder(__('e.g., My Company'))
                                ->required()
                                ->maxLength(255),
                        ])
                        ->visible(fn ($get) => $get('team_type') === 'organization'),
                ])
                    ->submitAction(new HtmlString(
                        '<button type="submit" class="fi-btn fi-btn-size-md relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50">'
                        . __('Create Account')
                        . '</button>'
                    ))
                    ->persistStepInQueryString()
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRegistration(array $data): \App\Models\User
    {
        return DB::transaction(function () use ($data) {
            // 1. Create the user
            $user = \App\Models\User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => $data['password'],
            ]);

            // 2. Determine team type and name
            $teamType = TeamType::from($data['team_type'] ?? 'individual');
            $teamName = $teamType === TeamType::Individual
                ? $data['name']       // Auto-use user's full name
                : $data['team_name']; // Use provided org name

            // 3. Create the team
            $team = Team::create([
                'name'    => $teamName,
                'type'    => $teamType,
                'country' => $data['country'] ?? null,
            ]);

            // 4. Attach user to team
            $team->users()->attach($user);

            // 5. Sync Spatie permissions team scope and assign admin role
            setPermissionsTeamId($team->id);
            setPermissionsTeamId($team->id);
            $user->assignRole('admin');

            // 6. Subscribe team to the free plan
            $freePlan = Plan::where('slug', 'free')->first();
            if ($freePlan) {
                $team->subscribe($freePlan);
            }

            return $user;
        });
    }

    protected function afterRegistration(): void
    {
        Notification::make()
            ->title(__('Welcome!'))
            ->body(__('Your account has been created successfully.'))
            ->success()
            ->send();
    }

    /**
     * ISO 3166-1 alpha-2 country list (LATAM focus, then rest of world).
     */
    private function getCountryOptions(): array
    {
        return [
            // LATAM — prioritized
            'VE' => '🇻🇪 Venezuela',
            'CO' => '🇨🇴 Colombia',
            'MX' => '🇲🇽 México',
            'AR' => '🇦🇷 Argentina',
            'CL' => '🇨🇱 Chile',
            'PE' => '🇵🇪 Perú',
            'EC' => '🇪🇨 Ecuador',
            'BR' => '🇧🇷 Brasil',
            'UY' => '🇺🇾 Uruguay',
            'PY' => '🇵🇾 Paraguay',
            'BO' => '🇧🇴 Bolivia',
            'PA' => '🇵🇦 Panamá',
            'CR' => '🇨🇷 Costa Rica',
            'DO' => '🇩🇴 República Dominicana',
            'GT' => '🇬🇹 Guatemala',
            'HN' => '🇭🇳 Honduras',
            'SV' => '🇸🇻 El Salvador',
            'NI' => '🇳🇮 Nicaragua',
            'CU' => '🇨🇺 Cuba',
            'PR' => '🇵🇷 Puerto Rico',
            // North America
            'US' => '🇺🇸 United States',
            'CA' => '🇨🇦 Canada',
            // Europe
            'ES' => '🇪🇸 España',
            'PT' => '🇵🇹 Portugal',
            'FR' => '🇫🇷 France',
            'DE' => '🇩🇪 Germany',
            'IT' => '🇮🇹 Italy',
            'GB' => '🇬🇧 United Kingdom',
            'NL' => '🇳🇱 Netherlands',
        ];
    }
}
