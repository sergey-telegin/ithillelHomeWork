<?php

function processingRules(array $rules): array
{
    $rulesArray = [];
    foreach ($rules as $fieldName => $ruleString) {
        $rulesArray[$fieldName] = explode('|', $ruleString);
    }
    return $rulesArray;
}


function validate(array $fields, array $rules)
{
    $errors = [];

    if (!$rules)
        return false;

    $rulesArray = processingRules($rules);

    foreach ($rulesArray as $fieldName => $arrayRules) {
        foreach ($arrayRules as $rule) {

            if ($rule === 'required' && !$fields[$fieldName]) {
                $errors[$fieldName][] = "Field $fieldName is required!";
            }

            if (mb_strpos($rule, 'min_length') !== false) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (strlen($fields[$fieldName]) < $length) {
                    $errors[$fieldName][] = "Field $fieldName must be biggest than $length";
                }
            }
//
            if (mb_strpos($rule, 'max_length') !== false) {
                preg_match("/\[(\d+)\]/", $rule, $matches);
                $length = $matches[1];
                if (strlen($fields[$fieldName]) > $length) {
                    $errors[$fieldName][] = "Field $fieldName must be shorter than $length";
                }
            }

            if ($rule === 'email' && !filter_var($fields[$fieldName], FILTER_VALIDATE_EMAIL)) {
                $errors[$fieldName][] = "Email should be correct";
            }

            if ($rule === 'password') {
                $pattern = '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/';
                if (!preg_match($pattern, $fields[$fieldName])) {
                    $errors[$fieldName][] =
                        "Your password must:" . "<br>" .
                        "contain more than 6 characters" . "<br>" .
                        "contain numbers," . "<br>" .
                        "contain special symbols" . "<br>" .
                        "contain Latin characters" . "<br>" .
                        "contain lowercase characters" . "<br>" .
                        "contain uppercase characters" . "<br>";

                }
            }

            if ($rule === 'password-confirm'){
                if ($fields[$fieldName] !== $_POST['password']) {
                    $errors[$fieldName][] =
                        "Passwords must match";

                }
            }

            if ($rule === 'unique'){
                try {
                    $connectionToDB = connectToDb();
                    $request = $connectionToDB->prepare('SELECT count(*) AS rowsFound FROM `users` WHERE email = :field;');
                    $request->execute(array('field' => $fields[$fieldName]));
                    $result = $request->fetchAll();
                    if ($result[0]['rowsFound']!==0){
                        $errors[$fieldName][] = "$fields[$fieldName] is exists. Type another email.";
                    }
                } catch (PDOException $exception) {

                }
            }

        }

    }
    return $errors;
}


