<style>
    body {
        background-image: url('/imagenes/Background.png');

        background-size: cover;

    }
</style>
<x-guest-layout>

    <x-authentication-card>
        <div x-data=validar()>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <x-label for="rut" value="{{ __('Rut: ') }}" />
                    <x-input x-model="rut" @keyup="validarrut()" id="rut" class="block mt-1 w-full" type="text"
                        name="rut" :value="old('rut')" required autofocus autocomplete="rut" />
                </div>

                <div class="mt-4">
                    <x-label for="nombre" value="{{ __('Nombre: ') }}" />
                    <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')"
                        required autofocus autocomplete="nombre" />
                </div>
                <div class="mt-4">
                    <x-label for="apellidop" value="Apellido Paterno:" />
                    <x-input id="apellidop" class="block mt-1 w-full" type="text" name="apellidop" :value="old('apellidop')"
                        required autofocus autocomplete="apellidop" />
                </div>
                <div class="mt-4">
                    <x-label for="apellidom" value="Apellido Materno:" />
                    <x-input id="apellidom" class="block mt-1 w-full" type="text" name="apellidom" :value="old('apellidom')"
                        required autofocus autocomplete="apellidom" />
                </div>

                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="fecha_nacimiento" value="{{ __('Fecha nacimiento') }}" />
                    <x-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento"
                        :value="old('fecha_nacimiento')" required autofocus autocomplete="fecha_nacimiento" />
                </div>
                <div class="mt-4">
                    <x-label for="fecha_ingreso" value="{{ __('Fecha ingreso') }}" />
                    <x-input id="fecha_ingreso" class="block mt-1 w-full" type="date" name="fecha_ingreso"
                        :value="old('fecha_ingreso')" required autofocus autocomplete="fecha_ingreso" />
                </div>
                <div class="mt-4">
                    <x-label for="password" value="Contraseña:" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña:" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('ya estas registrado?') }}
                    </a>

                    <x-button class="ml-4" x-bind:disabled="formInvalid">
                        {{ __('Registrar') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>


<script>
    function validar() {
        return {
            rut: null,
            errorRut: false,
            formatorut: null,
            formInvalid: true,

            validarFormulario() {
                this.formInvalid = this.errorRut;
            },

            formatoRut() {
                return this.rut.slice(0, 2) + '.' + this.rut.slice(2, 5) + '.' + this.rut.slice(5, 8)
            },

            calcularDigitoVerificador() {
                let rutDigits = this.rut.slice(0, 8).split('').reverse().map(Number);
                let factor = 2;
                let suma = 0;

                for (let i = 0; i < rutDigits.length; i++) {
                    if (factor > 7) {
                        factor = 2;
                    }

                    suma += rutDigits[i] * factor;
                    factor++;
                }

                let verificador = 11 - (suma % 11);

                return verificador === 11 ? '0' : verificador
                r === 10 ? 'K' : String(verificador);
            },

            validarrut() {
                this.errorRut = !this.rut || this.rut.length !== 9;
                this.validarFormulario();

                if (!this.formInvalid) {

                    const digitoVerificadorCalculado = this.calcularDigitoVerificador();
                    this.formatorut = this.formatoRut() + '-' + digitoVerificadorCalculado;
                    if (String(digitoVerificadorCalculado) !== this.rut.slice(8, 9)) {
                        alert("Error: El RUT ingresado no es valido.");
                        this.errorRut = true;
                        this.validarFormulario();
                    }

                    console.log("Nombre:", this.nombre, "RUT:", this.rut, "formato:", this.formatorut);
                }
            },


        };
    }
</script>
