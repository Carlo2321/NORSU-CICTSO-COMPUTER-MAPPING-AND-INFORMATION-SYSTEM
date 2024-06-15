<?php
namespace App\Filament\Pages\Auth;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;


class Login extends \Filament\Pages\Auth\Login{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getUserNameFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getUserNameFormComponent(): Component
    {
        return TextInput::make('userName')
            ->label(_('Username'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'userName' => $data['userName'],
            'password' => $data['password'],
        ];
    }

}



