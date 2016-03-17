{{ form('session/start') }}
    <fieldset>
        <div>
            <label for="login">Логин/Email</label>
            <div>
                {{ text_field('login') }}
            </div>
        </div>
        <div>
            <label for="pass">Пароль</label>
            <div>
                {{ password_field('pass') }}
            </div>
        </div>
        <div>
            {{ submit_button('Войти') }}
        </div>
    </fieldset>
</form>
