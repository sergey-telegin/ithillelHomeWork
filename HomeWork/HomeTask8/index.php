<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doc</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Information update</h1>
    <p>Fill in the fields below for the HR department</p>

</header>
<form action="Server.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend class="title-form">Information about you</legend>

        <div class="form-input">
            <label for="name">Input your name</label>
            <input required type="text" id="name" name="name">
        </div>

        <div class="form-input">
            <label for="surname">Input your surname</label>
            <input required type="text" id="surname" name="surname">
        </div>

        <div class="form-input">
            <label for="age">Input your age</label>
            <input required type="text" id="age" name="age">
        </div>

        <div class="form-input">
            <label for="gender">Choose your gender</label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="idiot">Not exists</option>
            </select>
        </div>

        <div class="form-input">
            <label for="photo">Upload your photo</label>
            <input required type="file" id="photo" name="photo" accept="image/jpeg">
        </div>
    </fieldset>
    <fieldset>
        <legend class="title-form">Information about your profession</legend>
        <div class="form-input">
            <label for="profession">Input your profession</label>
            <input required type="text" id="profession" name="profession">
        </div>
        <div>
            <label for="coding">University</label>
            <input type="checkbox" id="university" name="university" value="1"/>
        </div>

        <div>
            <label for="coding">Courses</label>
            <input type="checkbox" id="courses" name="courses" value="1"/>
        </div>

        <div>
            <label for="self-taught">Self-taught</label>
            <input type="checkbox" id="self-taught" name="self-taught" value="1"/>
        </div>

    </fieldset>

    <fieldset>
        <legend class="title-form"
        ">Your preferred contact method</legend>
        <div>
            <input type="radio" id="contactChoice1"
                   name="contact" value="email">
            <label for="contactChoice1">Email</label>
            <input type="radio" id="contactChoice2"
                   name="contact" value="phone">
            <label for="contactChoice2">Phone</label>
            <input type="radio" id="contactChoice3"
                   name="contact" value="mail">
            <label for="contactChoice3">Mail</label>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="Отправить форму">
    </div>


</form>

</body>
</html>

