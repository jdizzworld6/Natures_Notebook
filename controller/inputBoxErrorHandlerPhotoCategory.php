
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
}

// runs test and returns whether all passed
if (isset($_POST['save'])){


    $passAllInputBoxTest= false;

    // Name test

    $categoryNameTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['category_name'], 4, "Category Name is required");

    $categoryNameTestReturn = $categoryNameTest->testInputBox();

    // Description test

    $categoryDescriptionTest = new inputBoxErrorHandler(isset($_POST['save']), $_POST['last_name'], 10, "Description is required");

    $categoryDescriptionTestReturn = $categoryDescriptionTest->testInputBox();


    if ($categoryNameTestReturn == "" && $categoryDescriptionTestReturn) {
        $passAllInputBoxTest = true;
    }

 }