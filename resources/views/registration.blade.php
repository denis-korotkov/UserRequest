@include('base')

<body>
<div class="container form-control">
    <form action="api/auth/registration" method="post">
        <label for="name">Username:</label>
        <input type="text" id="name" name="name"/>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"/>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"/>

        <button type="submit">Register</button>
    </form>
</div>
</body>
