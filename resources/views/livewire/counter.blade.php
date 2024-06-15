<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
    <title>Document</title>
</head>
<style>
    .center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh;
}
    body
    {
        background: grey;
    }
</style>
<body>
    <div class="center-container">
        <livewire:building-button />
    </div>
</body>
</html>