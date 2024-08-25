@include('base')

<body>
<div class="container form-control">
    <form action="api/auth/login" method="post">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" />

        <button type="submit" class="btn btn-dark">Login</button>
    </form>
</div>
</body>
