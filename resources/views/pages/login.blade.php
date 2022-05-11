@extends('layouts.app')

@section('title', 'Login')

@section('attrs', "data-current-page='login'")

@section('content')
    <div class="page-login">
        <h1>Login</h1>
    </div>
@endsection

@section('scripts')
    <script>
        async function request(url, options) {
            const headers = {
                'content-type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
            const credentials = 'include'
            const config = {headers, credentials}
            const response = await fetch(url, {...config, ...options})
            return response.json()
        }

        async function login() {
            return await request('login', {
                method: 'POST',
                body: JSON.stringify({
                    email: `admin@account.com`,
                    password: `Pa$$word!`,
                })
            })
        }

        login().then(
            response => console.log(response)
        )
    </script>
@endsection
