<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width">
        <title>Find the breach</title>
        <link rel="icon" type="image/x-icon" href="/static/pictures/favicon.ico">
        <link rel="stylesheet" type="text/css" href="/static/styles/main.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/form.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/home.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/error.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/admin.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/adminSolo.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/adminUsers.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/user.css">
    </head>
    <body>
        <?php View::show('standard/header'); ?>
        <?php echo $A_view['body'] ?>
        <?php View::show('standard/footer'); ?>
    </body>
</html>