
<?php

// test input boxes if error displays error under input box

// class to get new input box error handler for inputbox
Class inputBoxErrorHandler {
    private $isset;
    private $input;
    private $varLength;
    private $errorMessage;
    private $maxLength;
    private $styles = "style='color: red'";

    public function __construct($isset, $input, $varLength, $errorMessage, $maxLength=500){
        $this->isset = $isset;
        $this->input = $input;
        $this->varLength = $varLength;
        $this->errorMessage = $errorMessage;
        $this->maxLength = $maxLength;
    }
// generic test for input box
    public function testInputBox(){
        
        $inputLenght = strlen($this->input);
        if ($this->isset){
            if ($this->input == '') {
                return "<h4 " . $this->styles . " > Required </h4>";
            }
            if ($inputLenght < $this->varLength){
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } elseif ($inputLenght > $this->maxLength) {
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } else{
                return "";
            }
        }
    }
// email test for input box
    public function emailTest(){
        $isemail = filter_var($this->input, FILTER_VALIDATE_EMAIL);

        if ($this->input == '') {
            return "<h4 " . $this->styles . " > Required </h4>";
        }

        if ($this->isset) {
            if ($isemail == false) {
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } else {
                return "";
            }
        }
    }
// phone number test
    function phoneNumberTest() {
        // Remove any non-digit characters
        $cleanedPhoneNumber = preg_replace('/[^0-9]/', '', $this->input);
        $phoneLenght = strlen($cleanedPhoneNumber);
    

        if ($phoneLenght != 10){
            return "<h4 ". $this->styles . " > " . $this->errorMessage . " </h4>";
        }
        return "";
    
    }

// extension test for input box
    public function zipTest(){
        $inputLenght = strlen($this->input) == 5;
        $isNumeric = is_numeric((int)$this->input);
        
        if ($this->input == '') {
            return "<h4 " . $this->styles . " > Required </h4>";
        }

        if ($inputLenght == false || $isNumeric == false){
            return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
        } else {
            return "";
        }
    }
// password text for input box
    public function passwordTest(){
        $inputLenght = strlen($this->input);
        $numSpecialCharacters = 0;
        $specialCharacters = array('$', '!', '@', '*', '#');

        if ($this->input == '') {
            return "<h4 " . $this->styles . " > Required </h4>";
        }
// test for special characters
        foreach ($specialCharacters as $char){
            if (strpos($this->input, $char) == true){
                $numSpecialCharacters += 1;
            }
        }
// testing lenght
        if ($this->isset){
            if ($inputLenght < $this->varLength){
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } elseif ($inputLenght >= $this->maxLength) {
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } elseif ($numSpecialCharacters < 2) {
                return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
            } else{
                return "";
            }
        }
    }
// selectbox value has been selected
    public function selectboxTest(){
        if ($this->input == 0){
            return "<h4 " . $this->styles . " > " .  $this->errorMessage . " </h4>";
        } else {
            return "";
        }
    }
}
// runs test and returns whether all passed
if (isset($_POST['save'])){


    $passAllInputBoxTest= false;

    // First Name

    $firstNameTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['first_name'], 2, "First Name is required");

    $firstNameTestReturn = $firstNameTest->testInputBox();

    // Last Name

    $lastNameTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['last_name'], 2, "Last Name is required");

    $lastNameTestReturn = $lastNameTest->testInputBox();

    // date of birth

    $dateOfBirthTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['date_of_birth'], 5, 'Required');

    $dateOfBirthTestReturn = $dateOfBirthTest->testInputBox();

    // phone number

    $phoneNumberTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['phone_number'],12, "Phone number isn't valid please use xxx-xxx-xxxx or (xxx)xxx-xxxx formate");

    $phoneNumberTestReturn = $phoneNumberTest->phoneNumberTest();

    // address

    $addressTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['address'], 5,"Need to add address." , 500);

    $addressTestReturn = $addressTest->testInputBox();

    //city

    $cityTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['city'], 2,"Need to add a city." , 100);

    $cityTestReturn = $cityTest->testInputBox();

    //state

    $stateTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['state'], 2,"Neet to add a state." , 2);

    $stateTestReturn = $stateTest->testInputBox();

    //zip

    $zipTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['zip'], 5,"Need to add a five digit zip code." , 5);

    $zipTestReturn = $zipTest->zipTest();

    //email
    $emailTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['email'], 4, "Not a valid email address");

    $emailTestReturn = $emailTest->emailTest();

    //username
    $usernameTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['username'], 4, "Username needs to be greater than four characters.", 50);

    $usernameTestReturn = $usernameTest->testInputBox();

    //password
    $passwordTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['password'], 4, "Password must be 4-20 chars including at least one upper, and one lower, on digit, and two special character in the set $!@*#", 20);

    $passwordTestReturn = $passwordTest->passwordTest();

    // user level
    $userLevelTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['user_level'], 1, "Please select a user level", 1);

    $userLevelTestReturn = $userLevelTest->selectboxTest();


    if ($firstNameTestReturn == "" && $lastNameTestReturn == "" && $dateOfBirthTestReturn == "" && $phoneNumberTestReturn == "" && $addressTestReturn == "" && $cityTestReturn == "" && $stateTestReturn == "" && $zipTestReturn == "" && $emailTestReturn == "" && $usernameTestReturn == "" && $passwordTestReturn == "" && $userLevelTestReturn == "") {
        $passAllInputBoxTest = true;
    }

 }