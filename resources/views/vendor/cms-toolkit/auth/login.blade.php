<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        @include('cms-toolkit::partials.head')
    </head>
    <body class="env env--{{ app()->environment() }}">
        <div class="a17 a17--login">
            <section class="login">
                <form accept-charset="UTF-8" action="{{ route('admin.login') }}" method="post">
                    <h1 class="f--heading login__heading login__heading--title">{{ config('app.name') }} <span class="envlabel envlabel--heading">{{ app()->environment() }}</span></h1>
                    <h2 class="f--heading login__heading">Login</h2>

                    <fieldset class="login__fieldset">
                        <label class="login__label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="login__input" required autofocus tabindex="1" value="{{ old('email') }}" />
                    </fieldset>

                    <fieldset class="login__fieldset">
                        <label class="login__label" for="password">Password</label>
                        <a href="{{ route('admin.password.reset.link') }}" class="login__help f--small" tabindex="5"><span>Forgot password</span></a>
                        <input type="password" name="password" id="password" class="login__input" required tabindex="2" />
                    </fieldset>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input class="login__button" type="submit" value="Login" tabindex="3">
                    {{-- <a href="{{ route('saml_login') }}" class="login__google" tabindex="4"> --}}
                      <span>Sign in with SSO</span>
                    </a>
                </form>
            </section>
            @include('cms-toolkit::partials.footer')
        </div>
    </body>
</html>
